<?php

namespace App\Services\CourtCase;

use App\Requests\CourtCase\GetCasesRequestDto;
use App\Services\Court\ICourt;
use App\Services\CourtCase\Source\CourtCaseDatabaseSource;
use App\Services\CourtCase\Source\CourtCaseWebSource;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class CourtCaseStorage
{
    /**
     * @var ICourt[]
     */
    private array $courts;
    private string $query;
    private Carbon $dateFrom;
    private Carbon $dateTo;


    /**
     * @param ICourt[] $courts
     * @param GetCasesRequestDto $request
     */
    public function __construct(array $courts, GetCasesRequestDto $request)
    {
        $this->courts = $courts;
        $this->query = $request->query;
        $this->dateFrom = $request->dateFrom ? Carbon::parse($request->dateFrom) : Carbon::today();
        $this->dateTo = $request->dateTo ? Carbon::parse($request->dateTo) : Carbon::today();
    }

    public function getCases(): Collection
    {
        $cases = collect();

        foreach ($this->courts as $court) {
            $cases = $cases->merge($this->getCasesForCourt($court));
        }

        return $cases;
    }

    private function getCasesForCourt(ICourt $court): Collection
    {
        $cases = collect();

        $daysInterval = $this->dateFrom->diffInDays($this->dateTo);
        for ($dayNumber = 0; $dayNumber <= $daysInterval; $dayNumber++) {

            $formattedDate = $this->dateFrom->addDays($dayNumber)->format('d.m.Y');
            $cases = $cases->merge($this->getFromSource($court, $formattedDate));
        }

        return $cases;
    }

    private function getFromSource(ICourt $court, string $date): Collection
    {
        $databaseSource = new CourtCaseDatabaseSource($court);
        $cases = $databaseSource->get($this->query, $date);

        if (!$cases->isEmpty()) {
            return $cases;
        }

        $webSource = new CourtCaseWebSource($court);
        return $webSource->get($this->query, $date);
    }
}

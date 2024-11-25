<?php

namespace App\Services\CourtCase;

use App\Requests\CourtCase\CasesForTodayRequestDto;
use App\Services\CourtCase\Source\CourtCaseSource;
use App\Services\HtmlParser\HtmlParser;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class CourtCaseStorage
{
    private Carbon $dateFrom;
    private Carbon $dateTo;

    public function __construct(?string $dateFrom = null, ?string $dateTo = null)
    {
        $this->dateFrom = $dateFrom ? Carbon::parse($dateFrom) : Carbon::today();
        $this->dateTo = $dateTo ? Carbon::parse($dateTo) : Carbon::today();
    }

    public function getForToday(): Collection
    {
        $dateStart = Carbon::today();
        $dateTo = Carbon::today();

        return $this->get($dateStart, $dateTo);
    }

    public function getForDateInterval(string $dateFrom, string $dateTo): Collection
    {
        $dateStart = Carbon::parse($dateFrom);
        $dateTo = Carbon::parse($dateTo);

        return $this->get($dateStart, $dateTo);
    }

    private function get(Carbon $dateStart, Carbon $dateTo): Collection
    {
        $cases = collect();

        $urls = $this->getUrlsWithSubstitutedDates();
        for ($i = 0; $i <= $dateStart->diffInDays($dateTo); $i++) {
            $cases = $cases->merge($this->parseUrls($dateStart->addDays($i)));
        }

        return $cases;
    }

    private function getUrlsWithSubstitutedDates(Carbon $dateStart): array

    private function getFromSource(CourtCaseSource $source): Collection
    {

    }

    private function parseUrls(Carbon $date): Collection
    {
        foreach ($this->urls as $url) {
            $url = $this->substituteDateToUrl($url, $date);
            $htmlParser = new HtmlParser($url);
            $htmlParser->parse();
        }
    }

    private function getCasesFromUrl(string $url,    CasesForTodayRequestDto $getCasesDto): array
    {

    }
}

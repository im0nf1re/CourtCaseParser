<?php

namespace App\Services\CourtCase\Source;

use App\Services\Court\ICourt;
use App\Services\CourtCase\Exceptions\CanNotReadFromSiteException;
use App\Services\HtmlParser\HtmlParser;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class CourtCaseWebSource implements CourtCaseSource
{
    private ICourt $court;

    public function __construct(ICourt $court)
    {
        $this->court = $court;
    }

    /**
     * @throws CanNotReadFromSiteException
     */
    public function get(string $date, ?string $query = null): Collection
    {
        $cases = collect();

        $url = $this->getUrl($date);
        $parser = new HtmlParser($url, $this->court->getRowPattern(), $this->court->getColumnPattern());

        $casesData = $this->getDataFromParser($parser);

        if ($query) {
            $casesData = $this->filterCasesDataByQuery($casesData, $query);
        }

        foreach ($casesData as $caseData) {
            $cases->push($this->court->createCase($caseData, $date));
        }

        return $cases;
    }

    private function getUrl(string $date): string
    {
        return $this->court->getUrl() . $date;
    }

    /**
     * @throws CanNotReadFromSiteException
     */
    private function getDataFromParser(HtmlParser $parser): array
    {
        try {
            $data = $parser->getCasesData();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw new CanNotReadFromSiteException('Can not get cases from court site');
        }

        return $data;
    }

    private function filterCasesDataByQuery(array $casesData, string $query): array
    {
        return array_filter($casesData, function ($case) use ($query) {
            return $this->isQueryStringInCaseFields($case, $query);
        });
    }

    private function isQueryStringInCaseFields(array $caseData, string $query): bool
    {
        foreach ($caseData as $field) {
            if (empty($field)) {
                continue;
            }

            if (mb_stripos($field, $query) !== false) {
                return true;
            }
        }
        return false;
    }
}

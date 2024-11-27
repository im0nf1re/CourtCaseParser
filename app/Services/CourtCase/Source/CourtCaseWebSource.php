<?php

namespace App\Services\CourtCase\Source;

use App\Services\Court\ICourt;
use App\Services\HtmlParser\HtmlParser;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class CourtCaseWebSource implements CourtCaseSource
{
    private ICourt $court;

    public function __construct(ICourt $court)
    {
        $this->court = $court;
    }

    public function get(string $query, string $date): Collection
    {
        $cases = collect();

        $url = $this->getUrl($date);
        $parser = new HtmlParser($url, $this->court->getRowPattern(), $this->court->getColumnPattern());
        $casesData = $this->getDataFromParser($parser);
        // todo добавить фильтрацию по параметру
        foreach ($casesData as $caseData) {
            //todo отдавать dto для ответа
            $cases->push($this->court->createCase($caseData, $date));
        }

        return $cases;
    }

    private function getUrl(string $date): string
    {
        return $this->court->getUrl() . $date;
    }

    private function getDataFromParser(HtmlParser $parser): array
    {
        try {
            $data = $parser->getCasesData();
        } catch (\Exception $e) {
            return [];
        }

        return $data;
    }
}

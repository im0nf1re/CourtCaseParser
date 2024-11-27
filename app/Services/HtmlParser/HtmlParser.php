<?php

namespace App\Services\HtmlParser;

use Exception;

class HtmlParser
{
    private string $url;
    private string $rowPattern;
    private string $colPattern;

    public function __construct(string $url, string $rowPattern, string $colPattern)
    {
        $this->url = $url;
        $this->rowPattern = $rowPattern;
        $this->colPattern = $colPattern;
    }

    /**
     * @throws Exception
     */
    public function getCasesData(): array
    {
        $html = file_get_contents($this->url);
        if ($html === false) {
            throw new Exception("Unable to read html file");
        }
        return $this->getCasesDataFromHtml($html);
    }

    /**
     * @throws Exception
     */
    private function getCasesDataFromHtml(string $html): array
    {
        $data = [];

        $rows = $this->getRowsFromHtml($html);
        foreach ($rows as $row) {
            $data[] = $this->getDataFromRow($row);
        }

        return $data;
    }

    private function getRowsFromHtml(string $html): array
    {
        preg_match_all($this->rowPattern, $html, $rowMatches);

        return $rowMatches[1];
    }

    private function getDataFromRow(string $row): array
    {
        preg_match_all($this->colPattern, $row, $colMatches);
        $cols = $colMatches[1];

        return array_map(function ($col) {
            return strip_tags(
                mb_convert_encoding($col, 'UTF-8', mb_detect_encoding($col, ['UTF-8', 'CP1251'], true))
            );
        }, $cols);
    }
}

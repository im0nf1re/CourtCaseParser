<?php

namespace App\Services\Court;

use App\Models\CourtCase\CourtCase;

interface ICourt
{
    public function getUrl(): string;

    public function getRowPattern(): string;

    public function getColumnPattern(): string;

    public function createCase(array $caseData, string $date): CourtCase;
}

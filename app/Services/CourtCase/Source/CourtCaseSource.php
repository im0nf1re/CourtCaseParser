<?php

namespace App\Services\CourtCase\Source;

use App\Services\Court\ICourt;
use Illuminate\Support\Collection;

interface CourtCaseSource
{
    public function __construct(ICourt $court);

    public function get(string $query, string $date): Collection;
}

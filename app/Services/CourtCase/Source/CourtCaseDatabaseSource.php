<?php

namespace App\Services\CourtCase\Source;

use App\Services\Court\ICourt;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class CourtCaseDatabaseSource implements CourtCaseSource
{
    private ICourt $court;

    public function __construct(ICourt $court)
    {
        $this->court = $court;
    }

    public function get(string $date, ?string $query = null): Collection
    {
        return collect();
    }
}

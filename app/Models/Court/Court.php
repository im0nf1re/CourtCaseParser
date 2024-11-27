<?php

namespace App\Models\Court;

use App\Models\CourtCase;
use App\Services\Court\ICourt;
use Illuminate\Database\Eloquent\Model;

abstract class Court extends Model implements ICourt
{
    public function createCase(array $caseData, string $date): CourtCase
    {
        return new CourtCase([
            'number' => $caseData[1],
            'date' => $date,
            'time' => $caseData[2],
            'room' => $caseData[3],
            'information' => $caseData[4],
            'judge' => $caseData[5],
            'result' => $caseData[6],
            'solution' => $caseData[7],
        ]);
    }
}

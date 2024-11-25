<?php

namespace App\Models;

class CourtCase
{
    protected array $fillable = [
        'number',
        'date',
        'time',
        'room',
        'information',
        'judge',
        'result',
        'solution',
    ];
}

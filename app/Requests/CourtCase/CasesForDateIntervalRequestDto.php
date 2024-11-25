<?php

namespace App\Requests\CourtCase;

use Spatie\LaravelData\Attributes\Validation\Date;

class CasesForDateIntervalRequestDto extends CasesForTodayRequestDto
{
    #[Date]
    public string $date_from;

    #[Date]
    public string $date_to;
}

<?php

namespace App\Requests\CourtCase;

use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class GetCasesRequestDto extends Data
{
    public string $query;

    #[Rule('nullable', 'date')]
    public ?string $dateFrom;

    #[Rule('nullable', 'date')]
    public ?string $dateTo;
}

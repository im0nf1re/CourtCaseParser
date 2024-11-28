<?php

namespace App\Requests\CourtCase;

use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class GetCasesRequestDto extends Data
{
    public ?string $query;

    #[Rule('nullable', 'date', 'required_with:dateTo')]
    public ?string $dateFrom;

    #[Rule('nullable', 'date', 'required_with:dateFrom')]
    public ?string $dateTo;
}

<?php

namespace App\DataObjects;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class CourtCaseDto extends Data
{
    public string $number;

    public string $date;

    public string $time;

    public string $room;

    #[MapInputName('html_information')]
    public string $information;

    public string $judge;

    #[MapInputName('html_result')]
    public string $result;

    public string $solution;
}

<?php

namespace App\Services\Court;

use App\Models\Court\DistrictCourt;

class CourtRegister
{
    /**
     * @return ICourt[]
     */
    public function getCourts(): array
    {
        // todo mock
        return [
            new DistrictCourt(),
        ];
    }
}

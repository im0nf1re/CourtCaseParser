<?php

namespace App\Http\Controllers;

use App\Requests\CourtCase\CasesForDateIntervalRequestDto;
use App\Requests\CourtCase\CasesForTodayRequestDto;
use App\Services\CourtCase\CourtCaseStorage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourtCaseController extends Controller
{
    public function __construct(
        private readonly CourtCaseStorage $courtCaseParser,
    ) {}

    public function getForToday(Request $request): JsonResponse
    {
        return response()->json(
            $this->courtCaseParser->getForToday(CasesForTodayRequestDto::validateAndCreate($request->all()))
        );
    }

    public function getForDateInterval(Request $request): JsonResponse
    {
        return response()->json(
            $this->courtCaseParser->getForDateInterval(CasesForDateIntervalRequestDto::validateAndCreate($request->all()))
        );
    }
}

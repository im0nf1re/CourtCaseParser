<?php

namespace App\Http\Controllers;

use App\DataObjects\CourtCaseDto;
use App\Requests\CourtCase\GetCasesRequestDto;
use App\Services\Court\CourtRegister;
use App\Services\CourtCase\CourtCaseStorage;
use Illuminate\Http\JsonResponse;

class CourtCaseController extends Controller
{
    public function getCases(GetCasesRequestDto $request, CourtRegister $courtRegister): JsonResponse
    {
        $storage = new CourtCaseStorage(
            $courtRegister->getCourts(),
            $request
        );

        return response()->json(
            CourtCaseDto::collect($storage->getCases())
        );
    }
}

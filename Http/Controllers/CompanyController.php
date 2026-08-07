<?php

namespace App\Http\Controllers;

use App\Actions\SaveCompanyAction;
use App\Http\Requests\CompanyRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Company;

class CompanyController extends Controller
{
    public function store(
        CompanyRequest $request,
        SaveCompanyAction $action
    ): JsonResponse {

        $result = $action->execute(
            $request->validated()
        );

        return response()->json($result);
    }

    public function versions(
        string $edrpou
    ): JsonResponse
    {
        $company = Company::query()
            ->where('edrpou', $edrpou)
            ->firstOrFail();

        return response()->json(
            $company->versions
        );
    }
}
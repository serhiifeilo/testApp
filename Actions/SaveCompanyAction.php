<?php

namespace App\Actions;

use App\Models\Company;
use App\Services\VersioningService;
use Illuminate\Support\Facades\DB;

class SaveCompanyAction
{
    public function __construct(
        private VersioningService $versioningService
    ) {
    }

    public function execute(array $data): array
    {
        return DB::transaction(function () use ($data) {

            $company = Company::query()
                ->where('edrpou', $data['edrpou'])
                ->first();

            if (!$company) {

                $company = Company::create($data);

				$version = $this->versioningService
					->saveVersion($company);

                return [
                    'status' => 'created',
                    'company_id' => $company->id,
                    'version' => $version,
                ];
            }

            if (!$this->versioningService->hasChanges(
                $company,
                $data
            )) {

                return [
                    'status' => 'duplicate',
                    'company_id' => $company->id,
                    'version' => $company->versions()->max('version') ?? 1,
                ];
            }

            $old = $company->only([
                'name',
                'edrpou',
                'address',
            ]);

            $company->update($data);

            $version = $this->versioningService
                ->saveVersion(
                    $company,
                    $old
                );

            return [
                'status' => 'updated',
                'company_id' => $company->id,
                'version' => $version,
            ];
        });
    }
}
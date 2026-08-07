<?php

namespace App\Services;

use App\Models\Company;
use App\Models\CompanyVersion;

class VersioningService
{

    public function hasChanges(
        Company $company,
        array $data
    ): bool {
        return $company->only([
            'name',
            'edrpou',
            'address',
        ]) != array_intersect_key(
            $data,
            array_flip([
                'name',
                'edrpou',
                'address',
            ])
        );
    }


    public function  saveVersion(
        Company $company,
        ?array $oldData = null
    ): int {

        $version = $this->nextVersion($company);

        CompanyVersion::create([

            'company_id' => $company->id,

            'version' => $version,

            'snapshot' => $this->snapshot(
                $company,
                $oldData
            ),

        ]);

        return $version;
    }

    private function snapshot(
        Company $company,
        ?array $oldData = null
    ): array {

        return [

            'old' => $oldData,

            'new' => [

                'name' => $company->name,

                'edrpou' => $company->edrpou,

                'address' => $company->address,

            ],
        ];
    }

    private function nextVersion(
        Company $company
    ): int {

        return
            ($company->versions()->max('version') ?? 0)
            + 1;
    }
}
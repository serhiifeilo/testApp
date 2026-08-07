<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Company;

class CompanyApiTest extends TestCase
{
    use RefreshDatabase;

public function test_can_create_company(): void
{
    $payload = [

        'name' => 'UEEX',

        'edrpou' => '1234567890',

        'address' => 'Kyiv',

    ];

    $response = $this->postJson(
        '/api/company',
        $payload
    );

    $response
        ->assertStatus(200)
        ->assertJson([

            'status' => 'created',

        ]);

    $company = Company::first();

    $this->assertDatabaseHas('companies', [

        'edrpou' => '1234567890',

    ]);

    $this->assertDatabaseHas('company_versions', [

        'company_id' => $company->id,

        'version' => 1,

    ]);
}

public function test_can_update_company(): void
{
    $this->postJson('/api/company', [

        'name' => 'UEEX',

        'edrpou' => '1234567890',

        'address' => 'Kyiv',

    ]);

    $response = $this->postJson('/api/company', [

        'name' => 'UEEX',

        'edrpou' => '1234567890',

        'address' => 'Lviv',

    ]);

    $response
        ->assertOk()
        ->assertJson([

            'status' => 'updated',

            'version' => 2,

        ]);

    $this->assertDatabaseHas('companies', [

        'address' => 'Lviv',

    ]);

    $this->assertDatabaseHas('company_versions', [

        'version' => 2,

    ]);
}
public function test_duplicate_request_returns_duplicate(): void
{
    $payload = [

        'name' => 'UEEX',

        'edrpou' => '1234567890',

        'address' => 'Kyiv',

    ];

    $this->postJson('/api/company', $payload);

    $response = $this->postJson('/api/company', $payload);

    $response
        ->assertOk()
        ->assertJson([

            'status' => 'duplicate',

        ]);

    $this->assertDatabaseCount(
        'company_versions',
        1
    );
}
public function test_validation_errors(): void
{
    $response = $this->postJson('/api/company', []);

    $response
        ->assertStatus(422)
        ->assertJsonValidationErrors([

            'name',

            'edrpou',

            'address',

        ]);
}

public function test_company_has_two_versions_after_update(): void
{
    $this->postJson('/api/company', [
        'name' => 'UEEX',
        'edrpou' => '1234567890',
        'address' => 'Kyiv',
    ]);

    $this->postJson('/api/company', [
        'name' => 'UEEX',
        'edrpou' => '1234567890',
        'address' => 'Lviv',
    ]);

    $company = Company::first();

    $this->assertEquals(
        2,
        $company->versions()->count()
    );
}




}
<?php
use App\Models\Company;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('can list companies', function () {
    $companies = Company::factory(3)->create();
    $response = $this->get(route('companies.index'));
    $response->assertOk();
    $companies->each(fn($company) => $response->assertSee($company->name));
});

test('can create company', function () {
    $companyData = Company::factory()->raw();
    $response = $this->post(route('companies.store'), $companyData);
    $response->assertRedirect();
    $this->assertDatabaseHas('companies', $companyData);
});

test('can show company', function () {
    $company = Company::factory()->create();
    $response = $this->get(route('companies.show', $company));
    $response->assertOk();
    $response->assertSee($company->name);
});

test('can update company', function () {
    $company = Company::factory()->create();
    $updateData = ['name' => 'Updated Company'];
    $response = $this->put(route('companies.update', $company), $updateData);
    $response->assertRedirect();
    $this->assertDatabaseHas('companies', $updateData);
});

test('can delete company', function () {
    $company = Company::factory()->create();
    $response = $this->delete(route('companies.destroy', $company));
    $response->assertRedirect();
    $this->assertModelMissing($company);
});

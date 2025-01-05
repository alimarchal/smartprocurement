<?php
use App\Models\Contact;
use App\Models\Company;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('can list contacts', function () {
    $contacts = Contact::factory(3)->create();
    $response = $this->get(route('contacts.index'));
    $response->assertOk();
    $contacts->each(fn($contact) => $response->assertSee($contact->name));
});

test('can create contact', function () {
    $company = Company::factory()->create();
    $contactData = Contact::factory()->raw(['company_id' => $company->id]);
    $response = $this->post(route('contacts.store'), $contactData);
    $response->assertRedirect();
    $this->assertDatabaseHas('contacts', $contactData);
});

test('can show contact', function () {
    $contact = Contact::factory()->create();
    $response = $this->get(route('contacts.show', $contact));
    $response->assertOk();
    $response->assertSee($contact->name);
});

test('can update contact', function () {
    $contact = Contact::factory()->create();
    $updateData = [
        'company_id' => $contact->company_id,
        'name' => 'Updated Contact'
    ];
    $response = $this->put(route('contacts.update', $contact), $updateData);
    $response->assertRedirect();
    $this->assertDatabaseHas('contacts', $updateData);
});

test('can delete contact', function () {
    $contact = Contact::factory()->create();
    $response = $this->delete(route('contacts.destroy', $contact));
    $response->assertRedirect();
    $this->assertModelMissing($contact);
});

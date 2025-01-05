@extends('layouts.app-bs')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $company->name }}</h1>
        <div>
            <a href="{{ route('companies.edit', $company) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('companies.index') }}" class="btn btn-secondary">Back to Companies</a>
        </div>
    </div>

    <div class="row">
        <!-- Company Details -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Company Details</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Company Type</dt>
                        <dd class="col-sm-8">
                            <span class="badge bg-{{ $company->company_type === 'customer' ? 'success' : 'info' }}">
                                {{ ucfirst($company->company_type) }}
                            </span>
                        </dd>

                        <dt class="col-sm-4">VAT Number</dt>
                        <dd class="col-sm-8">{{ $company->vat_number ?: 'N/A' }}</dd>

                        <dt class="col-sm-4">CR Number</dt>
                        <dd class="col-sm-8">{{ $company->cr_number ?: 'N/A' }}</dd>

                        <dt class="col-sm-4">Address</dt>
                        <dd class="col-sm-8">{{ $company->full_address ?: 'N/A' }}</dd>

                        <dt class="col-sm-4">Phone</dt>
                        <dd class="col-sm-8">{{ $company->phone ?: 'N/A' }}</dd>

                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8">
                            @if($company->email)
                                <a href="mailto:{{ $company->email }}">{{ $company->email }}</a>
                            @else
                                N/A
                            @endif
                        </dd>

                        <dt class="col-sm-4">Website</dt>
                        <dd class="col-sm-8">
                            @if($company->website)
                                <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a>
                            @else
                                N/A
                            @endif
                        </dd>

                        <dt class="col-sm-4">Bank Name</dt>
                        <dd class="col-sm-8">{{ $company->bank_name ?: 'N/A' }}</dd>

                        <dt class="col-sm-4">IBAN</dt>
                        <dd class="col-sm-8">{{ $company->iban ?: 'N/A' }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Contacts -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Contacts</h5>
                    <a href="{{ route('contacts.create', ['company_id' => $company->id]) }}" class="btn btn-sm btn-primary">
                        Add Contact
                    </a>
                </div>
                <div class="card-body">
                    @if($company->contacts->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($company->contacts as $contact)
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">{{ $contact->name }}</h6>
                                            <p class="mb-1 text-muted">{{ $contact->designation ?: 'No designation' }}</p>
                                            @if($contact->email)
                                                <small><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></small>
                                            @endif
                                            @if($contact->phone)
                                                <br><small>{{ $contact->phone }}</small>
                                            @endif
                                        </div>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('contacts.destroy', $contact) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this contact?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0">No contacts found.</p>
                    @endif
                </div>
            </div>
        </div>

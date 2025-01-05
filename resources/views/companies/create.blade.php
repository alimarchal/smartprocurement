@extends('layouts.app-bs')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Add Company</h1>
        <a href="{{ route('companies.index') }}" class="btn btn-secondary">
            Back to Companies
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('companies.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Company Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="company_type" class="form-label">Company Type <span class="text-danger">*</span></label>
                            <select class="form-select @error('company_type') is-invalid @enderror"
                                    id="company_type"
                                    name="company_type"
                                    required>
                                <option value="customer" {{ old('company_type') === 'customer' ? 'selected' : '' }}>Customer</option>
                                <option value="vendor" {{ old('company_type') === 'vendor' ? 'selected' : '' }}>Vendor</option>
                            </select>
                            @error('company_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="vat_number" class="form-label">VAT Number</label>
                            <input type="text"
                                   class="form-control @error('vat_number') is-invalid @enderror"
                                   id="vat_number"
                                   name="vat_number"
                                   value="{{ old('vat_number') }}">
                            @error('vat_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="cr_number" class="form-label">CR Number</label>
                            <input type="text"
                                   class="form-control @error('cr_number') is-invalid @enderror"
                                   id="cr_number"
                                   name="cr_number"
                                   value="{{ old('cr_number') }}">
                            @error('cr_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text"
                                   class="form-control @error('address') is-invalid @enderror"
                                   id="address"
                                   name="address"
                                   value="{{ old('address') }}">
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text"
                                   class="form-control @error('city') is-invalid @enderror"
                                   id="city"
                                   name="city"
                                   value="{{ old('city') }}">
                            @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text"
                                   class="form-control @error('country') is-invalid @enderror"
                                   id="country"
                                   name="country"
                                   value="{{ old('country') }}">
                            @error('country')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   id="phone"
                                   name="phone"
                                   value="{{ old('phone') }}">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="email"
                                   name="email"
                                   value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="website" class="form-label">Website</label>
                            <input type="url"
                                   class="form-control @error('website') is-invalid @enderror"
                                   id="website"
                                   name="website"
                                   value="{{ old('website') }}">
                            @error('website')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="iban" class="form-label">IBAN</label>
                            <input type="text"
                                   class="form-control @error('iban') is-invalid @enderror"
                                   id="iban"
                                   name="iban"
                                   value="{{ old('iban') }}">
                            @error('iban')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="bank_name" class="form-label">Bank Name</label>
                            <input type="text"
                                   class="form-control @error('bank_name') is-invalid @enderror"
                                   id="bank_name"
                                   name="bank_name"
                                   value="{{ old('bank_name') }}">
                            @error('bank_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('companies.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create Company</button>
                </div>
            </form>
        </div>
    </div>
@endsection

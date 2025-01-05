@extends('layouts.app-bs')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Companies</h1>
        <a href="{{ route('companies.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add Company
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>VAT Number</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($companies as $company)
                        <tr>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->vat_number }}</td>
                            <td>{{ $company->phone }}</td>
                            <td>{{ $company->email }}</td>
                            <td>
                                    <span class="badge bg-{{ $company->company_type === 'customer' ? 'success' : 'info' }}">
                                        {{ ucfirst($company->company_type) }}
                                    </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('companies.show', $company) }}"
                                       class="btn btn-sm btn-info">
                                        View
                                    </a>
                                    <a href="{{ route('companies.edit', $company) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>
                                    <form action="{{ route('companies.destroy', $company) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this company?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No companies found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end">
                {{ $companies->links() }}
            </div>
        </div>
    </div>
@endsection

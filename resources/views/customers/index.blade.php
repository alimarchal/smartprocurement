@extends('layouts.appbs')

@section('title', 'Company Information')
@section('page_subtitle', 'Dashboard')
@section('page_actions', 'Customers (Buyers)')

    @section('content')
        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
                <a role="tab" class="nav-link active" id="tab-0" data-bs-toggle="tab" href="#tab-content-0">
                    <span>Customers (Buyers)</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-1" data-bs-toggle="tab" href="#tab-content-1">
                    <span>Add New</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <table class="table table-hover table-striped table-bordered" id="example" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>VAT No.</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->vat_no }}</td>
                                            <td>{{ $customer->contact }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->address }}</td>
                                            <td>
                                                <a href="{{ route('customers.show', $customer) }}" class="btn btn-sm btn-info btn-show">View</a>
                                                <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('customers.store') }}" enctype="multipart/form-data" class="card p-4">
                            @csrf
                            <h5 class="card-title">Add Customer</h5>
                            <div class="divider"></div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vat_no">VAT Number</label>
                                        <input type="text" id="vat_no" name="vat_no" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact">Contact Number</label>
                                        <input type="tel" id="contact" name="contact" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea id="address" name="address" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Save Customer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @push('page-scripts')

    @endpush

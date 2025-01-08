@extends('layouts.appbs')

@section('title', 'Company Information')
@section('page_subtitle', 'Dashboard')
@section('page_actions', 'Customers (Buyers) /  Edit Customer (Buyer)')

@section('content')

    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <form method="post" action="{{ route('customers.update', $customer) }}" enctype="multipart/form-data" class="card p-4">
                            @csrf
                            @method('PUT')
                            <h5 class="card-title">Edit Customer</h5>
                            <div class="divider"></div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control" value="{{ $customer->name }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vat_no">VAT Number</label>
                                        <input type="text" id="vat_no" name="vat_no" class="form-control" value="{{ $customer->vat_no }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact">Contact Number</label>
                                        <input type="tel" id="contact" name="contact" class="form-control" value="{{ $customer->contact }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" value="{{ $customer->email }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea id="address" name="address" class="form-control" rows="3">{{ $customer->address }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Customer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('page-scripts')
@endpush

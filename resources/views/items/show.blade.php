@extends('layouts.appbs')

@section('title', 'Company Information')
@section('page_subtitle', 'Dashboard')
@section('page_actions', 'Items / Show Item')

@section('content')
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div action="javascript:void(0);" class="card p-4">
                            <h5 class="card-title">Show Item</h5>
                            <div class="divider"></div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="code">Code</label>
                                        <input type="text" id="code" class="form-control" value="{{ $item->code }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" class="form-control" value="{{ $item->name }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <input type="text" id="category" class="form-control" value="{{ $item->category->name ?? 'N/A' }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="unit">Unit</label>
                                        <input type="text" id="unit" class="form-control" value="{{ $item->unit }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="text" id="quantity" class="form-control" value="{{ $item->quantity }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="unit_price">Unit Price</label>
                                        <input type="text" id="unit_price" class="form-control" value="{{ number_format($item->unit_price, 2) }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="text" id="stock" class="form-control" value="{{ $item->stock }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea id="description" class="form-control" rows="3" disabled>{{ $item->description }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_active">Status</label>
                                        <input type="text" id="is_active" class="form-control" value="{{ $item->is_active ? 'Active' : 'Inactive' }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('items.index') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

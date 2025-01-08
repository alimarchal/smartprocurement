@extends('layouts.appbs')

@section('title', 'Company Information')
@section('page_subtitle', 'Dashboard')
@section('page_actions', 'Items / Edit Item')

@section('content')
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <form method="post" action="{{ route('items.update', $item) }}" class="card p-4">
                            @csrf
                            @method('PUT')
                            <h5 class="card-title">Edit Item</h5>
                            <div class="divider"></div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="code">Code</label>
                                        <input type="text" id="code" name="code" class="form-control" value="{{ $item->code }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control" value="{{ $item->name }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_id">Category <span class="text-danger">*</span></label>
                                        <select name="category_id" id="category_id" class="form-control" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="unit">Unit <span class="text-danger">*</span></label>
                                        <input type="text" id="unit" name="unit" class="form-control" value="{{ $item->unit }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="quantity">Quantity <span class="text-danger">*</span></label>
                                        <input type="number" id="quantity" name="quantity" class="form-control" value="{{ $item->quantity }}" min="0" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="unit_price">Unit Price <span class="text-danger">*</span></label>
                                        <input type="number" id="unit_price" name="unit_price" class="form-control" value="{{ $item->unit_price }}" min="0" step="0.01" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="stock">Stock <span class="text-danger">*</span></label>
                                        <input type="number" id="stock" name="stock" class="form-control" value="{{ $item->stock }}" min="0" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea id="description" name="description" class="form-control" rows="3">{{ $item->description }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_active">Status</label>
                                        <select name="is_active" id="is_active" class="form-control">
                                            <option value="1" {{ $item->is_active ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ !$item->is_active ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Item</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

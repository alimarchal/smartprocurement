<!doctype html>
<html lang="en">
<head>
    @include('includes.meta')
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar ">

    @include('includes.header')

    <div class="app-main">

        @yield('content-before')


        @if(empty(Auth::user()->company))
            <div class="row mx-auto" style="margin-top: 60px; margin-bottom: 60px;">
                <div class="col-lg-12 col-md-12 ">
                    {{--                        @if(Auth::user()->is_company_set == "No")--}}

                        <form action="{{ route('companies.store') }}" method="POST" class="card" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <h3 class="card-title text-center mb-4">
                                    Please Complete Business Contact Information</h3>

                                <!-- Basic Information -->
                                <div class="bg-light p-4 rounded mb-4">
                                    <h4 class="mb-3">Basic Information</h4>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">Company Name (English)*</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name') }}">
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="name_arabic" class="form-label">Company Name (Arabic)</label>
                                            <input type="text" class="form-control" id="name_arabic" name="name_arabic" value="{{ old('name_arabic') }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cr_number" class="form-label">CR Number</label>
                                            <input type="text" class="form-control" id="cr_number" name="cr_number" maxlength="50" value="{{ old('cr_number') }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="vat_number" class="form-label">VAT Number (English)</label>
                                            <input type="text" class="form-control" id="vat_number" name="vat_number" maxlength="50" value="{{ old('vat_number') }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="vat_number_arabic" class="form-label">VAT Number (Arabic)</label>
                                            <input type="text" class="form-control" id="vat_number_arabic" name="vat_number_arabic" value="{{ old('vat_number_arabic') }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Information -->
                                <div class="bg-light p-4 rounded mb-4">
                                    <h4 class="mb-3">Contact Information</h4>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="cell" class="form-label">Cell Phone</label>
                                            <input type="tel" class="form-control" id="cell" name="cell" maxlength="20" value="{{ old('cell') }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="mobile" class="form-label">Mobile</label>
                                            <input type="tel" class="form-control" id="mobile" name="mobile" maxlength="20" value="{{ old('mobile') }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="tel" class="form-control" id="phone" name="phone" maxlength="20" value="{{ old('phone') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="country" class="form-label">Country</label>
                                            <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Business Details -->
                                <div class="bg-light p-4 rounded mb-4">
                                    <h4 class="mb-3">Business Contact Information</h4>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="customer_industry" class="form-label">Customer Industry</label>
                                            <select class="form-select" id="customer_industry" name="customer_industry">
                                                <option value="">Select Industry</option>
                                                <option value="Regular" {{ old('customer_industry') == 'Regular' ? 'selected' : '' }}>Regular</option>
                                                <option value="Industrial" {{ old('customer_industry') == 'Industrial' ? 'selected' : '' }}>Industrial</option>
                                                <option value="Commercial" {{ old('customer_industry') == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="sale_type" class="form-label">Sale Type</label>
                                            <select class="form-select" id="sale_type" name="sale_type">
                                                <option value="">Select Sale Type</option>
                                                <option value="Manual" {{ old('sale_type') == 'Manual' ? 'selected' : '' }}>Manual</option>
                                                <option value="Automated" {{ old('sale_type') == 'Automated' ? 'selected' : '' }}>Automated</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="article_no" class="form-label">Document Prefix</label>
                                            <input type="text" class="form-control" id="article_no" name="article_no" value="{{ old('article_no') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="business_type_english" class="form-label">Business Type (English)</label>
                                            <input type="text" class="form-control" id="business_type_english" name="business_type_english" value="{{ old('business_type_english') }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="business_type_arabic" class="form-label">Business Type (Arabic)</label>
                                            <input type="text" class="form-control" id="business_type_arabic" name="business_type_arabic" value="{{ old('business_type_arabic') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="business_description_english" class="form-label">Business Description (English)</label>
                                            <textarea class="form-control" id="business_description_english" name="business_description_english" rows="3">{{ old('business_description_english') }}</textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="business_description_arabic" class="form-label">Business Description (Arabic)</label>
                                            <textarea class="form-control" id="business_description_arabic" name="business_description_arabic" rows="3">{{ old('business_description_arabic') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Invoice Settings -->
                                <div class="bg-light p-4 rounded mb-4">
                                    <h4 class="mb-3">Invoice Settings</h4>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="invoice_side_english" class="form-label">Invoice Side (English)</label>
                                            <input type="text" class="form-control" id="invoice_side_english" name="invoice_side_english" value="{{ old('invoice_side_english') }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="invoice_side_arabic" class="form-label">Invoice Side (Arabic)</label>
                                            <input type="text" class="form-control" id="invoice_side_arabic" name="invoice_side_arabic" value="{{ old('invoice_side_arabic') }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="english_description" class="form-label">English Description</label>
                                            <input type="text" class="form-control" id="english_description" name="english_description" value="{{ old('english_description') }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="arabic_description" class="form-label">Arabic Description</label>
                                            <input type="text" class="form-control" id="arabic_description" name="arabic_description" value="{{ old('arabic_description') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="vat_percentage" class="form-label">VAT Percentage</label>
                                            <input type="number" class="form-control" id="vat_percentage" name="vat_percentage" step="0.01" min="0" max="100" value="{{ old('vat_percentage') }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="apply_discount_type" class="form-label">Discount Type</label>
                                            <select class="form-select" id="apply_discount_type" name="apply_discount_type">
                                                <option value="">Select Discount Type</option>
                                                <option value="Before" {{ old('apply_discount_type') == 'Before' ? 'selected' : '' }}>Before</option>
                                                <option value="After" {{ old('apply_discount_type') == 'After' ? 'selected' : '' }}>After</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="language" class="form-label">Language</label>
                                            <select class="form-select" id="language" name="language">
                                                <option value="">Select Language</option>
                                                <option value="english" {{ old('language') == 'english' ? 'selected' : '' }}>English</option>
                                                <option value="arabic" {{ old('language') == 'arabic' ? 'selected' : '' }}>Arabic</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="show_email_on_invoice" name="show_email_on_invoice" {{ old('show_email_on_invoice') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="show_email_on_invoice">Show Email on Invoice</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Information (Updated) -->
                                <div class="bg-light p-4 rounded mb-4">
                                    <h4 class="mb-3">Additional Information</h4>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="website" class="form-label">Website</label>
                                            <input type="url" class="form-control" id="website" name="website" value="{{ old('website') }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="company_type" class="form-label">Company Type</label>
                                            <select class="form-select" id="company_type" name="company_type">
                                                <option value="customer" {{ old('company_type', 'customer') == 'customer' ? 'selected' : '' }}>Customer</option>
{{--                                                <option value="vendor" {{ old('company_type') == 'vendor' ? 'selected' : '' }}>Vendor</option>--}}
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="bank_name" class="form-label">Bank Name</label>
                                            <input type="text" class="form-control" id="bank_name" name="bank_name" value="{{ old('bank_name') }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="iban" class="form-label">IBAN</label>
                                            <input type="text" class="form-control" id="iban" name="iban" maxlength="50" value="{{ old('iban') }}">
                                        </div>

                                        <!-- New File Upload Sections -->
                                        <div class="col-md-6 mb-3">
                                            <label for="company_logo" class="form-label">Company Logo</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control @error('company_logo') is-invalid @enderror"
                                                       id="company_logo"
                                                       name="company_logo"
                                                       accept="image/*">
                                                <label class="input-group-text" for="company_logo">
                                                    <i class="bi bi-upload me-2"></i>Upload
                                                </label>
                                                @error('company_logo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <small class="form-text text-muted">
                                                Accepted formats: PNG, JPG, JPEG, GIF, WEBP (Max 5MB)
                                            </small>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="company_stamp" class="form-label">Company Stamp</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control @error('company_stamp') is-invalid @enderror"
                                                       id="company_stamp"
                                                       name="company_stamp"
                                                       accept="image/*">
                                                <label class="input-group-text" for="company_stamp">
                                                    <i class="bi bi-upload me-2"></i>Upload
                                                </label>
                                                @error('company_stamp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <small class="form-text text-muted">
                                                Accepted formats: PNG, JPG, JPEG, GIF, WEBP (Max 5MB)
                                            </small>
                                        </div>

                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn-shadow btn-wide btn btn-success btn-lg">Submit Registration</button>
                                </div>
                            </div>
                        </form>


                </div>
            </div>
        @else
            @include('includes.sidebar')
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title app-page-title-simple">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div>
                                    <div class="page-title-head center-elem">
                                            <span class="d-inline-block pe-2">
                                                <i class="lnr-apartment opacity-6"></i>
                                            </span>
                                        <span class="d-inline-block">@yield('page_title', 'Minimal Dashboard')</span>
                                    </div>
                                    <div class="page-title-subheading opacity-10">
                                        <nav class="" aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item">
                                                    <a>
                                                        <i aria-hidden="true" class="fa fa-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a>@yield('page_subtitle','Dashboards')</a>
                                                </li>
                                                <li class="active breadcrumb-item" aria-current="page">
                                                    @yield('page_actions','Minimal Dashboard Example')
                                                </li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Flash Messages -->
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @yield('content')

                </div>




                @include('includes.footer')
            </div>
        @endif
    </div>




</div>
</div>
@include('includes.scripts')
</body>
</html>



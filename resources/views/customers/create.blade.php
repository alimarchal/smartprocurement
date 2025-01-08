@extends('layouts.appbs')
@push('styles')
    <link rel="stylesheet" href="{{ asset('architectui/vendors/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('architectui/vendors/ionicons-npm/css/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('architectui/vendors/linearicons-master/dist/web-font/style.css') }}">
    <link rel="stylesheet" href="{{ asset('architectui/vendors/pixeden-stroke-7-icon-master/pe-icon-7-stroke/dist/pe-icon-7-stroke.css') }}">
    <link href="{{ asset('architectui/styles/css/base.css') }}" rel="stylesheet">
@endpush

@section('title', 'Dashboards')

@section('page_title')
    <div class="d-flex align-items-center">
        <i class="pe-7s-display1 icon-gradient bg-premium-dark me-2 font-size-xl"></i>
        Minimal Dashboard
    </div>
@endsection

@section('page_subtitle')
    Dashboards
@endsection

@section('page_actions')
    Company Registration
@endsection



@section('content')
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="main-card mb-3 card">

                        {{--                        @if(Auth::user()->is_company_set == "No")--}}
                        @if(1)
                            <form action="{{ route('companies.store') }}" method="POST" class="card">
                                @csrf
                                <div class="card-body">
                                    <h3 class="card-title text-center mb-4">Company Registration Form</h3>

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
                                        <h4 class="mb-3">Business Details</h4>
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
                                                <label for="article_no" class="form-label">Article No</label>
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

                                    <!-- Additional Information -->
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
                                                    <option value="vendor" {{ old('company_type') == 'vendor' ? 'selected' : '' }}>Vendor</option>
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
                                        </div>
                                    </div>


                                    <div class="text-center">
                                        <button  type="submit"  class="btn-shadow btn-wide btn btn-success btn-lg">Submit Registration</button>
                                    </div>

                                    {{--                        <div class="text-center">--}}
                                    {{--                            <button type="submit" class="btn btn-primary btn-lg">Submit Registration</button>--}}
                                    {{--                        </div>--}}
                                </div>
                            </form>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-scripts')
    <!-- plugin dependencies -->
    <script type="text/javascript" src="{{ asset('architectui/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('architectui/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('architectui/vendors/moment/moment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('architectui/vendors/metismenu/dist/metisMenu.js') }}"></script>
    <script type="text/javascript" src="{{ asset('architectui/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('architectui/vendors/jquery-circle-progress/dist/circle-progress.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('architectui/vendors/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('architectui/vendors/toastr/build/toastr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('architectui/vendors/jquery.fancytree/dist/jquery.fancytree-all-deps.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('architectui/vendors/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('architectui/vendors/smartwizard/dist/js/jquery.smartWizard.min.js') }}"></script>

    <!-- custome.js -->
    <script type="text/javascript" src="{{ asset('architectui/js/charts/apex-charts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('architectui/js/circle-progress.js') }}"></script>
    <script type="text/javascript" src="{{ asset('architectui/js/demo.js') }}"></script>
    <script type="text/javascript" src="{{ asset('architectui/js/scrollbar.js') }}"></script>
    <script type="text/javascript" src="{{ asset('architectui/js/toastr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('architectui/js/treeview.js') }}"></script>
    <script type="text/javascript" src="{{ asset('architectui/js/form-components/toggle-switch.js') }}"></script>

    <script type="text/javascript" src="{{ asset('architectui/js/form-components/form-wizard.js') }}"></script>
    <script type="text/javascript" src="{{ asset('architectui/js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Basic SmartWizard initialization (you'll need to include SmartWizard library)
            $('#smartwizard').smartWizard({
                theme: 'default',
                toolbarSettings: {
                    toolbarPosition: 'bottom',
                    toolbarButtonPosition: 'end',
                    showNextButton: false,
                    showPreviousButton: false
                }
            });

            // Custom navigation button handlers
            $('#next-btn').on('click', function() {
                $('#smartwizard').smartWizard("next");
            });

            $('#prev-btn').on('click', function() {
                $('#smartwizard').smartWizard("prev");
            });
        });
    </script>
@endpush

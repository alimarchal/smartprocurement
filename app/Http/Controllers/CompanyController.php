<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;


class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('contacts')
            ->orderBy('name')
            ->paginate(10);
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(StoreCompanyRequest $request)
    {

        $validatedData = $request->validated();
        // Merge user ID into validated data
        $validatedData['user_id'] = auth()->id();

        // Handle file uploads
        if ($request->hasFile('company_logo')) {
            $logoFile = $request->file('company_logo');
            $logoName = time() . '_logo_' . $logoFile->getClientOriginalName();
            $logoPath = $logoFile->storeAs('company_logos', $logoName, 'public');
            $validatedData['company_logo'] = $logoPath;
        }

        if ($request->hasFile('company_stamp')) {
            $stampFile = $request->file('company_stamp');
            $stampName = time() . '_stamp_' . $stampFile->getClientOriginalName();
            $stampPath = $stampFile->storeAs('company_stamps', $stampName, 'public');
            $validatedData['company_stamp'] = $stampPath;
        }


        $company = Company::create($validatedData);

        return redirect()->route('companies.edit', $company)
            ->with('success', 'Company created successfully');
    }
    public function show(Company $company)
    {
        $company->load(['contacts', 'quotations', 'deliveryNotes', 'invoices', 'payments']);
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $validatedData = $request->validated();
        // Merge user ID into validated data
        $validatedData['user_id'] = auth()->id();

        // Handle Logo Upload
        if ($request->hasFile('company_logo')) {
            // Delete old logo if exists
            if ($company->company_logo && Storage::disk('public')->exists($company->company_logo)) {
                Storage::disk('public')->delete($company->company_logo);
            }

            $logoFile = $request->file('company_logo');
            $logoName = time() . '_logo_' . $logoFile->getClientOriginalName();
            $logoPath = $logoFile->storeAs('company_logos', $logoName, 'public');
            $validatedData['company_logo'] = $logoPath;
        }

        // Handle Stamp Upload
        if ($request->hasFile('company_stamp')) {
            // Delete old stamp if exists
            if ($company->company_stamp && Storage::disk('public')->exists($company->company_stamp)) {
                Storage::disk('public')->delete($company->company_stamp);
            }

            $stampFile = $request->file('company_stamp');
            $stampName = time() . '_stamp_' . $stampFile->getClientOriginalName();
            $stampPath = $stampFile->storeAs('company_stamps', $stampName, 'public');
            $validatedData['company_stamp'] = $stampPath;
        }

        $company->update($validatedData); // Changed this line
        return redirect()->route('companies.edit', $company)
            ->with('success', 'Company updated successfully');
    }
    public function destroy(Company $company)
    {
        if ($company->quotations()->exists() || $company->invoices()->exists()) {
            return back()->with('error', 'Cannot delete company with associated records');
        }
        $company->delete();
        return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully');
    }
}

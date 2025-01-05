<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;

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
        $company = Company::create($request->validated());
        return redirect()->route('companies.show', $company)
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
        $company->update($request->validated());
        return redirect()->route('companies.show', $company)
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

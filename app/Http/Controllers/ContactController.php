<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use App\Models\Company;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('company')
            ->orderBy('name')
            ->paginate(10);
        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        $companies = Company::orderBy('name')->pluck('name', 'id');
        return view('contacts.create', compact('companies'));
    }

    public function store(StoreContactRequest $request)
    {
        $contact = Contact::create($request->validated());
        return redirect()->route('contacts.show', $contact)
            ->with('success', 'Contact created successfully');
    }

    public function show(Contact $contact)
    {
        $contact->load('company', 'deliveryNotesReceived', 'deliveryNotesDelivered');
        return view('contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        $companies = Company::orderBy('name')->pluck('name', 'id');
        return view('contacts.edit', compact('contact', 'companies'));
    }

    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $contact->update($request->validated());
        return redirect()->route('contacts.show', $contact)
            ->with('success', 'Contact updated successfully');
    }

    public function destroy(Contact $contact)
    {
        if ($contact->deliveryNotesReceived()->exists() || $contact->deliveryNotesDelivered()->exists()) {
            return back()->with('error', 'Cannot delete contact with associated delivery notes');
        }
        $contact->delete();
        return redirect()->route('contacts.index')
            ->with('success', 'Contact deleted successfully');
    }
}

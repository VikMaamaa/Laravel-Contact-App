<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index() {

        $user = auth()->user();
        $companies = $user->companies()->orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
        // \DB::enableQueryLog();
        $contacts = $user->contacts()->latestFirst()->paginate(10);
        // dd(\DB::getQuerylog());
        // dd($contacts);
        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function create() {
        $contact = new Contact();
        $companies = auth()->user()->companies()->orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');

        return view('contacts.create', compact('companies', 'contact'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // dd(auth()->user()->id);
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'company_id' => 'required|exists:companies,id',
        ]);

        $request->user()->contacts()->create($request->all());
        // dd($request->all());

        return redirect()->route('contacts.index')->with('message',"Contact has been added successfully");
    }

    public function edit(Contact $contact) {
        // $contact = Contact::findOrFail($id);
        $companies = auth()->user()->companies()->orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');

        return view('contacts.edit', compact('companies', 'contact'));
    }

    public function update(Contact $contact, Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'company_id' => 'required|exists:companies,id',
        ]);

        // $contact = Contact::findOrfail($id);
        $contact->update($request->all());
        // dd($request->all());

        return redirect()->route('contacts.index')->with('message',"Contact has been updated successfully");
    }

    public function show(Contact $contact) {
        //  $contact  = $id;
        return view('contacts.show', compact('contact'));
    }

    public function destroy(Contact $contact) {
        // $contact = Contact::findOrFail($id);
        $contact->delete();

        return back()->with('message', 'Contact has been deleted successfully');
    }
}

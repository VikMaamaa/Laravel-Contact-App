<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
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


        $companies = Company::userCompanies();
        // \DB::enableQueryLog();
        $contacts = auth()->user()->contacts()->latestFirst()->paginate(10);
        // dd(\DB::getQuerylog());
        // dd($contacts);
        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function create() {
        $contact = new Contact();
        $companies = Company::userCompanies();

        return view('contacts.create', compact('companies', 'contact'));
    }



    public function store(ContactRequest $request)
    {
        // dd($request->all());
        // dd(auth()->user()->id);


        $request->user()->contacts()->create($request->all());
        // dd($request->all());

        return redirect()->route('contacts.index')->with('message',"Contact has been added successfully");
    }

    protected function validationRules()
    {

       return [

       ];
    }


    public function edit(Contact $contact) {
        // $contact = Contact::findOrFail($id);
        $companies = Company::userCompanies();

        return view('contacts.edit', compact('companies', 'contact'));
    }

    public function update(Contact $contact, ContactRequest $request){
        $request->validate($this->validationRules());

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

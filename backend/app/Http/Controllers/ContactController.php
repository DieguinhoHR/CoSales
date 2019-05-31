<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Contact::orderBy('created_at', 'DESC')->get();
    }

    public function show($id)
    {
        return Contact::find($id);
    }

    public function store(ContactRequest $request)
    {
        return Contact::create($request->all());
    }

    public function update(ContactRequest $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $contact->update($request->all());

        return $contact;
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);

        $contact->delete();

        return 204;
    }
}

<?php

namespace App\Http\Controllers;

use App\Contact;
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
        return Contact::all();
    }

    public function show($id)
    {
        return Contact::find($id);
    }

    public function store(Request $request)
    {
        return Contact::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $article = Contact::findOrFail($id);

        $article->update($request->all());

        return $article;
    }

    public function delete(Request $request, $id)
    {
        $article = Contact::findOrFail($id);

        $article->delete();

        return 204;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Person;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index($personId) {
        $person = Person::findOrFail($personId);
        return $person->contacts;
    }

    public function store(Request $request, $personId) {
        $person = Person::findOrFail($personId);
        $contact = $person->contacts()->create($request->all());
        return response()->json($contact, 201);
    }

    public function show($personId, $contactId) {
        return Contact::where('person_id', $personId)->findOrFail($contactId);
    }

    public function update(Request $request, $personId, $contactId) {
        $contact = Contact::where('person_id', $personId)->findOrFail($contactId);
        $contact->update($request->all());
        return response()->json($contact, 200);
    }

    public function destroy($personId, $contactId) {
        $contact = Contact::where('person_id', $personId)->findOrFail($contactId);
        $contact->delete();
        return response()->json(null, 204);
    }
}

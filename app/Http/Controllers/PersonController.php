<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Contact;
use App\Models\ContactType;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index() {
        $people = Person::with('contacts')->get();
        return response()->json($people);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome' => 'required|string|max:255',
                'idade' => 'required|integer',
                'email' => 'required|email',
                'contacts' => 'required|array',
                'contacts.*.type' => 'required|string',
                'contacts.*.value' => 'required|string',
            ]);

            // Cria uma nova pessoa
            $person = Person::create($request->only('nome', 'idade', 'email'));

            // Cria os contatos associados
            foreach ($request->contacts as $contact) {
                $person->contacts()->create($contact);
            }

            return response()->json($person->load('contacts'), 201);
        } catch (\Exception $e) {
            // Retorna o erro
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        $person = Person::with('contacts')->findOrFail($id);
        return response()->json($person);
    }

    public function update(Request $request, $id) {
        // Validação dos dados
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'idade' => 'required|integer',
            'email' => 'required|email',
            'contacts' => 'array', 
            'contacts.*.type' => 'required|string',
            'contacts.*.value' => 'required|string',
        ]);

        $person = Person::find($id);

        if (!$person) {
            return response()->json(['message' => 'Pessoa não encontrada'], 404);
        }

        $person->update([
            'nome' => $validatedData['nome'],
            'idade' => $validatedData['idade'],
            'email' => $validatedData['email'],
        ]);

        // Atualizar contatos associados
        if (isset($validatedData['contacts'])) {
            $person->contacts()->delete();

            foreach ($validatedData['contacts'] as $contactData) {
                $person->contacts()->create($contactData);
            }
        }

        return response()->json($person->load('contacts'), 200);
    }

    public function destroy($id)
    {
        $person = Person::findOrFail($id);
        $person->delete();

        return response()->json(['message' => 'Pessoa excluída com sucesso']);
    }

     public function getTypes()
    {
        $types = ContactType::all();
        return response()->json($types);
    }
}

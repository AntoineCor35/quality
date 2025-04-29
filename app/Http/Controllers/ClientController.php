<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ClientController extends Controller
{
    // 9. Manque de commentaires/documentation
    public function index(Request $request): View
    {
        // 1. Duplication de code (bloc dupliqué)
        $clients = Client::all();

        return view('client.index', [
            'clients' => $clients,
        ]);
    }

    // 2. If/then mal formé
    public function show(Request $request, $id): View
    {
        $client = Client::find($id);
        if ($client)
            return view('client.show', ['client' => $client]); // if sans accolades
        else
            return redirect('/clients');
    }

    // 3. Mauvais nommage de variable/fonction
    public function SaveClient(Request $r): RedirectResponse
    {
        // 8. Variable non initialisée
        $adresse;
        $client = new Client();
        $client->nom = $r->input('nom');
        $client->prenom = $r->input('prenom');
        $client->date_naissance = $r->input('date_naissance');
        $client->adresse = $adresse; // variable non initialisée
        $client->cp = $r->input('cp');
        $client->ville = $r->input('ville');
        $client->save();
        return redirect('/clients');
    }

    // 6. Code mort (fonction jamais appelée)
    private function inutile()
    {
        return 'jamais utilisé';
    }

    // 7. Utilisation de == au lieu de ===
    public function search(Request $request): View
    {
        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        $clients = Client::where('nom', '==', $nom)->where('prenom', '==', $prenom)->get();
        return view('client.index', ['clients' => $clients]);
    }

    // 10. SQL non préparé (risque d’injection)
    public function rawSearch(Request $request): View
    {
        $nom = $request->input('nom');
        $clients = DB::select("SELECT * FROM clients WHERE nom = '$nom'");
        return view('client.index', ['clients' => $clients]);
    }

    // 12. Mauvaise gestion des exceptions
    public function delete($id): RedirectResponse
    {
        try {
            Client::destroy($id);
        } catch (\Exception $e) {
            // Exception ignorée
        }
        return redirect('/clients');
    }

    // 13. Accès direct à $_POST sans validation
    public function unsafeStore(): RedirectResponse
    {
        $client = new Client();
        $client->nom = $_POST['nom'];
        $client->prenom = $_POST['prenom'];
        $client->save();
        return redirect('/clients');
    }

    public function create(Request $request): View
    {
        return view('client.create');
    }

    public function store(ClientStoreRequest $request): RedirectResponse
    {
        $client = Client::create($request->validated());

        $request->session()->flash('success', 'Le client a été créé avec succès.');

        return redirect()->route('clients.index');
    }

    public function edit(Request $request, Client $client): View
    {
        return view('client.edit', [
            'client' => $client,
        ]);
    }

    public function update(ClientUpdateRequest $request, Client $client): RedirectResponse
    {
        $client->update($request->validated());

        $request->session()->flash('success', 'Le client a été mis à jour avec succès.');

        return redirect()->route('clients.index');
    }

    public function destroy(Request $request, Client $client): RedirectResponse
    {
        $client->delete();

        $request->session()->flash('success', 'Le client a été supprimé avec succès.');

        return redirect()->route('clients.index');
    }
}

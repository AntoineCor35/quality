@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Liste des Clients</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('clients.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nouveau Client
            </a>
        </div>
    </div>

    @if ($clients->isEmpty())
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Aucun client n'a été trouvé.
            <a href="{{ route('clients.create') }}" class="alert-link">Ajouter un client</a>
        </div>
    @else
        <div class="row">
            @foreach ($clients as $client)
                <div class="col-md-4">
                    <div class="card client-card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">
                                {{ $client->prenom }} {{ $client->nom }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="client-info">
                                <i class="fas fa-calendar"></i>
                                <strong>Date de naissance:</strong>
                                {{ $client->date_naissance ? $client->date_naissance->format('d/m/Y') : 'Non renseignée' }}
                            </div>

                            <div class="client-info">
                                <i class="fas fa-map-marker-alt"></i>
                                <strong>Adresse:</strong>
                                {{ $client->adresse ?: 'Non renseignée' }}
                            </div>

                            <div class="client-info">
                                <i class="fas fa-mail-bulk"></i>
                                <strong>Code postal:</strong>
                                {{ $client->code_postal ?: 'Non renseigné' }}
                            </div>

                            <div class="client-info">
                                <i class="fas fa-city"></i>
                                <strong>Ville:</strong>
                                {{ $client->ville ?: 'Non renseignée' }}
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <div class="btn-group w-100">
                                <a href="{{ route('clients.show', $client) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Détails
                                </a>
                                <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

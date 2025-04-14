@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Détails du Client</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour à la liste
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">{{ $client->prenom }} {{ $client->nom }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <h5 class="border-bottom pb-2">Informations personnelles</h5>
                        <div class="client-info">
                            <i class="fas fa-user"></i>
                            <strong>Nom:</strong> {{ $client->nom }}
                        </div>
                        <div class="client-info">
                            <i class="fas fa-user"></i>
                            <strong>Prénom:</strong> {{ $client->prenom }}
                        </div>
                        <div class="client-info">
                            <i class="fas fa-calendar"></i>
                            <strong>Date de naissance:</strong>
                            {{ $client->date_naissance ? $client->date_naissance->format('d/m/Y') : 'Non renseignée' }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <h5 class="border-bottom pb-2">Adresse</h5>
                        <div class="client-info">
                            <i class="fas fa-map-marker-alt"></i>
                            <strong>Adresse:</strong> {{ $client->adresse ?: 'Non renseignée' }}
                        </div>
                        <div class="client-info">
                            <i class="fas fa-mail-bulk"></i>
                            <strong>Code postal:</strong> {{ $client->code_postal ?: 'Non renseigné' }}
                        </div>
                        <div class="client-info">
                            <i class="fas fa-city"></i>
                            <strong>Ville:</strong> {{ $client->ville ?: 'Non renseignée' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-light">
            <div class="btn-group">
                <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Modifier
                </a>
                <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ClientController
 */
final class ClientControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $clients = Client::factory()->count(3)->create();

        $response = $this->get(route('clients.index'));

        $response->assertOk();
        $response->assertViewIs('client.index');
        $response->assertViewHas('clients');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('clients.create'));

        $response->assertOk();
        $response->assertViewIs('client.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ClientController::class,
            'store',
            \App\Http\Requests\ClientStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $nom = fake()->word();
        $prenom = fake()->word();
        $date_naissance = Carbon::parse(fake()->date());
        $adresse = fake()->word();
        $code_postal = fake()->word();
        $ville = fake()->word();

        $response = $this->post(route('clients.store'), [
            'nom' => $nom,
            'prenom' => $prenom,
            'date_naissance' => $date_naissance->toDateString(),
            'adresse' => $adresse,
            'code_postal' => $code_postal,
            'ville' => $ville,
        ]);

        $clients = Client::query()
            ->where('nom', $nom)
            ->where('prenom', $prenom)
            ->where('date_naissance', $date_naissance)
            ->where('adresse', $adresse)
            ->where('code_postal', $code_postal)
            ->where('ville', $ville)
            ->get();
        $this->assertCount(1, $clients);
        $client = $clients->first();

        $response->assertRedirect(route('clients.index'));
        $response->assertSessionHas('client.id', $client->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $client = Client::factory()->create();

        $response = $this->get(route('clients.show', $client));

        $response->assertOk();
        $response->assertViewIs('client.show');
        $response->assertViewHas('client');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $client = Client::factory()->create();

        $response = $this->get(route('clients.edit', $client));

        $response->assertOk();
        $response->assertViewIs('client.edit');
        $response->assertViewHas('client');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ClientController::class,
            'update',
            \App\Http\Requests\ClientUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $client = Client::factory()->create();
        $nom = fake()->word();
        $prenom = fake()->word();
        $date_naissance = Carbon::parse(fake()->date());
        $adresse = fake()->word();
        $code_postal = fake()->word();
        $ville = fake()->word();

        $response = $this->put(route('clients.update', $client), [
            'nom' => $nom,
            'prenom' => $prenom,
            'date_naissance' => $date_naissance->toDateString(),
            'adresse' => $adresse,
            'code_postal' => $code_postal,
            'ville' => $ville,
        ]);

        $client->refresh();

        $response->assertRedirect(route('clients.index'));
        $response->assertSessionHas('client.id', $client->id);

        $this->assertEquals($nom, $client->nom);
        $this->assertEquals($prenom, $client->prenom);
        $this->assertEquals($date_naissance, $client->date_naissance);
        $this->assertEquals($adresse, $client->adresse);
        $this->assertEquals($code_postal, $client->code_postal);
        $this->assertEquals($ville, $client->ville);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $client = Client::factory()->create();

        $response = $this->delete(route('clients.destroy', $client));

        $response->assertRedirect(route('clients.index'));

        $this->assertModelMissing($client);
    }
}

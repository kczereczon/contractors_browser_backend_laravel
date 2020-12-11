<?php

namespace Tests\Unit;

use App\Models\Contact;
use App\Models\Contractor;
use App\Models\Departament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    protected $model = Contact::class;

    public function testGetContacts()
    {
        $this->createContact();

        $response = $this->json('GET', '/api/web/contact');
        $response->assertStatus(200);
        $response->assertJsonPath('total', 1);
    }

    public function testGetContactsExternalApi()
    {
        $this->createContact();

        $response = $this->json('GET', '/api/contact');
        $response->assertStatus(200);
    }

    public function testCreateContact()
    {
        $contactFaked = Contact::factory()->make()->toArray();

        $response = $this->json('POST', '/api/web/contact', array_merge(["contact" => $contactFaked]));
        $response->assertStatus(200);
    }

    public function testCreateContactMissingData()
    {
        $contactFaked = Contact::factory()->make()->toArray();

        $response = $this->json('POST', '/api/web/contact', ["contact" => $contactFaked]);
        $response->assertStatus(422);
    }

    public function testGetExistingContact()
    {
        $contact = $this->createContact();

        $response = $this->json('GET', '/api/web/contact/' . $contact->id);
        $response->assertStatus(200);
    }


    public function testGetNotExistingContact()
    {
        $response = $this->json('GET', '/api/web/contact/' . rand(0,100));
        $response->assertStatus(404);
    }

    public function testGetNotExistingContactExternalApi()
    {
        $response = $this->json('GET', '/api/contact/' . rand(0,100));
        $response->assertStatus(404);
    }

    public function testUpdateContact()
    {
        $contact = $this->createContact();
        $contactFaked = Contact::factory()->make()->toArray();

        $response = $this->json('PUT', '/api/web/contact/' . $contact->id, $contactFaked);
        $response->assertStatus(200);
    }

    public function testDeleteContact()
    {
        $contact = $this->createContact();

        $response = $this->json('DELETE', '/api/web/contact/' . $contact->id);
        $response->assertStatus(200);

        $response = $this->json('GET', '/api/web/contact/' . $contact->id);
        $response->assertStatus(404);
    }

    public function createContact()
    {
        return Contact::factory()->create();
    }
}

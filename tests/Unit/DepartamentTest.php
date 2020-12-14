<?php

namespace Tests\Unit;

use App\Models\Contact;
use App\Models\Contractor;
use App\Models\Departament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepartamentTest extends TestCase
{
    use RefreshDatabase;

    protected $model = Departament::class;

    public function testGetDepartaments()
    {
        $this->createDepartament();

        $response = $this->json('GET', '/api/web/departament');
        $response->assertStatus(200);
        $response->assertJsonPath('total', 1);
    }


    public function testCreateDepartament()
    {   
        $contractorFaked = Contractor::factory()->create();
        $contactFaked = Contact::factory()->make()->toArray();
        $departamentFaked = Departament::factory()->make()->toArray();

        $response = $this->json('POST', '/api/web/departament', array_merge(["departament" => array_merge(["contractor_id" => $contractorFaked->id], $departamentFaked)], ["contact" => $contactFaked]));
        $response->assertStatus(200);
    }

    public function testCreateDepartamentMissingData()
    {
        $departamentFaked = Departament::factory()->make()->toArray();

        $response = $this->json('POST', '/api/web/departament', ["departament" => $departamentFaked]);
        $response->assertStatus(422);
    }

    public function testGetExistingdepartament()
    {
        $departament = $this->createDepartament();

        $response = $this->json('GET', '/api/web/departament/' . $departament->id);
        $response->assertStatus(200);
    }

    public function testGetNotExistingDepartament()
    {
        $response = $this->json('GET', '/api/web/departament/' . rand(0,100));
        $response->assertStatus(404);
    }

    
    public function testGetNotExistingDepartamentExternalApi()
    {
        $response = $this->json('GET', '/api/departament/' . rand(0,100));
        $response->assertStatus(404);
    }

    public function testUpdateDepartament()
    {
        $departament = $this->createDepartament();
        $departamentFaked = Departament::factory()->make()->toArray();

        $response = $this->json('PUT', '/api/web/departament/' . $departament->id, $departamentFaked);
        $response->assertStatus(200);
    }

    public function testDeleteDepartament()
    {
        $departament = $this->createDepartament();

        $response = $this->json('DELETE', '/api/web/departament/' . $departament->id);
        $response->assertStatus(200);

        $response = $this->json('GET', '/api/web/departament/' . $departament->id);
        $response->assertStatus(404);
    }

    public function testGetContractorDepartament()
    {
        $departament = $this->createDepartament();

        $response = $this->json('GET', '/api/web/departament/contractor/' . $departament->id);
        $response->assertStatus(200);
    }

    public function testGetDepartamentAll()
    {
        $departament = $this->createDepartament();

        $response = $this->json('GET', '/api/web/departament/all/');
        $response->assertStatus(200);
    } 

    public function createDepartament()
    {
        $contractor = Contractor::factory();
        $contact = Contact::factory()->count(1);
        return Departament::factory()->for($contractor)->has($contact)->create();
    }
   
}
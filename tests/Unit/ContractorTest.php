<?php

namespace Tests\Unit;

use App\Models\Contact;
use App\Models\Contractor;
use App\Models\Departament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContractorTest extends TestCase
{
    use RefreshDatabase;

    protected $model = Contractor::class;

    public function testGetContractors()
    {
        $this->createContractor();

        $response = $this->json('GET', '/api/web/contractor');
        $response->assertStatus(200);
        $response->assertJsonPath('total', 1);
    }

    public function testGetContractorsExternalApi()
    {
        $this->createContractor();

        $response = $this->json('GET', '/api/contractor');
        $response->assertStatus(200);
    }

    public function testCreateContractor()
    {
        $contactFaked = Contact::factory()->make()->toArray();
        $contractorFaked = Contractor::factory()->make()->toArray();
        $departamentFaked = Departament::factory()->make()->toArray();

        $response = $this->json('POST', '/api/web/contractor', array_merge(["contractor" => $contractorFaked], ["departament" => $departamentFaked], ["contact" => $contactFaked]));
        $response->assertStatus(200);
    }

    public function testCreateContractorMissingData()
    {
        $contractorFaked = Contractor::factory()->make()->toArray();

        $response = $this->json('POST', '/api/web/contractor', ["contractor" => $contractorFaked]);
        $response->assertStatus(422);
    }

    public function testGetExistingContractor()
    {
        $contractor = $this->createContractor();

        $response = $this->json('GET', '/api/web/contractor/' . $contractor->id);
        $response->assertStatus(200);
    }

    public function testGetNotExistingContractor()
    {
        $response = $this->json('GET', '/api/web/contractor/' . rand(0,100));
        $response->assertStatus(404);
    }

    public function testGetExistingContractorExternalApiByNip()
    {
        $contractor = $this->createContractor();

        $response = $this->json('GET', '/api/contractor/' . $contractor->nip);
        $response->assertStatus(200);
    }

    public function testGetNotExistingContractorExternalApi()
    {
        $response = $this->json('GET', '/api/contractor/' . rand(0,100));
        $response->assertStatus(404);
    }

    public function testUpdateContractor()
    {
        $contractor = $this->createContractor();
        $contractorFaked = Contractor::factory()->make()->toArray();

        $response = $this->json('PUT', '/api/web/contractor/' . $contractor->id, $contractorFaked);
        $response->assertStatus(200);
    }

    public function testDeleteContractor()
    {
        $contractor = $this->createContractor();

        $response = $this->json('DELETE', '/api/web/contractor/' . $contractor->id);
        $response->assertStatus(200);

        $response = $this->json('GET', '/api/web/contractor/' . $contractor->id);
        $response->assertStatus(404);
    }

    public static function createContractor()
    {
        $contact = Contact::factory()->count(1);
        $departament = Departament::factory()->has($contact)->state(["is_main" => true])->count(1);
        return Contractor::factory()->has($departament)->create();
    }
}

<?php

namespace Tests\Unit;

use App\Models\Contractor;
use App\Models\Departament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContractorTest extends TestCase
{
    use RefreshDatabase;

    protected $model = Contractor::class;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testCreateContractor()
    {
        $contractorFaked = Contractor::factory()->make()->toArray();
        $departamentFaked = Departament::factory()->make()->toArray();

        $response = $this->json('POST', '/api/web/contractor', array_merge($contractorFaked, $departamentFaked));
        $response->assertStatus(200);
    }
}

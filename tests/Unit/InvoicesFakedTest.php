<?php

namespace Tests\Unit;

use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class InvoicesFakedTest extends TestCase
{
    use RefreshDatabase;
    // {
    //     ID,
    //     Numer_faktury,
    //     NIP,
    //     Status,
    //     Data_płatności,
    //     Wartosc_faktury_brutto
    //    }
    public function testGetInvoices()
    {
        
        $id = ContractorTest::createContractor()->id;
        /** @var TestResponse $response */
        $response = $this->get("/api/invoices/".$id);
        $response = $this->assertJsonStructure($response);
    }

    public function testGetInvoicesFrom()
    {
        $id = ContractorTest::createContractor()->id;
        $dateFrom = new DateTime();
        $dateFrom = $dateFrom->format('Y-m-d');

        /** @var TestResponse $response */
        $response = $this->get("/api/invoices/".$id."?data_od=$dateFrom");
        $response = $this->assertJsonStructure($response);

        $decodedResponse = json_decode($response->baseResponse->content(), true);

        foreach ($decodedResponse as $invoice) {
            $this->assertGreaterThanOrEqual(
                strtotime($dateFrom),
                strtotime($invoice['Data_płatności'])
            );
        }
    }

    public function testGetInvoicesTo()
    {
        $id = ContractorTest::createContractor()->id;
        $dateTo = new DateTime();
        $dateTo = $dateTo->format('Y-m-d');

        /** @var TestResponse $response */
        $response = $this->get("/api/invoices/".$id."?data_do=$dateTo");
        $response = $this->assertJsonStructure($response);

        $decodedResponse = json_decode($response->baseResponse->content(), true);

        foreach ($decodedResponse as $invoice) {
            $this->assertLessThanOrEqual(
                strtotime($dateTo),
                strtotime($invoice['Data_płatności'])
            );
        }
    }

    public function testGetInvoicesFromTo()
    {
        $id = ContractorTest::createContractor()->id;
        $dateTo = new DateTime('now +1');
        $dateTo = $dateTo->format('Y-m-d');

        $dateFrom = new DateTime('now +14');
        $dateFrom = $dateFrom->format('Y-m-d');

        /** @var TestResponse $response */
        $response = $this->get("/api/invoices/".$id."?data_od=$dateFrom&data_do=$dateTo");
        $response = $this->assertJsonStructure($response);

        $decodedResponse = json_decode($response->baseResponse->content(), true);

        foreach ($decodedResponse as $invoice) {
            $this->assertLessThanOrEqual(
                strtotime($dateTo),
                strtotime($invoice['Data_płatności'])
            );

            $this->assertGreaterThanOrEqual(
                strtotime($dateFrom),
                strtotime($invoice['Data_płatności'])
            );
        }
    }

    private function assertJsonStructure(TestResponse $response)
    {
        return $response->assertJsonStructure([
            '*' => [
                "ID",
                "Numer_faktury",
                "NIP",
                "Status",
                "Data_płatności",
                "Wartosc_faktury_brutto"
            ]
        ]);
    }
}

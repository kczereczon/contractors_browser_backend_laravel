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
    //     invoice_date,
    //     Wartosc_faktury_brutto
    //    }
    // public function testGetInvoices()
    // {
        
    //     $id = ContractorTest::createContractor()->id;
    //     /** @var TestResponse $response */
    //     $response = $this->get("/api/web/invoices/".$id);
    //     $response = $this->assertJsonStructure($response);
    // }

    // public function testGetInvoicesFrom()
    // {
    //     $id = ContractorTest::createContractor()->id;
    //     $dateFrom = new DateTime();
    //     $dateFrom = $dateFrom->format('Y-m-d');

    //     /** @var TestResponse $response */
    //     $response = $this->get("/api/web/invoices/".$id."?date_from=$dateFrom");
    //     $response = $this->assertJsonStructure($response);

    //     $decodedResponse = json_decode($response->baseResponse->content(), true);

    //     foreach ($decodedResponse as $invoice) {
    //         $this->assertGreaterThanOrEqual(
    //             strtotime($dateFrom),
    //             strtotime($invoice['invoice_date'])
    //         );
    //     }
    // }

    // public function testGetInvoicesTo()
    // {
    //     $id = ContractorTest::createContractor()->id;
    //     $dateTo = new DateTime();
    //     $dateTo = $dateTo->format('Y-m-d');

    //     /** @var TestResponse $response */
    //     $response = $this->get("/api/web/invoices/".$id."?date_to=$dateTo");
    //     $response = $this->assertJsonStructure($response);

    //     $decodedResponse = json_decode($response->baseResponse->content(), true);

    //     foreach ($decodedResponse as $invoice) {
    //         $this->assertLessThanOrEqual(
    //             strtotime($dateTo),
    //             strtotime($invoice['invoice_date'])
    //         );
    //     }
    // }

    public function testGetInvoicesFromTo()
    {
        $id = ContractorTest::createContractor()->id;
        $dateTo = new DateTime('now +1');
        $dateTo = $dateTo->format('Y-m-d');

        $dateFrom = new DateTime('now +14');
        $dateFrom = $dateFrom->format('Y-m-d');

        /** @var TestResponse $response */
        $response = $this->get("/api/web/invoices/".$id."?date_from=$dateFrom&date_to=$dateTo");
        $response = $this->assertJsonStructure($response);

        $decodedResponse = json_decode($response->baseResponse->content(), true);

        foreach ($decodedResponse as $invoice) {
            $this->assertLessThanOrEqual(
                strtotime($dateTo),
                strtotime($invoice['invoice_date'])
            );

            $this->assertGreaterThanOrEqual(
                strtotime($dateFrom),
                strtotime($invoice['invoice_date'])
            );
        }
    }

    private function assertJsonStructure(TestResponse $response)
    {
        return $response->assertJsonStructure([
            '*' => [
                "id",
                "nip",
                "invoice_status",
                "invoice_number",
                "invoice_date",
                "due_date",
                "total",
            ]
        ]);
    }
}

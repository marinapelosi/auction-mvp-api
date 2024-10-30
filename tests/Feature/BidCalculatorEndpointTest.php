<?php

namespace Tests\Feature;

use Tests\TestCase;

class BidCalculatorEndpointTest extends TestCase
{
    protected string $endpoint;

    protected function setUp(): void
    {
        parent::setUp();
        $this->endpoint = '/api/calculate-car-price';
    }

    /**
     * Test scenario with all fees for a common car with price 398
     */
    public function testScenarioWithAllFeesCommonCarWithPrice398()
    {
        $response = $this->postJson($this->endpoint, [
            'price' => 398.00,
            'type' => 'common',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'priceAndFees' => [
                'basicFee' => '39.80',
                'sellerSpecialFee' => '7.96',
                'associationFee' => '5.00',
                'storageFee' => '100.00',
                'total' => '550.76'
            ],
        ]);
    }

    /**
     * Test scenario with all fees for a common car with price 501
     */
    public function testScenarioWithAllFeesCommonCarWithPrice501()
    {
        $response = $this->postJson($this->endpoint, [
            'price' => 501.00,
            'type' => 'common',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'priceAndFees' => [
                'basicFee' => '50.00',
                'sellerSpecialFee' => '10.02',
                'associationFee' => '10.00',
                'storageFee' => '100.00',
                'total' => '671.02'
            ],
        ]);
    }

    /**
     * Test scenario with all fees for a common car with price 57
     */
    public function testScenarioWithAllFeesCommonCarWithPrice57()
    {
        $response = $this->postJson($this->endpoint, [
            'price' => 57.00,
            'type' => 'common',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'priceAndFees' => [
                'basicFee' => '10.00',
                'sellerSpecialFee' => '1.14',
                'associationFee' => '5.00',
                'storageFee' => '100.00',
                'total' => '173.14'
            ],
        ]);
    }

    /**
     * Test scenario with all fees for a luxury car with price 1800
     */
    public function testScenarioWithAllFeesLuxuryCarWithPrice1800()
    {
        $response = $this->postJson($this->endpoint, [
            'price' => 1800.00,
            'type' => 'luxury',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'priceAndFees' => [
                'basicFee' => '180.00',
                'sellerSpecialFee' => '72.00',
                'associationFee' => '15.00',
                'storageFee' => '100.00',
                'total' => '2167.00'
            ],
        ]);
    }

    /**
     * Test scenario with all fees for a common car with price 1100
     */
    public function testScenarioWithAllFeesCommonCarWithPrice1100()
    {
        $response = $this->postJson($this->endpoint, [
            'price' => 1100.00,
            'type' => 'common',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'priceAndFees' => [
                'basicFee' => '50.00',
                'sellerSpecialFee' => '22.00',
                'associationFee' => '15.00',
                'storageFee' => '100.00',
                'total' => '1287.00'
            ],
        ]);
    }

    /**
     * Test scenario with all fees for a luxury car with price 1000000
     */
    public function testScenarioWithAllFeesLuxuryCarWithPrice1000000()
    {
        $response = $this->postJson($this->endpoint, [
            'price' => 1000000.00,
            'type' => 'luxury',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'priceAndFees' => [
                'basicFee' => '200.00',
                'sellerSpecialFee' => '40000.00',
                'associationFee' => '20.00',
                'storageFee' => '100.00',
                'total' => '1040320.00'
            ],
        ]);
    }
}

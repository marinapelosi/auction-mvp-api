<?php

namespace Tests\Feature;

use Tests\TestCase;

class BidControllerTest extends TestCase
{
    protected string $endpoint;

    protected function setUp(): void
    {
        parent::setUp();

        $this->endpoint = '/api/calculate-car-price';
    }

    /**
     * Test validation for missing and invalid fields in the request payload
     */
    public function testValidationErrors()
    {
        // Test case: Missing both fields
        $response = $this->postJson($this->endpoint, []);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['price', 'type']);

        // Test case: Invalid price (non-numeric)
        $response = $this->postJson($this->endpoint, [
            'price' => 'invalid_price',
            'type' => 'common',
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['price']);

        // Test case: Invalid type (not in allowed values)
        $response = $this->postJson($this->endpoint, [
            'price' => 1000.00,
            'type' => 'invalid_type',
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['type']);

        // Test case: Negative price
        $response = $this->postJson($this->endpoint, [
            'price' => -100.00,
            'type' => 'common',
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['price']);

        // Test case: Type with uppercase letters and spaces (should be valid)
        $response = $this->postJson($this->endpoint, [
            'price' => 1000.00,
            'type' => ' Luxury ',
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'priceAndFees' => [
                'basicFee',
                'sellerSpecialFee',
                'associationFee',
                'storageFee',
                'total'
            ]
        ]);
    }


    public function testCalculateCarPriceWithValidData()
    {
        $response = $this->postJson($this->endpoint, [
            'price' => 500.00,
            'type' => 'common',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'priceAndFees' => [
                'basicFee',
                'sellerSpecialFee',
                'associationFee',
                'storageFee',
                'total'
            ]
        ]);
    }

}

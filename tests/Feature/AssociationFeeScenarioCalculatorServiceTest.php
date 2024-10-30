<?php

namespace Tests\Feature;

use App\Services\BidCalculators\FeeRules\AssociationFeeRuleCalculatorService;
use PHPUnit\Framework\TestCase;

class AssociationFeeScenarioCalculatorServiceTest extends TestCase
{
    protected AssociationFeeRuleCalculatorService $associationFeeCalculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->associationFeeCalculator = new AssociationFeeRuleCalculatorService();
    }

    /**
     * Test scenario: Price = 398, Expected Association Fee = 5.00
     */
    public function testAssociationFeeScenarioWithPrice398()
    {
        $price = 398.00;
        $expectedFee = 5.00;

        $calculatedFee = $this->associationFeeCalculator->calculate($price);

        $this->assertEqualsWithDelta($expectedFee, $calculatedFee, 0.01);
    }

    /**
     * Test scenario: Price = 501, Expected Association Fee = 10.00
     */
    public function testAssociationFeeScenarioWithPrice501()
    {
        $price = 501.00;
        $expectedFee = 10.00;

        $calculatedFee = $this->associationFeeCalculator->calculate($price);

        $this->assertEqualsWithDelta($expectedFee, $calculatedFee, 0.01);
    }

    /**
     * Test scenario: Price = 57, Expected Association Fee = 5.00
     */
    public function testAssociationFeeScenarioWithPrice57()
    {
        $price = 57.00;
        $expectedFee = 5.00;

        $calculatedFee = $this->associationFeeCalculator->calculate($price);

        $this->assertEqualsWithDelta($expectedFee, $calculatedFee, 0.01);
    }

    /**
     * Test scenario: Price = 1800, Expected Association Fee = 15.00
     */
    public function testAssociationFeeScenarioWithPrice1800()
    {
        $price = 1800.00;
        $expectedFee = 15.00;

        $calculatedFee = $this->associationFeeCalculator->calculate($price);

        $this->assertEqualsWithDelta($expectedFee, $calculatedFee, 0.01);
    }

    /**
     * Test scenario: Price = 1100, Expected Association Fee = 15.00
     */
    public function testAssociationFeeScenarioWithPrice1100()
    {
        $price = 1100.00;
        $expectedFee = 15.00;

        $calculatedFee = $this->associationFeeCalculator->calculate($price);

        $this->assertEqualsWithDelta($expectedFee, $calculatedFee, 0.01);
    }

    /**
     * Test scenario: Price = 1000000, Expected Association Fee = 20.00
     */
    public function testAssociationFeeScenarioWithPrice1000000()
    {
        $price = 1000000.00;
        $expectedFee = 20.00;

        $calculatedFee = $this->associationFeeCalculator->calculate($price);

        $this->assertEqualsWithDelta($expectedFee, $calculatedFee, 0.01);
    }
}

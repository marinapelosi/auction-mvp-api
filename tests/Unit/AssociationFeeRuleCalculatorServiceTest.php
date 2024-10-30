<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Enums\AssociationFee;
use App\Services\BidCalculators\FeeRules\AssociationFeeRuleCalculatorService;

class AssociationFeeRuleCalculatorServiceTest extends TestCase
{
    protected AssociationFeeRuleCalculatorService $associationFeeCalculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->associationFeeCalculator = new AssociationFeeRuleCalculatorService();
    }

    /**
     * Test association fee for price between 1 and 500
     */
    public function testAssociationFeeForPriceBetween1And500()
    {
        $price = 300.00;
        $expectedFee = (float) AssociationFee::BETWEEN_1_TO_500->value;

        $calculatedFee = $this->associationFeeCalculator->calculate($price);

        $this->assertEquals($expectedFee, $calculatedFee);
    }

    /**
     * Test association fee for price greater than 500 up to 1000
     */
    public function testAssociationFeeForPriceGreaterThan500UpTo1000()
    {
        $price = 750.00;
        $expectedFee = (float) AssociationFee::GREATER_THAN_500_UP_TO_1000->value;

        $calculatedFee = $this->associationFeeCalculator->calculate($price);

        $this->assertEquals($expectedFee, $calculatedFee);
    }

    /**
     * Test association fee for price greater than 1000 up to 3000
     */
    public function testAssociationFeeForPriceGreaterThan1000UpTo3000()
    {
        $price = 2500.00;
        $expectedFee = (float) AssociationFee::GREATER_THAN_1000_UP_TO_3000->value;

        $calculatedFee = $this->associationFeeCalculator->calculate($price);

        $this->assertEquals($expectedFee, $calculatedFee);
    }

    /**
     * Test association fee for price over 3000
     */
    public function testAssociationFeeForPriceOver3000()
    {
        $price = 5000.00;
        $expectedFee = (float) AssociationFee::OVER_3000->value;

        $calculatedFee = $this->associationFeeCalculator->calculate($price);

        $this->assertEquals($expectedFee, $calculatedFee);
    }

    /**
     * Test association fee for price 0 or below
     */
    public function testAssociationFeeForPriceZeroOrBelow()
    {
        $price = 0.00;
        $expectedFee = 0.0;

        $calculatedFee = $this->associationFeeCalculator->calculate($price);

        $this->assertEquals($expectedFee, $calculatedFee);
    }
}

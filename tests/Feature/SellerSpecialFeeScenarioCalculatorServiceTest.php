<?php

namespace Tests\Feature;

use App\Enums\CarType;
use App\Services\BidCalculators\FeeRules\SellerSpecialFeeRuleCalculatorService;
use PHPUnit\Framework\TestCase;

class SellerSpecialFeeScenarioCalculatorServiceTest extends TestCase
{
    protected SellerSpecialFeeRuleCalculatorService $sellerSpecialFeeCalculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sellerSpecialFeeCalculator = new SellerSpecialFeeRuleCalculatorService();
    }

    /**
     * Test scenario: Price = 398, Type = Common, Expected Special Fee = 7.96
     */
    public function testSpecialFeeScenarioForCommonCarWithPrice398()
    {
        $price = 398.00;
        $carType = CarType::COMMON;
        $expectedFee = 7.96;

        $calculatedFee = $this->sellerSpecialFeeCalculator->calculate($price, $carType);

        $this->assertEqualsWithDelta($expectedFee, $calculatedFee, 0.01);
    }

    /**
     * Test scenario: Price = 501, Type = Common, Expected Special Fee = 10.02
     */
    public function testSpecialFeeScenarioForCommonCarWithPrice501()
    {
        $price = 501.00;
        $carType = CarType::COMMON;
        $expectedFee = 10.02;

        $calculatedFee = $this->sellerSpecialFeeCalculator->calculate($price, $carType);

        $this->assertEqualsWithDelta($expectedFee, $calculatedFee, 0.01);
    }

    /**
     * Test scenario: Price = 57, Type = Common, Expected Special Fee = 1.14
     */
    public function testSpecialFeeScenarioForCommonCarWithPrice57()
    {
        $price = 57.00;
        $carType = CarType::COMMON;
        $expectedFee = 1.14;

        $calculatedFee = $this->sellerSpecialFeeCalculator->calculate($price, $carType);

        $this->assertEqualsWithDelta($expectedFee, $calculatedFee, 0.01);
    }

    /**
     * Test scenario: Price = 1800, Type = Luxury, Expected Special Fee = 72.00
     */
    public function testSpecialFeeScenarioForLuxuryCarWithPrice1800()
    {
        $price = 1800.00;
        $carType = CarType::LUXURY;
        $expectedFee = 72.00;

        $calculatedFee = $this->sellerSpecialFeeCalculator->calculate($price, $carType);

        $this->assertEqualsWithDelta($expectedFee, $calculatedFee, 0.01);
    }

    /**
     * Test scenario: Price = 1100, Type = Common, Expected Special Fee = 22.00
     */
    public function testSpecialFeeScenarioForCommonCarWithPrice1100()
    {
        $price = 1100.00;
        $carType = CarType::COMMON;
        $expectedFee = 22.00;

        $calculatedFee = $this->sellerSpecialFeeCalculator->calculate($price, $carType);

        $this->assertEqualsWithDelta($expectedFee, $calculatedFee, 0.01);
    }

    /**
     * Test scenario: Price = 1000000, Type = Luxury, Expected Special Fee = 40000.00
     */
    public function testSpecialFeeScenarioForLuxuryCarWithPrice1000000()
    {
        $price = 1000000.00;
        $carType = CarType::LUXURY;
        $expectedFee = 40000.00;

        $calculatedFee = $this->sellerSpecialFeeCalculator->calculate($price, $carType);

        $this->assertEqualsWithDelta($expectedFee, $calculatedFee, 0.01);
    }
}

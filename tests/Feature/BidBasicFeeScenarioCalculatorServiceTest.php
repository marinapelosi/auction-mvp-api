<?php

namespace Tests\Feature;

use App\Enums\CarType;
use App\Services\BidCalculators\FeeRules\BasicFeeRuleCalculatorService;
use PHPUnit\Framework\TestCase;

class BidBasicFeeScenarioCalculatorServiceTest extends TestCase
{
    protected BasicFeeRuleCalculatorService $basicFeeCalculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->basicFeeCalculator = new BasicFeeRuleCalculatorService();
    }

    /**
     * Test scenario 1: Price = 398, Type = Common, Expected Basic Fee = 39.80
     */
    public function testBasicFeeScenarioForCommonCarWithPrice398()
    {
        $price = 398.00;
        $carType = CarType::COMMON;
        $expectedFee = 39.80;
        $calculatedFee = $this->basicFeeCalculator->calculate($price, $carType);

        $this->assertEqualsWithDelta($expectedFee, $calculatedFee, 0.01);
    }

    /**
     * Test scenario 2: Price = 501, Type = Common, Expected Basic Fee = 50.00 (capped at FeeMax)
     */
    public function testBasicFeeScenarioForCommonCarWithPrice501()
    {
        $price = 501.00;
        $carType = CarType::COMMON;
        $expectedFee = 50.00;
        $calculatedFee = $this->basicFeeCalculator->calculate($price, $carType);

        $this->assertEqualsWithDelta($expectedFee, $calculatedFee, 0.01);
    }

    /**
     * Test scenario 3: Price = 57, Type = Common, Expected Basic Fee = 10.00 (capped at FeeMin)
     */
    public function testBasicFeeScenarioForCommonCarWithPrice57()
    {
        $price = 57.00;
        $carType = CarType::COMMON;
        $expectedFee = 10.00;
        $calculatedFee = $this->basicFeeCalculator->calculate($price, $carType);

        $this->assertEqualsWithDelta($expectedFee, $calculatedFee, 0.01);
    }

    /**
     * Test scenario 4: Price = 1800, Type = Luxury, Expected Basic Fee = 180.00
     */
    public function testBasicFeeScenarioForLuxuryCarWithPrice1800()
    {
        $price = 1800.00;
        $carType = CarType::LUXURY;
        $expectedFee = 180.00;
        $calculatedFee = $this->basicFeeCalculator->calculate($price, $carType);

        $this->assertEqualsWithDelta($expectedFee, $calculatedFee, 0.01);
    }

    /**
     * Test scenario 5: Price = 1100, Type = Common, Expected Basic Fee = 50.00 (capped at FeeMax)
     */
    public function testBasicFeeScenarioForCommonCarWithPrice1100()
    {
        $price = 1100.00;
        $carType = CarType::COMMON;
        $expectedFee = 50.00;
        $calculatedFee = $this->basicFeeCalculator->calculate($price, $carType);

        $this->assertEqualsWithDelta($expectedFee, $calculatedFee, 0.01);
    }

    /**
     * Test scenario 6: Price = 1000000, Type = Luxury, Expected Basic Fee = 200.00 (capped at FeeMax)
     */
    public function testBasicFeeScenarioForLuxuryCarWithPrice1000000()
    {
        $price = 1000000.00;
        $carType = CarType::LUXURY;
        $expectedFee = 200.00;
        $calculatedFee = $this->basicFeeCalculator->calculate($price, $carType);

        $this->assertEqualsWithDelta($expectedFee, $calculatedFee, 0.01);
    }
}

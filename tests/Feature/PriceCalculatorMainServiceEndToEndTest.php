<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Enums\CarType;
use App\Services\BidCalculators\PriceCalculatorMainService;

class PriceCalculatorMainServiceEndToEndTest extends TestCase
{
    /**
     * Test scenario with all fees for a common car with price 398
     */
    public function testScenarioWithAllFeesCommonCarWithPrice398()
    {
        $price = 398.00;
        $carType = CarType::COMMON;

        $calculatorService = new PriceCalculatorMainService($price, $carType);
        $result = $calculatorService->carPriceCalculator();

        $expectedResult = [
            'basicFee' => '39.80',
            'sellerSpecialFee' => '7.96',
            'associationFee' => '5.00',
            'storageFee' => '100.00',
            'total' => '550.76'
        ];

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test scenario with all fees for a common car with price 501
     */
    public function testScenarioWithAllFeesCommonCarWithPrice501()
    {
        $price = 501.00;
        $carType = CarType::COMMON;

        $calculatorService = new PriceCalculatorMainService($price, $carType);
        $result = $calculatorService->carPriceCalculator();

        $expectedResult = [
            'basicFee' => '50.00',
            'sellerSpecialFee' => '10.02',
            'associationFee' => '10.00',
            'storageFee' => '100.00',
            'total' => '671.02'
        ];

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test scenario with all fees for a common car with price 57
     */
    public function testScenarioWithAllFeesCommonCarWithPrice57()
    {
        $price = 57.00;
        $carType = CarType::COMMON;

        $calculatorService = new PriceCalculatorMainService($price, $carType);
        $result = $calculatorService->carPriceCalculator();

        $expectedResult = [
            'basicFee' => '10.00',
            'sellerSpecialFee' => '1.14',
            'associationFee' => '5.00',
            'storageFee' => '100.00',
            'total' => '173.14'
        ];

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test scenario with all fees for a luxury car with price 1800
     */
    public function testScenarioWithAllFeesLuxuryCarWithPrice1800()
    {
        $price = 1800.00;
        $carType = CarType::LUXURY;

        $calculatorService = new PriceCalculatorMainService($price, $carType);
        $result = $calculatorService->carPriceCalculator();

        $expectedResult = [
            'basicFee' => '180.00',
            'sellerSpecialFee' => '72.00',
            'associationFee' => '15.00',
            'storageFee' => '100.00',
            'total' => '2167.00'
        ];

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test scenario with all fees for a common car with price 1100
     */
    public function testScenarioWithAllFeesCommonCarWithPrice1100()
    {
        $price = 1100.00;
        $carType = CarType::COMMON;

        $calculatorService = new PriceCalculatorMainService($price, $carType);
        $result = $calculatorService->carPriceCalculator();

        $expectedResult = [
            'basicFee' => '50.00',
            'sellerSpecialFee' => '22.00',
            'associationFee' => '15.00',
            'storageFee' => '100.00',
            'total' => '1287.00'
        ];

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test scenario with all fees for a luxury car with price 1000000
     */
    public function testScenarioWithAllFeesLuxuryCarWithPrice1000000()
    {
        $price = 1000000.00;
        $carType = CarType::LUXURY;

        $calculatorService = new PriceCalculatorMainService($price, $carType);
        $result = $calculatorService->carPriceCalculator();

        $expectedResult = [
            'basicFee' => '200.00',
            'sellerSpecialFee' => '40000.00',
            'associationFee' => '20.00',
            'storageFee' => '100.00',
            'total' => '1040320.00'
        ];

        $this->assertEquals($expectedResult, $result);
    }
}

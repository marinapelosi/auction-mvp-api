<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Enums\CarType;
use App\Services\BidCalculators\PriceCalculatorMainService;
use App\Services\BidCalculators\FeeRules\AssociationFeeRuleCalculatorService;
use App\Services\BidCalculators\FeeRules\BasicFeeRuleCalculatorService;
use App\Services\BidCalculators\FeeRules\SellerSpecialFeeRuleCalculatorService;
use App\Services\BidCalculators\FeeRules\StorageFeeRuleCalculatorService;

class PriceCalculatorMainServiceTest extends TestCase
{
    public function testCarPriceCalculator()
    {
        $price = 1000.00;
        $carType = CarType::COMMON;

        $basicFeeCalculatorMock = $this->createMock(BasicFeeRuleCalculatorService::class);
        $sellerSpecialFeeCalculatorMock = $this->createMock(SellerSpecialFeeRuleCalculatorService::class);
        $associationFeeCalculatorMock = $this->createMock(AssociationFeeRuleCalculatorService::class);
        $storageFeeCalculatorMock = $this->createMock(StorageFeeRuleCalculatorService::class);

        $basicFeeCalculatorMock->method('calculate')->willReturn(50.00);
        $sellerSpecialFeeCalculatorMock->method('calculate')->willReturn(20.00);
        $associationFeeCalculatorMock->method('calculate')->willReturn(10.00);
        $storageFeeCalculatorMock->method('calculate')->willReturn(5.00);

        $priceCalculatorService = new PriceCalculatorMainService(
            $price,
            $carType
        );

        $result = $priceCalculatorService->carPriceCalculator();

        $expectedResult = [
            'basicFee' => '50.00',
            'sellerSpecialFee' => '20.00',
            'associationFee' => '10.00',
            'storageFee' => '100.00',
            'total' => '1180.00' // 1000 + 50 + 20 + 10 + 100
        ];

        $this->assertEquals($expectedResult, $result);
    }
}

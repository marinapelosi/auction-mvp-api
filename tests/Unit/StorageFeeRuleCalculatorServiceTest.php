<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Enums\FixedFee;
use App\Services\BidCalculators\FeeRules\StorageFeeRuleCalculatorService;

class StorageFeeRuleCalculatorServiceTest extends TestCase
{
    protected StorageFeeRuleCalculatorService $storageFeeCalculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->storageFeeCalculator = new StorageFeeRuleCalculatorService();
    }

    /**
     * Test that the storage fee is correctly returned
     */
    public function testCalculateStorageFee()
    {
        $expectedFee = FixedFee::STORAGE_FEE->getValue(); // 100.0
        $calculatedFee = $this->storageFeeCalculator->calculate();

        $this->assertEquals($expectedFee, $calculatedFee);
    }
}

<?php

namespace App\Http\Controllers;

use App\Enums\CarType;
use App\Services\BidCalculators\PriceCalculatorMainService;
use Illuminate\Http\Request;

class BidController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $systemConfigCarTypes = array_map(fn($type) => strtolower($type->value), CarType::cases());

        $validated = $request->validate([
            'price' => 'required|numeric|min:0',
            'type' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($systemConfigCarTypes) {
                    $normalizedValue = strtolower(trim($value));
                    if (!in_array($normalizedValue, $systemConfigCarTypes)) {
                        $fail("The $value $attribute informed is not a valid car type.");
                    }
                },
            ],
        ]);

        try {
            $price = $validated['price'];
            $carType = CarType::from(strtolower(trim($validated['type'])));
            return response()->json(['priceAndFees' => (new PriceCalculatorMainService($price, $carType))->carPriceCalculator()]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}

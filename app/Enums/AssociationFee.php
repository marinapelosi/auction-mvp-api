<?php

namespace App\Enums;

enum AssociationFee: int
{
    case BETWEEN_1_TO_500 = 5;
    case GREATER_THAN_500_UP_TO_1000 = 10;
    case GREATER_THAN_1000_UP_TO_3000 = 15;
    case OVER_3000 = 20;
}

<?php

namespace App\Enums\SparePart;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CustomerType extends Enum
{
    const WORKSHOP =   1;
    const OUTSIDE =   2;  
}
<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Condition extends Enum
{
    const BrandNew =   1;
    const Recondition  =   2;
    const Used = 3;
}
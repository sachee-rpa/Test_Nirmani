<?php

namespace App\Enums\SparePart;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class GrnDebitMethod extends Enum
{
    const GIN =   1;
    const WASTE =   2;
}
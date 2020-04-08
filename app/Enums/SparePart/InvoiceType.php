<?php

namespace App\Enums\SparePart;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class InvoiceType extends Enum
{
    const GENERAL =  1;
    const VAT =   2;
    const SVAT = 3;
}
<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Quality extends Enum
{
    const ORIGINAL  =   1;
    const OEMImport =   2;
    const OEMLocal  = 3;
}
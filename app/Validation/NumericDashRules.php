<?php

namespace App\Validation;
// Allow dashes to numbers 

class NumericDashRules
{
    public function numeric_dash($num)
    {
        return (!preg_match("/^([0-9-\s])+$/D", $num)) ? FALSE : TRUE;
    }
}

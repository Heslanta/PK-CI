<?php

namespace App\Validation;
// Allow dashes to numbers 

class NumericRules
{
    public function numeric($num)
    {
        return (!preg_match("/^([0-9\s])+$/D", $num)) ? FALSE : TRUE;
    }
}

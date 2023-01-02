<?php

namespace App\Validation;
// Allow dashes to numbers 

class NPWPRules
{
    public function npwp($num)
    {
        return (!preg_match("/^([ 0-9-.\s])+$/D", $num)) ? FALSE : TRUE;
    }
}

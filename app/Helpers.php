<?php

namespace App\Helpers;

use Carbon\Carbon;

class Helpers  
{
    
    public static function formatDate(Carbon $date)
    {
        return $date->format('d/m/Y H:i');
    }
}

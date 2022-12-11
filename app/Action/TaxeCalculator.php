<?php 
namespace App\Action;

use SebastianBergmann\CodeCoverage\Util\Percentage;

class TaxeCalculator{
    public static function get($amount){
        return $amount * 0.05;
    }
}
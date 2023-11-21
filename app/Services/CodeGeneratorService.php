<?php

namespace App\Services;

class CodeGeneratorService
{
    //Generation du code grace au prefix et l'index suivant
    public static function generateCode(string $prefix, int $index):string
    {
        $code="";
        $index++;
        if($index<=9){
            $code= $prefix."000".$index;
        }
        elseif($index<=99){
            $code= $prefix . "00".$index;
        }
        elseif($index<=999){
            $code= $prefix."0".$index;
        }
        else{
            $code= $prefix."".$index;
        }

        return $code;
    }
}

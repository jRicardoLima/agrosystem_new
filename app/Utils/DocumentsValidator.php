<?php


namespace App\Utils;


use Brazanation\Documents\Cpf;
use Brazanation\Documents\Exception\InvalidDocument;

class DocumentsValidator
{

    public function cpfValid(string $cpf)
    {
        $cpfFiltered = clearVars(['.','-','_'],$cpf);


        if(strlen($cpfFiltered) != 11){
            return false;
        }

        if(preg_match('/(\d)\1{10}/',$cpfFiltered)){
            return false;
        }

        $digitOne = null;
        $digitTwo = null;
        $count = 10;
        $calcDigiteOne = null;

        for($i = 0; $i< strlen($cpfFiltered); $i++){
            if($count != 1){
               $calc1 = (int) $cpfFiltered[$i] * $count;
               $calcDigiteOne = $calc1 + $calcDigiteOne;
               $count --;
            }
        }

        $count2 = 11;
        $calcDigiteTwo = null;
        for ($i = 0; $i < strlen($cpfFiltered); $i++){
            if($count2 != 1){
                $calc2 = (int) $cpfFiltered[$i] * $count2;
                $calcDigiteTwo = $calc2 + $calcDigiteTwo;
                $count2--;
            }
        }

        $digitOne = $calcDigiteOne * 10 % 11 ;
        $digitTwo = $calcDigiteTwo * 10 % 11;

        if($digitTwo == 10){
            $digitTwo = 0;
        }
        if($digitOne == $cpfFiltered[9] && $digitTwo == $cpfFiltered[10]){
            return true;
        } else {
            return false;
        }

    }
}
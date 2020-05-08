<?php

function clearVars(array $characters,$param)
{
    if(!empty($param)){
        return str_replace($characters,'',$param);
    }
    return null;
}

function lengthName(string $param){
    $delimiters = [' ','','_','*','@','#','!','%'];
    if(!empty($param)){
        $nameRaw = str_replace($delimiters,'-',$param);
        $name = explode('-',$nameRaw);
        return $name[0]." ".$name[1];
    }
    return null;
}

function convertKeysArrays(array $params,string $separator){


    if(is_array($params) && !empty($params) && !empty($separator)){

        $keysValues = array_keys($params);
        $beforeValues = null;
        $afterValues = null;
      foreach ($keysValues as $key) {
            $beforeValues = strstr($key,$separator);
            $afterValues = strstr($key,$separator,true);
        }

      return array_combine($afterValues,$beforeValues);

    }
}

function filterArrays(array $params,string $separator,$before = false){
    foreach ($params as $param){
        return strstr($param,$separator,$before);
    }
}

function convertArrayCollect(array $params){
    $collection = null;
    foreach ($params as $param){
        $collection = collect([$param.","]);
    }
    return $collection;
}

function convertDateToDatabase($date){

    list($day,$month,$year) = explode("/",$date);

    $newDate = new DateTime($year.'-'.$month.'-'.$day);

    return $newDate->format('Y-m-d');
}

function convertDateToBr($date){
    return date('d/m/Y',strtotime($date));
}

function convertDateTimeToBr($date){
    return date('d/m/Y H:i:s',strtotime($date));
}

function convertFloatBR($param){
    return number_format($param,2,',','.');
}

function converStringToDouble($param){
    if(!empty($param)){

        $aux = str_replace('.','',$param);
        return str_replace(',','.',$aux);
    }
}

function convertCPF(?string $param){
    if(!empty($param)){
        return substr($param,0,3).".".substr($param,3,3).".".substr($param,6,3)."-".substr($param,9,2);
    }

}
function convertCNPJ(?string $param){
    if(!empty($param)){
        return substr($param,0,2).".".substr($param,2,3).".".substr($param,5,3)."/".substr($param,8,4)."-".substr($param,12,2);
    }
}

function isActive($href){
    if(!empty($href)){
        return (\Illuminate\Support\Facades\Route::currentRouteName() == $href ? 'active' : '');
    }
}


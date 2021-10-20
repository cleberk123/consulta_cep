<?php

require_once 'DB/DBconnection.php';

class cepUtil {

    public static function getAddress(){

        if (isset ($_POST['cep'])){

            $cep = $_POST['cep'];
            $cep = self::filterCep($cep);
            
            if (strlen($cep) == 8){
                $address = self::getAddressCep($cep);
                
                if (in_array('true', $address)){
                    $address = self::addressEmpty();
                    $address["cep"] = 'CEP inexistente!';
                    return $address;
                }
                elseif ((strlen($cep) == 8) AND (DBCep::getCep($address["cep"]) != false)){        
                    $address = DBCep::returnAllCepUnic($address["cep"]);
                }
                else{
                    $address = self::getAddressCep($cep);
                    DBCep::setCep($address); 
                }
            }
            else{   
                $address["cep"] = 'CEP digitado incorretamente!';}
            }
        
        else{
            $address = self::addressEmpty();          
        }
        
        return $address;
    }

    public static function addressEmpty(){
        return (array)[
            'cep' => '',
            'logradouro' => '',
            'bairro' => '',
            'localidade' => '',
            'uf' => ''
        ];
    }

    public static function filterCep(String $cep):String{
        return preg_replace('/[^0-9]/','', $cep);
    }

    public static function isCep(String $cep):bool{
        return preg_match('/^[0-9]{5}-?[0-9]{3}$/', $cep);
    }

    public static function getAddressCep(String $cep){
        $url = "https://viacep.com.br/ws/{$cep}/xml/";
        $address = simplexml_load_string(file_get_contents($url));
        return get_object_vars($address);
    }
}

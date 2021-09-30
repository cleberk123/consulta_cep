<?php 

require_once 'DB/DBconnection.php';

class cepUtil {

    public static function getAddress(){

        if (isset ($_POST['cep'])){

            $cep = $_POST['cep'];
            $cep = self::filterCep($cep);

            if (strlen($cep) == 8 AND $cepVerify = self::getAddressCep($cep) AND DBCep::getCep($cepVerify["cep"]) != false){

                $address = DBCep::returnAllCepUnic($cepVerify["cep"]);
            }  

            elseif (self::isCep($cep)){
                $address = self::getAddressCep($cep);

                if(in_array('erro', $address)){
                    $address = self::addressEmpty();
                    $address["cep"] = 'CEP incorreto!';}
                else{
                    DBCep::setCep($address);
                    
                }
            }
            else{
                $address = self::addressEmpty();     
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
?>
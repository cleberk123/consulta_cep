<?php
  
class DBCep{

    public static function getConnection(){
        if (empty($conn))
        {
            $conexao = parse_ini_file('DBconfig.ini');
            $host = $conexao['host'];
            $name = $conexao['name'];
            $user = $conexao['user'];
            $pass = $conexao['pass'];
            $port = $conexao['port']; 
            
            $conn = new PDO("mysql:host={$host};port={$port};dbname={$name};user={$user};password={$pass}");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
        return $conn;
    }

    public static function returnAllCepUnic($cep) {
        $conn = self::getConnection();
            
        $result = $conn->prepare("SELECT cep, logradouro, bairro, localidade, uf FROM cep WHERE cep = :cep");

        $result->execute(array(
            ':cep' => $cep
        ));

        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $result = $result[0];
        return $result;
    }

    public static function getCep($cep){
        $conn = self::getConnection();

        $result = $conn->prepare("SELECT cep FROM cep WHERE cep = :cep");
        
        $result->execute(array (
            ':cep' => $cep
        ));

        $result = $result->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function returnAllCep() {
        $conn = self::getConnection();
            
        $result = $conn->query("SELECT * FROM cep", PDO::FETCH_ASSOC);

        $result = $result[0];

        return $result;
    }

    public static function setCep($address){
        $conn = self::getConnection();

        $sql = "INSERT INTO cep (cep, logradouro, bairro, localidade, uf) VALUES (?, ?, ?, ?, ?)";

        $result = $conn->prepare($sql);

        $result->execute(array(
            $address["cep"],
            $address["logradouro"],
            $address["bairro"],
            $address["localidade"],
            $address["uf"]
        ));
        
    }
}
?>
<?php
include_once('cepUtil.php');
$address = cepUtil::getAddress();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Consulta CEP</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/css/animate.min.css" rel="stylesheet"/>
    <link href="./assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
    <link href="./assets/css/font-awesome.min.css" rel="stylesheet">
    <script src="./assets/js/Chart.bundle.min.js"></script>
    <script src="./assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="./assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="./assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
    <link rel="stylesheet" href="./CSS/style.css">
</head>
<body>
    <form action="." method="post">
        <p>Digite o CEP para encontrar a cidade.</p>
        <input type="text" placeholder="Digite um cep..." id="cep" name="cep" value="<?php echo $address['cep']?>">
        <input type="submit">
        <input type="text" placeholder="Rua" id="rua" name="rua" value="<?php echo $address['logradouro']?>">
        <input type="text" placeholder="Bairro" id="bairro" name="bairro" value="<?php echo $address['bairro']?>">
        <input type="text" placeholder="Cidade" id="cidade" name="cidade" value="<?php echo $address['localidade']?>">
        <input type="text" placeholder="Estado" id="estado" name="estado" value="<?php echo $address['uf']?>">
    </form>
</body>
</html>
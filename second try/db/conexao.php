<?php

$servidor = "127.0.0.1";
$senha = "";
$usuario = "root";
$banco = "gestor_atividades";

$con = mysqli_connect($servidor, $usuario, $senha, $banco);

// Checar a conexão

if(mysqli_connect_errno())
{
    echo "Falha na conexão com o MySQL: " . mysqli_connect_error(); 
}

mysqli_select_db($con, $banco);

?>
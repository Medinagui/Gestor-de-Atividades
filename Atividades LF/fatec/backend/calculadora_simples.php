<?php

    if (!isset($_GET["valorA"]) || !isset($_GET["valorB"]) || !isset($_GET["operacao"])) {
        echo "<center><h1>Requisição Inválida</h1></center>";
        return;
    }

    $valor1 = $_GET["valorA"];
    $valor2 = $_GET["valorB"];
    $operacao = $_GET["operacao"];

    if (empty($valor1) || ($valor2 != "0" && empty($valor2)) || empty($operacao)) {
        echo "<center><h1>Preencha todos os valores</h1></center>";
        return;
    }

    if (!is_numeric($valor1) || !is_numeric($valor2)) {
        echo "<center><h1>Dados Inválidos</h1></center>";
        return;
    }

    if ($operacao != "+" && $operacao != "-" && $operacao != "*" && $operacao != "/") {
        echo "<center><h1>Operação Inválida</h1></center>";
        return;
    }

    if ($valor2 == "0" && $operacao == "/") {
        echo "<center><h1>Não é aceito divisão por ZERO</h1></center>";
        return;
    }

    $soma = 0;

    switch($operacao) {
        case '+':
            $soma = $valor1 + $valor2;
            break;
        case '-':
            $soma = $valor1 - $valor2;
            break;
        case '*':
            $soma = $valor1 * $valor2;
            break;
        case '/':
            $soma = $valor1 / $valor2;
            break;
        default:
            echo "<center><h1>Operação Inválida</h1></center>";
            return;
    }

    echo "<center><h1>$soma</h1></center>"

?>
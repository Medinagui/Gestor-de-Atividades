<?php

    if (!isset($_POST["valorA"]) || !isset($_POST["valorB"]) || !isset($_POST["operacao"])) {
        echo "Requisição Inválida";
        return;
    }

    $valor1 = $_POST["valorA"];
    $valor2 = $_POST["valorB"];
    $operacao = $_POST["operacao"];

    if (empty($valor1) || ($valor2 != "0" && empty($valor2)) || empty($operacao)) {
        echo "Preencha todos os valores";
        return;
    }

    if (!is_numeric($valor1) || !is_numeric($valor2)) {
        echo "Dados Inválidos";
        return;
    }

    if ($operacao != "+" && $operacao != "-" && $operacao != "*" && $operacao != "/") {
        echo "Operação Inválida";
        return;
    }

    if ($valor2 == "0" && $operacao == "/") {
        echo "Não é aceito divisão por ZERO";
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
            echo "Operação Inválida";
            return;
    }

    echo "$soma";

?>
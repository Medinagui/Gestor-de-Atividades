<?php
	header("Content-Type: " . 'application/json');

	if (!isset($_POST["salario"]) || !isset($_POST["inss"])) {
		echo '{ "salario": "Valores invalidos", "status": "Erro!" }';
		return;
	}
	
	if (!is_numeric($_POST["salario"]) || !is_numeric($_POST["inss"])) {
		echo '{ "salario": "Valores invalidos", "status": "Erro!" }';
		return;
	}
	
	if ($_POST["salario"] <= 0 || $_POST["inss"] <= 0) {
		echo '{ "salario": "Valores invalidos", "status": "Erro!" }';
		return;
	}
	
	$salario = $_POST["salario"];
	$inss = $_POST["inss"];
	
	/**
		de 0,00 até 1.903,98		isento	0,00
		de 1.903,99 até 2.826,65	7,50%	142,80
		de 2.826,66 até 3.751,05	15,00%	354,80
		de 3.751,06 até 4.664,68	22,50%	636,13
		a partir de 4.664,68		27,50%	869,36	
	*/
	
	$imposto_renda = 0;
	$avaliacao = "";
	$base_calculo = $salario - $inss;
	
	if ($base_calculo <= 1903.98) {
		$imposto_renda = 0.00;
		$avaliacao = "1";
	} else if ($base_calculo >= 1903.99 and $base_calculo <= 2826.65) {
		$imposto_renda = ((($base_calculo) * 0.075) - 158.40);
		$avaliacao = "2";
	} else if ($base_calculo >= 2826.66 and $base_calculo <= 3751.05) {
		$imposto_renda = ((($base_calculo) * 0.15) - 370.40);
		$avaliacao = "3";
	} else if ($base_calculo >= 3751.06 and $base_calculo <= 4664.68) {
		$imposto_renda = ((($base_calculo) * 0.225) - 651.73);
		$avaliacao = "4";
	} else {
		$imposto_renda = ((($base_calculo) * 0.275) - 884.96);	
		$avaliacao = "5";
	}
	
	$salario_liquido = $base_calculo - $imposto_renda;
	
	echo '{ "ir": "' . round($imposto_renda, 2) .
			'", "salario": "' . round($salario_liquido, 2) .
			'", "status": "Sucesso!",' . 
		    '"avaliacao": "' . $avaliacao . 
		 '" }';
	
?>
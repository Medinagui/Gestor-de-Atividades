$( document ).ready(function() {
    function limpaSelecaoTabela() {
        for (var i = 1 ; i <= 6 ; i++) {
            var row = "#row" + i;
            $( row ).removeClass("tr_selected");
        }
    }

    $( "#salario" ).focusout(function() {
        var v1 = $( "#salario" ).val();
        
        $( "#salario" ).val(parseFloat(v1).toFixed(2));
        
        /**
         Até R$ 1.320,00					7.5%
            R$ 1.319,99 até R$ 2.571,29	9%
            R$ 2.571,28 até R$ 3.856,94	12%
            R$ 3.856,93 até R$ 7.507,49	14%
        */

        var contrib = 0.00;
        
        if (v1 < 1320.0) {
            contrib = v1 * 0.075;
        } else {
            contrib = 1320.0 * 0.075;
        }
        
        if (v1 > 1320.00 && v1 <= 2571.29) {
            contrib += (v1 - 1320.00) * 0.09;
        } else if (v1 > 1320.00 && v1 > 2571.29) {
            contrib += (2571.29 - 1320.00) * 0.09;
        }
        
        if (v1 > 2571.29 && v1 <= 3856.94) {
            contrib += (v1 - 2571.29) * 0.12;
        } else if (v1 > 2571.29 && v1 > 3856.94) {
            contrib += (3856.94 - 2571.29) * 0.12;
        }
        
        if (v1 > 3856.94 && v1 <= 7507.49) {
            contrib += (v1 - 3856.94) * 0.14;
        } else if (v1 > 3856.94 && v1 > 7507.49) {
            contrib += (7507.49 - 3856.94) * 0.14;
        }

        $( "#inss" ).val(parseFloat(contrib).toFixed(2));
    });

    $( "#limpar" ).click(function(){
        limpaSelecaoTabela();
        $( "#resultado" ).html("");
        $( "#resultado2" ).html("");
        $( "#sts" ).attr('class', '');
        $( "#sts2" ).attr('class', '');
        $( "#salario" ).val("");
        $( "#inss" ).val("");
    });

    $( "#calcular" ).click(function(){
        limpaSelecaoTabela();
        
        $( "#resultado" ).text("");
        $( "#resultado2" ).text("");
        var v1 = $( "#salario" ).val();
        var v2 = $( "#inss" ).val();
        
        $.ajax({
            method: "POST",
            url: "../backend/calcular-ir.php",
            data: { 
                salario: v1, 
                inss: v2 
            }
        }).done(function(resposta) {
            console.log(resposta);
            //{ "ir": "831.19", "salario": "5352.63", "status": "Sucesso!", "avaliacao": "5" }
                
            //var obj = $.parseJSON(resposta);
            
            if (resposta.status == 'Sucesso!') {
                $( "#resultado" ).html('<b style="color:white">Salário Líquido: R$' + resposta.salario + '</b>');
                $( "#resultado2" ).html('<b style="color:white">Imposto à Pagar: R$ ' + resposta.ir + '</b>');
                $( "#sts" ).attr('class', 'badge badge-success');
                $( "#sts2" ).attr('class', 'badge badge-success');
                
                if (resposta.avaliacao) {
                    var row = "#row" + resposta.avaliacao;
                    $( row ).addClass("tr_selected");
                }
            } else {
                $( "#resultado" ).html('<b style="color:white">' + resposta.salario + '</b>');
                $( "#sts" ).attr('class', 'badge badge-danger');
                $( "#sts2" ).attr('class', '');
            }
            
            //$( "#sts" ).text(obj.status);
        });
    });
});

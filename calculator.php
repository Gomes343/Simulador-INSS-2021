<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS.css">
    <title>CALCULADORA de Salário</title>
</head>
<body>
<form name="mainform" method="POST">
    <h2> CALCULADORA DE INSS 2022</h2>
    Pequeno simulador que visa facilitar o calculo da nova tabela de INSS 2022.
    <br><br>
    Salário
    <label><input type="text" id="salario" name="salario" value="" class="input" onchange="myFunction()"/></label>
    <br><br>
    INSS - R$ <label type="text" id="inss"></label>
    <br><br>
    IRRF - R$ <label type="text" id="irrf"></label>
    <br><br><br><br>
    Salário Liquido - R$ <label type="text" id="liquido"></label>

    <script>
        function myFunction() {
            var salario = document.getElementById("salario");




            var inss = document.getElementById("inss").innerHTML = number_format(CalculoINSSProLabore(salario),2,',','.');
            var irrf = document.getElementById("irrf").innerHTML = number_format(CalculoIRRF(salario),2,',','.');
            var liquido = document.getElementById("liquido").innerHTML = number_format(CalculoLiquido(salario),2,',','.');
        }

        function CalculoINSS(salario){
            var salario = parseInt(salario.value);

            var inss = 0;
            var inicio1 = 0;
            var limite1 = 1212;
            var porcentagem1 = 0.075;
            var faixa1max = (limite1 - inicio1)*porcentagem1;
            var inicio2 = 1212.01;
            var limite2 = 2427.35;
            var porcentagem2 = 0.09;
            var faixa2max = (limite2 - inicio2)*porcentagem2;
            var inicio3 = 2427.36;
            var limite3 = 3641.03;
            var porcentagem3 = 0.12;
            var faixa3max = (limite3 - inicio3)*porcentagem3;
            var inicio4 = 3641.04;
            var limite4 = 7087.22;
            var porcentagem4 = 0.14;
            var faixa4max = (limite4 - inicio4)*porcentagem4;

            if(salario >= limite4){
                inss = faixa1max +faixa2max +faixa3max + faixa4max;
            }else{
                if(salario >= inicio4){
                    inss = (salario - limite3) * porcentagem4;
                    inss = inss + faixa3max + faixa2max + faixa1max;
                }else{
                    if(salario >= inicio3){
                        inss = (salario - limite2) * porcentagem3;
                        inss = inss + faixa2max + faixa1max;
                    }else{
                        if(salario >= inicio2){
                            inss = (salario - limite1) * porcentagem2;
                            inss = inss + faixa1max;
                        }else{
                            inss = salario * porcentagem1;
                        }
                    }
                }
            }

            return inss.toFixed(2);
        }


        function CalculoINSSProLabore(salario){
            var salario = parseInt(salario.value);
            var inss = 0;
            var inicio = 0;
            var limite = 7087.22;
            var porcentagem = 0.11;

            if(salario <= limite){
                inss = salario * porcentagem;
            }else{
                if(salario > limite){
                    inss = limite * porcentagem;
                }
            }
            return inss.toFixed(2);
        }




        function CalculoIRRF(salarioOriginal){
            var salario = parseInt(salarioOriginal.value);
            var irrf = 0;
            var inss = CalculoINSS(salarioOriginal);

            var limite1 = 1903.98;

            var inicio2 = 1903.99;
            var limite2 = 2826.65;
            var porcentagem2 = 0.075;
            var deducao2 = 142.80;

            var inicio3 = 2826.66;
            var limite3 = 3751.05;
            var porcentagem3 = 0.15;
            var deducao3 = 354.80;

            var inicio4 = 3751.06;
            var limite4 = 4664.68;
            var porcentagem4 = 0.275;
            var deducao4 = 869.36;

            var progressivo5 = 4664.69;
            var porcentagem5 = 0.275;
            var deducao5 = 869.36;

            if(salario <= limite1){
                irrf = 0;
            }else{
                if(salario >= inicio2 && salario <= limite2){
                    irrf = ((salario - inss) * porcentagem2) - deducao2;
                }else{
                    if(salario >= inicio3 && salario <= limite3){
                        irrf = ((salario - inss) * porcentagem3) - deducao3;
                    }else{
                        if(salario >= inicio4 && salario <= limite4){
                            irrf = ((salario - inss) * porcentagem4) - deducao4;
                        }else{
                            if(salario >= progressivo5){
                                irrf = ((salario - inss) * porcentagem5) - deducao5;
                            }
                        }
                    }
                }
            }

            if(irrf < 0){
                irrf = 0;
            }


            return irrf.toFixed(2);
        }

        function CalculoLiquido(salarioOriginal) {
            var salario = parseInt(salarioOriginal.value);
            var inss = CalculoINSS(salarioOriginal);
            var irrf = CalculoIRRF(salarioOriginal);
            var salarioLiquido = salario - inss - irrf;
            return (salario - inss - irrf).toFixed(2);
        }



        function number_format(number, decimals, dec_point, thousands_sep) {
            // http://kevin.vanzonneveld.net
            // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
            // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
            // +     bugfix by: Michael White (http://getsprink.com)
            // +     bugfix by: Benjamin Lupton
            // +     bugfix by: Allan Jensen (http://www.winternet.no)
            // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
            // +     bugfix by: Howard Yeend
            // +    revised by: Luke Smith (http://lucassmith.name)
            // +     bugfix by: Diogo Resende
            // +     bugfix by: Rival
            // +      input by: Kheang Hok Chin (http://www.distantia.ca/)
            // +   improved by: davook
            // +   improved by: Brett Zamir (http://brett-zamir.me)
            // +      input by: Jay Klehr
            // +   improved by: Brett Zamir (http://brett-zamir.me)
            // +      input by: Amir Habibi (http://www.residence-mixte.com/)
            // +     bugfix by: Brett Zamir (http://brett-zamir.me)
            // +   improved by: Theriault
            // +   improved by: Drew Noakes
            // *     example 1: number_format(1234.56);
            // *     returns 1: '1,235'
            // *     example 2: number_format(1234.56, 2, ',', ' ');
            // *     returns 2: '1 234,56'
            // *     example 3: number_format(1234.5678, 2, '.', '');
            // *     returns 3: '1234.57'
            // *     example 4: number_format(67, 2, ',', '.');
            // *     returns 4: '67,00'
            // *     example 5: number_format(1000);
            // *     returns 5: '1,000'
            // *     example 6: number_format(67.311, 2);
            // *     returns 6: '67.31'
            // *     example 7: number_format(1000.55, 1);
            // *     returns 7: '1,000.6'
            // *     example 8: number_format(67000, 5, ',', '.');
            // *     returns 8: '67.000,00000'
            // *     example 9: number_format(0.9, 0);
            // *     returns 9: '1'
            // *    example 10: number_format('1.20', 2);
            // *    returns 10: '1.20'
            // *    example 11: number_format('1.20', 4);
            // *    returns 11: '1.2000'
            // *    example 12: number_format('1.2000', 3);
            // *    returns 12: '1.200'
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                toFixedFix = function (n, prec) {
                    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                    var k = Math.pow(10, prec);
                    return Math.round(n * k) / k;
                },
                s = (prec ? toFixedFix(n, prec) : Math.round(n)).toString().split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

    </script>





    <?php

    function getMessage()
    {
        echo "Hello World!";
    }

    function CalculoINSS(){
        $inss = 0;

        $salario = $_GET["salario"];
        $inicio1 = 0;
        $limite1 = 1212;
        $porcentagem1 = 0.075;
        $faixa1max = ($limite1 - $inicio1)*$porcentagem1;
        $inicio2 = 1212.01;
        $limite2 = 2427.35;
        $porcentagem2 = 0.09;
        $faixa2max = ($limite2 - $inicio2)*$porcentagem2;
        $inicio3 = 2427.36;
        $limite3 = 3641.03;
        $porcentagem3 = 0.12;
        $faixa3max = ($limite3 - $inicio3)*$porcentagem3;
        $inicio4 = 3641.04;
        $limite4 = 7087.22;
        $porcentagem4 = 0.14;
        $faixa4max = ($limite4 - $inicio4)*$porcentagem4;

        if($salario >= $limite4){
            $inss = $faixa1max +$faixa2max +$faixa3max +$faixa4max;
        }else{
            if($salario >= $inicio4){
                $inss = ($salario - $limite3) * $porcentagem4;
                $inss = $inss + $faixa3max + $faixa2max + $faixa1max;
            }else{
                if($salario >= $inicio3){
                    $inss = ($salario - $limite2) * $porcentagem3;
                    $inss = $inss + $faixa2max + $faixa1max;
                }else{
                    if($salario >= $inicio2){
                        $inss = ($salario - $limite1) * $porcentagem2;
                        $inss = $inss + $faixa1max;
                    }else{
                        $inss = $salario * $porcentagem1;
                    }
                }
            }
        }
        echo $inss;
        //echo number_format(round($inss,2),2,",",".");
    };

    ?>


</body>
</html>

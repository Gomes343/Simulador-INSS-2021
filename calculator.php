<html lang="pt-BR">
<body>
<?php 
	$salario = $_GET["salario"];
	$inss = 0;

    //TABELA DO INSS 2021
    $inicio1 = 0;
    $limite1 = 1100;
    $porcentagem1 = 0.075;
    $faixa1max = ($limite1 - $inicio1)*$porcentagem1;
    $inicio2 = 1100.01;
    $limite2 = 2203.48;
    $porcentagem2 = 0.09;
    $faixa2max = ($limite2 - $inicio2)*$porcentagem2;
    $inicio3 = 2203.49;
    $limite3 = 3305.22;
    $porcentagem3 = 0.12;
    $faixa3max = ($limite3 - $inicio3)*$porcentagem3;
    $inicio4 = 3305.23;
    $limite4 = 6433.57;
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
	echo "<h1> O Salário de R$ ".number_format($salario,2,",",".")." tem um INSS de: R$ ".number_format(round($inss,2),2,",",".")."</h1>";
?>
</body>
</html>
<!-- Silvia Rus Mata -->
<!-- Aplicación No 4 (Calculadora)
Escribir un programa que use la variable $operador que pueda almacenar los símbolos
matemáticos: ‘+’, ‘-’, ‘/’ y ‘*’; y definir dos variables enteras $op1 y $op2. De acuerdo al
símbolo que tenga la variable $operador, deberá realizarse la operación indicada y mostrarse el
resultado por pantalla. -->

<?php

$op1 = 1;
$op2 = 0;
$operador = '*';
$resultado; 

switch ($operador)
{
    case '+':
        $resultado= $op1 + $op2;
        break;
    case '-':
        $resultado= $op1 - $op2;
        break;
    case '*':
        $resultado=  $op1 * $op2;
        break;
    case '/':
        if($op2 == 0)
        {
            $resultado = "No se puede dividir entre 0.";
        }
        else
        {
            $resultado= $op1 / $op2;
        }
        break;
    default:
        $resultado = "Introduzca un operador válido";
        break;
}

    printf("Resultado: $resultado");

?>
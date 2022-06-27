<?php
//Silvia Rus Mata
//Aplicación No 5 (Números en letras)
//Realizar un programa que en base al valor numérico de una variable $num, pueda mostrarse
//por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números
//entre el 20 y el 60.
//Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.

$num = 60;
$decenas = str_split($num)[0];
$unidades = str_split($num)[1];
$textoDecenas;
$textoUnidades;
$textoAImprimir;

if($num >19 && $num < 61)
{
    if($num == 20)
    {
        $textoAImprimir = "Veinte";
    }
    else
    {
        //las decenas
        switch($decenas){
            case 2:
                $textoDecenas = "Veinti" ;
                break;
            case 3:
                $textoDecenas = "Treinta" ;
                break;
            case 4:
                $textoDecenas = "Cuarenta" ;
                break;
            case 5:
                $textoDecenas = "Cincuenta" ;
                break;
            case 6:
                $textoDecenas = "Sesenta" ;
                break;
        }
        //las unidades
        switch($unidades)
            {
                case 1:
                    $textoUnidades = "uno.";
                    break;
                case 2:
                    $textoUnidades = "dos.";
                    break;
                case 3:
                    $textoUnidades = "tres.";
                    break;
                case 4:
                    $textoUnidades = "cuatro.";
                    break;
                case 5:
                    $textoUnidades = "cinco.";
                    break;
                case 6:
                    $textoUnidades = "seis.";
                    break;
                case 7:
                    $textoUnidades = "siete.";
                    break;
                case 8:
                    $textoUnidades = "ocho.";
                    break;
                case 9:
                    $textoUnidades = "nueve.";
                    break;
    
                }      
        //armar el texto
        if($unidades == 0)
        {
            $textoAImprimir = $textoDecenas.".";
        }
        else
        {
            if($decenas == 2)
            {
                $textoAImprimir = $textoDecenas.$textoUnidades.".";
            }
            else
            {
                $textoAImprimir = $textoDecenas." y ".$textoUnidades.".";
            }           
        }
    }
}
else
{
    $textoAImprimir = "La cifra debe estar entre 10 y 60 inclusive";
}
  
    echo $textoAImprimir;
?>
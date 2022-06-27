<!-- Silvia Rus Mata -->
<!-- Aplicación No 18 (Auto - Garage)
Crear la clase Garage que posea como atributos privados:

_razonSocial (String)
_precioPorHora (Double)
_autos (Autos[], reutilizar la clase Auto del ejercicio anterior)

Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:
i. La razón social.
ii. La razón social, y el precio por hora.

Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y
que mostrará todos los atributos del objeto.
Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.
Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage”
(sólo si el auto no está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Add($autoUno);
Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
“Garage” (sólo si el auto está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Remove($autoUno);
En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos los
métodos. -->

<?php

include 'Auto.php';

class Garage
{
    private $__razonSocial;
    private $__precioPorHora;
    private $__autos = array();

    // Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:
    // i. La razón social.
    // ii. La razón social, y el precio por hora.

    public function __construct(string $razonSocial, float $precioPorHora = null)
    {
        $this->__razonSocial = $razonSocial;
        $this->__precioPorHora = $precioPorHora;
    }

    // Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y
    // que mostrará todos los atributos del objeto.

    public function MostrarGarage()
    {
        
        if($this != null)
        {
            printf("Razón social: $this->__razonSocial. <br>");
            if($this->__precioPorHora != null)
            {
                printf("Precio por hora: $this->__precioPorHora. <br>");
            }
            else
            {
                printf("Precio por hora: NO CONSTA. <br>");
            }

            if(sizeof($this->__autos) != 0)
            {
                printf("<br> AUTOS: <br>");
                foreach($this->__autos as $autoAMostrar)
                {
       
                    $autoAMostrar::MostrarAuto($autoAMostrar);
                }
            }
            else
            {
                printf("No hay autos en el garage. <br>");
            }
        }
    }

    // Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
    // objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.

    public function Equals($auto)
    {
        $retorno = false;

        foreach($this->__autos as $autoEnGarage)
        {
            if($autoEnGarage->Equals($auto, $autoEnGarage))
            {
                $retorno = true;
                break;
            }          
        }
        return $retorno;
    }

    // Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage”
    // (sólo si el auto no está en el garaje, de lo contrario informarlo).

    public function Add($auto)
    {
        if($this->Equals($auto) == 0)
        {
            array_push($this->__autos, $auto);
        }
        else
        {
            printf("El auto ya está dentro del garage.");
        }
    }

    // Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
    // “Garage” (sólo si el auto está en el garaje, de lo contrario informarlo).

    public function Remove($auto)
    {
        if($this->Equals($auto) == 0)
        {
            printf("El auto NO está dentro del garage.");
        }
        else
        {
            for($i = 0; $i < sizeof($this->__autos) ; $i++)
            {
                if($this->Equals($auto))
                {
                    unset($this->__autos[$i]);
                }
            }
        }
    }

}



?>
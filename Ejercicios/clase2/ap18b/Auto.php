<!-- Silvia Rus Mata -->
<!-- Aplicación No 18 (Auto - Garage)
Realizar una clase llamada “Auto” que posea los siguientes atributos privados:
_color (String)
_precio (Double)
_marca (String)
_fecha (DateTime)

Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:
i. La marca y el color.
ii. La marca, color y el precio.
iii. La marca, color, precio y fecha.

Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble por
parámetro y que se sumará al precio del objeto.
Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto”
por parámetro y que mostrará todos los atributos de dicho objeto.
Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
devolverá TRUE si ambos “Autos” son de la misma marca.
Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son
de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con
la suma de los precios o cero si no se pudo realizar la operación.
Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos); -->

<?php

class Auto
{
    private $__color;
    private $__precio;
    private $__marca;
    private $__fecha;

    // Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:
    // i. La marca y el color.
    // ii. La marca, color y el precio.
    // iii. La marca, color, precio y fecha.
    public function __construct(string $marca, string $color, float $precio = NULL, DateTime $fecha = NULL)
    {
        $this->__marca = $marca;
        $this->__color = $color;
        $this->__precio = $precio;
        $this->__fecha = $fecha;
    }
    
    // Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble por
    // parámetro y que se sumará al precio del objeto.
    public function AgregarImpuestos(float $aniadido)
    {
        if($this->__precio != null)
        {
            $this->__precio = $this->__precio + $aniadido;
        }
        else
        {
            return "ERROR: Asigne un precio al auto.";
        }
        
    }

    // Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto”
    // por parámetro y que mostrará todos los atributos de dicho objeto.
    public static function MostrarAuto(Auto $auto)
    {
        if($auto != null)
        {
            
            printf("<br>");
            printf("Marca: $auto->__marca <br>");
            printf("Color: $auto->__color <br>");
           

            if($auto->__precio != null)
            {
                printf("Precio: $auto->__precio <br>");
            }
            else
            {
                printf("Precio: (no consta) <br>");
            }

            if($auto->__fecha != null)
            {
               
                echo "Fecha: ".$auto->__fecha->format('Y')."<br>";
            }
            else
            {
                printf("Fecha: (no consta) <br>");
            }

        }
        else
        {
            printf("El auto no existe");
        }
    }

    // Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
    // devolverá TRUE si ambos “Autos” son de la misma marca.
    public function Equals(Auto $autoUno, Auto $autoDos)
    {
        if(($autoUno != null) && ($autoDos != null))
        {
            if($autoUno->__marca == $autoDos->__marca)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            printf("ERROR: alguno o los dos autos son nulos");
        }
    }

    // Crear un método de clase, llamado Add que permita sumar dos objetos “Auto” (sólo si son
    // de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con
    // la suma de los precios o cero si no se pudo realizar la operación.

    public static function Add (Auto $autoUno, Auto $autoDos)
    {
        if(($autoUno != null) && ($autoDos != null))
        {
            //printf("llega aquí??? 1");
         
            if($autoUno->Equals($autoUno, $autoDos) == 1 && $autoUno->__color == $autoDos->__color)
            {
                return $autoUno->__precio + $autoDos->__precio;
         
            }
            else
            {
                return "ERROR: los autos son de diferente marco y/o color";
              
            }
        }
        else
        {
            return "ERROR: alguno o los dos autos son nulos";
          
        }
    }

}

?>
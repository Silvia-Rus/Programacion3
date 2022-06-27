<!-- Silvia Rus Mata -->
<!-- Aplicación No 15 (Figuras geométricas) -->
<!-- La clase FiguraGeometrica posee: todos sus atributos protegidos, un constructor por defecto,
un método getter y setter para el atributo _color, un método virtual (ToString) y dos
métodos abstractos: Dibujar (público) y CalcularDatos (protegido).
CalcularDatos será invocado en el constructor de la clase derivada que corresponda, su
funcionalidad será la de inicializar los atributos _superficie y _perimetro.
Dibujar, retornará un string (con el color que corresponda) formando la figura geométrica del
objeto que lo invoque (retornar una serie de asteriscos que modele el objeto).
Utilizar el método ToString para obtener toda la información completa del objeto, y luego
dibujarlo por pantalla. -->

<?php

abstract class FiguraGeometrica
{
    private $_color;
    private $_perimetro;
    private $_superficie;

    // un constructor por defecto,
    public function __construct()
    {

    }
    //un método getter y setter para el atributo _color

    public function GetColor()
    {
        return $this->_color;
    }

    public function SetColor(string $color)
    {
        $this->_color = $color;
    }


    //métodos abstractos: Dibujar (público)

    public abstract function Dibujar();

     //métodos abstractos: CalcularDatos (protegido).
    
    protected abstract function CalcularDatos();


}


?>
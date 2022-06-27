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

include_once "FiguraGeometrica.php";

class Rectangulo extends FiguraGeometrica
{
    private $_ladoDos;
    private $_ladoUno;


    public function __construct($ladoUno, $ladoDos, $color)
    {
        parent::__construct();
       
        $this->_ladoUno = $ladoUno;
        $this->_ladoDos = $ladoDos;
        $this->SetColor($color);
        $this->CalcularDatos();

    }

    public function Dibujar()
    {
        $color = $this->GetColor();
        $retorno = "<h1 style='color:$color'>";
        $ladoUno = $this->_ladoUno;
        $ladoDos =  $this->_ladoDos;

        for($i = 0 ; $i < $ladoDos ; $i++)
        {
            
            for($x = 0 ; $x < $ladoUno ; $x++)
            {
                $retorno .= "*";
            }
            $retorno .="<br>";

        }
        $retorno .= "</h1>";
        return $retorno;
    }

    public function ToString()
    {
       
        printf($this->Dibujar());
       
    }
    
    
    protected function CalcularDatos()
    {
        $this->_perimetro = ($this->_ladoDos * 2) + ($this->_ladoUno * 2);
        $this->_superficie = $this->_ladoDos * $this->_ladoUno;
    }
}


?>
<!-- Silvia Rus Mata -->
<!-- Aplicación No 16 (Rectangulo - Punto)
Codificar las clases Punto y Rectangulo.
La clase Punto ha de tener dos atributos privados con acceso de sólo lectura (sólo con
getters), que serán las coordenadas del punto. Su constructor recibirá las coordenadas del
punto.
La clase Rectangulo tiene los atributos privados de tipo Punto _vertice1, _vertice2, _vertice3
y _vertice4 (que corresponden a los cuatro vértices del rectángulo).
La base de todos los rectángulos de esta clase será siempre horizontal. Por lo tanto, debe tener
un constructor para construir el rectángulo por medio de los vértices 1 y 3.
Los atributos ladoUno, ladoDos, área y perímetro se deberán inicializar una vez construido el
rectángulo.
Desarrollar una aplicación que muestre todos los datos del rectángulo y lo dibuje en la página. -->

<?php

include_once "Punto.php";

class Rectangulo
{
    private $_vertice1;
    private $_vertice2;
    private $_vertice3;
    private $_vertice4;
    public $area;
    public $ladoDos;
    public $ladoUno;
    public $perimetro;

    public function __construct($v1, $v2)
    {
        printf("llega al const");
        $this->_vertice1 = $v1;
        printf("llega al v1");
        printf("<br>");

        $this->_vertice2 = $v2;
        printf("llega al v2");
        printf("<br>");
        $this->_vertice3 = new Punto($v1->GetX(), $v2->GetY());
        printf("llega al v3");
        printf("<br>");
        $this->_vertice4 = new Punto($v2->GetX(), $v1->GetY());
        $this->ladoUno = ($this->_vertice4->GetX() - $this->_vertice1->GetX()); //base
        $this->ladoDos = ($this->_vertice3->GetY() - $this->_vertice1->GetY()); //altura
        $this->perimetro = ($this->ladoUno * 2) + ($this->ladoUno * 2);
        $this->area = $this->ladoUno * $this->ladoDos;

    }

    public function Dibujar()
    {
        $retorno = "";
        $ladoUno = $this->ladoUno;
        $ladoDos =  $this->ladoDos;

        for($i = 0 ; $i < $ladoDos ; $i++)
        {

            for($x = 0 ; $x < $ladoUno ; $x++)
            {
                $retorno .= "*";
            }
            $retorno .="<br>";

        }
        printf($retorno);
    }



}

?>
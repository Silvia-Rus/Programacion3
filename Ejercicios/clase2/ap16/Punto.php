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

class Punto
{

    private $_x;
    private $_y;

    public function __construct(int $x, int $y)
    {
        $this->_x = $x;
        $this->_y = $y;
        
    }

    public function GetX()
    {
        return $this->_x;
    }

    public function GetY()
    {
        return $this->_y;
    }
}

?>
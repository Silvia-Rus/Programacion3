<?php
include_once("fpdf/fpdf.php");

class PDF
{
    public static function hacerPDF()
    {
        
        $pdf = new Fpdf(); 
        $pdf->AddPage();

        //$pdf->Image('./assets/logo.png',10,8,33);
        $pdf->Ln(10);
        $pdf->Cell(40);

        $pdf->SetFont('Helvetica','',16);
        $pdf->Cell(60,4,'Ventas',0,1,'C');
        $pdf->Cell(40);
        $pdf->SetFont('Helvetica','',8);
        $pdf->Cell(60,4,'Silvia Rus Mata',0,1,'C');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(18,10, 'ID', 1);
        $pdf->Cell(18,10, 'ID Usuario', 1);
        $pdf->Cell(18,10, 'ID Producto', 1);
        $pdf->Cell(26,10, 'Fecha', 1);
        $pdf->Cell(18,10, 'Cantidad', 1);
        $pdf->Cell(18,10, 'Tipo Unidad', 1);
        $pdf->Cell(18,10, 'Precio', 1);
        $pdf->Cell(62,10, 'Foto', 1);


        $pdf->Ln();
        
        $lista = Venta::obtenerTodos();
        //var_dump($lista);
        
        foreach ($lista as $item) 
        {
            $pdf->Cell(18,10, $item->id, 1);
            $pdf->Cell(18,10, $item->id_usuario, 1);
            $pdf->Cell(18,10, $item->id_producto, 1);
            $pdf->Cell(26,10, $item->fecha, 1);
            $pdf->Cell(18,10, $item->cantidad, 1);
            $pdf->Cell(18,10, $item->tipoUnidad, 1);
            $pdf->Cell(18,10, $item->precio, 1);
            $pdf->Cell(62,10, $item->foto, 1);

            $pdf->Ln();
        }



        $pdf->Output(PDF::destinoPDF(),'f', $isUTF8=true);
        $pdf->Output(PDF::destinoPDF(),'i', $isUTF8=true);
        return;
    }

    public static function destinoPDF(){
        if(!file_exists("ventas/")){
            mkdir("ventas/",0777,true);
        }
        $date = new DateTime("now");
        $tiempoAhora = $date->format('Y-m-d-H_i_s');
        $nombreArchivo = "venta_".$tiempoAhora.".pdf";
        $destino = "ventas/".$nombreArchivo;
        return $destino;
    }
}


?>
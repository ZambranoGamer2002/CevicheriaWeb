<?php

      $curl = curl_init();

      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://cevicherias.informaticapp.com/clientes',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
         'Authorization: Basic YTJhYTA3YWRmaGRmcmV4ZmhnZGZoZGZlcnR0Z2VWYVRVZXpBOFQuSEYza25WTjZLUTVMSzBSc1Nwc0tPOm8yYW8wN29kZmhkZnJleGZoZ2RmaGRmZXJ0dGdlSGdrN1Q1dWswNGhrWFN1MG9GYmdBZFZ3dkxSbWt2dQ=='
      ),
      ));

      $response = curl_exec($curl);
      curl_close($curl);
      $data = json_decode($response, true);



require('./fpdf.php');


class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      //include '../../recursos/Recurso_conexion_bd.php';//llamamos a la conexion BD

      //$consulta_info = $conexion->query(" select *from hotel ");//traemos datos de la empresa desde BD
      //$dato_info = $consulta_info->fetch_object();
      $this->Image('logoB.png', 185, 5, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(45); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      // //creamos una celda o fila
      // $this->Cell(110, 15, utf8_decode('NOMBRE EMPRESA'), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      // $this->Ln(3); // Salto de línea
      // $this->SetTextColor(103); //color

      /* UBICACION */
      // $this->Cell(110);  // mover a la derecha
      // $this->SetFont('Arial', 'B', 10);
      // $this->Cell(96, 10, utf8_decode("Ubicación : "), 0, 0, '', 0);
      // $this->Ln(5);

      /* TELEFONO */
      // $this->Cell(110);  // mover a la derecha
      // $this->SetFont('Arial', 'B', 10);
      // $this->Cell(59, 10, utf8_decode("Teléfono : "), 0, 0, '', 0);
      // $this->Ln(5);

      /* COREEO */
      // $this->Cell(110);  // mover a la derecha
      // $this->SetFont('Arial', 'B', 10);
      // $this->Cell(85, 10, utf8_decode("Correo : "), 0, 0, '', 0);
      // $this->Ln(5);

      /* TELEFONO */
      // $this->Cell(110);  // mover a la derecha
      // $this->SetFont('Arial', 'B', 10);
      // $this->Cell(85, 10, utf8_decode("Sucursal : "), 0, 0, '', 0);
      // $this->Ln(10);

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(228, 100, 0);
      $this->Cell(10); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE CLIENTES "), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(228, 100, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(28, 10, utf8_decode('Nombres'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('Apellidos'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('N° Celular'), 1, 0, 'C', 1);
      $this->Cell(35, 10, utf8_decode('N° DNI'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('Correo'), 1, 1, 'C', 1);
      // $this->Cell(25, 10, utf8_decode('ESTADO'), 1, 1, 'C', 1);
   }
}

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }


//include '../../recursos/Recurso_conexion_bd.php';
//require '../../funciones/CortarCadena.php';
/* CONSULTA INFORMACION DEL HOSPEDAJE */
//$consulta_info = $conexion->query(" select *from hotel ");
//$dato_info = $consulta_info->fetch_object();

$pdf = new PDF();
$pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

/*$consulta_reporte_alquiler = $conexion->query("  ");*/

/*while ($datos_reporte = $consulta_reporte_alquiler->fetch_object()) {      
   }*/
$i = $i + 1;
/* TABLA */

foreach($data["Detalles"] as $reporte_clientes):

$pdf->Cell(28, 10, $reporte_clientes["per_nombres"], 1, 0, 'C', 0);
$pdf->Cell(25, 10, $reporte_clientes["per_apellidos"], 1, 0, 'C', 0);
$pdf->Cell(50, 10, $reporte_clientes["per_telefono"], 1, 0, 'C', 0);
$pdf->Cell(35, 10, $reporte_clientes["per_dni"], 1, 0, 'C', 0);
$pdf->Cell(50, 10, $reporte_clientes["per_correo"], 1, 1, 'C', 0);
// $pdf->Cell(25, 10, utf8_decode("total"), 1, 1, 'C', 0);

endforeach;

$pdf->Output('Reportes_Clientes.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)

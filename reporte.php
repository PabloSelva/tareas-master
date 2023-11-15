<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {

        $this->Image('logo.png', 185, 5, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
        $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
        $this->Cell(45); // Movernos a la derecha
        $this->SetTextColor(0, 0, 0); //color
        //creamos una celda o fila
        $this->Cell(110, 15, utf8_decode('InteliSys'), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
        $this->Ln(3); // Salto de línea
        $this->SetTextColor(103); //colorr


        $this->Ln(20);
         /* TITULO DE LA TABLA */
        //color
        $this->SetTextColor(228, 100, 0);
        $this->Cell(50); // mover a la derecha
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(100, 10, utf8_decode("REPORTE DE TAREAS "), 0, 1, 'C', 0);
        $this->Ln(7);

        /* CAMPOS DE LA TABLA */
        //color
        $this->SetFillColor(228, 100, 0); //colorFondo
        $this->SetTextColor(255, 255, 255); //colorTexto
        $this->SetDrawColor(163, 163, 163); //colorBorde
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(15, 10, 'Tarea', 1, 0, 'C',1);
        $this->Cell(40, 10, 'Nombre Tarea', 1, 0, 'C',1);
        $this->Cell(40, 10, 'Miembro', 1, 0, 'C',1);
        //$this->Cell(35, 10, utf8_decode('Descripción'), 1, 0, 'C',1);
        $this->Cell(35, 10, 'Fecha de inicio', 1, 0, 'C',1);
        $this->Cell(30, 10, 'Fecha de fin', 1, 0, 'C',1);
        $this->Cell(30, 10, 'Estatus', 1, 1, 'C',1);
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
}

$conexion = mysqli_connect("localhost", "root", "", "empleado");
$SQL = "SELECT lista_tareas.id, lista_tareas.task, lista_tareas.description, lista_tareas.date_created, lista_tareas.due_date,
lista_tareas.status, lista_miembros.firstname FROM lista_tareas
LEFT JOIN lista_miembros ON lista_tareas.employee_id = lista_miembros.id";
$resultado = mysqli_query($conexion, $SQL);


$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

while ($row = $resultado->fetch_assoc()) {
    $pdf->Cell(15, 10, $row['id'], 1, 0, 'C');
    $task = $row['task'];
    $maxWidth = 40;
    $maxHeight = 10;
    $pdf->Cell($maxWidth, $maxHeight, $task, 1, 0, 'C');
    $pdf->Cell(40, 10, $row['firstname'], 1, 0, 'C');
    //$descripcion = $row['description'];
    //$maxWidth = 35; // Ancho máximo de la celda de descripción
    //$pdf->Cell($maxWidth, 10, $descripcion, 1, 0, 'C');
    
    $pdf->Cell(35, 10, $row['date_created'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['due_date'], 1, 0, 'C');
    $idStatus = $row['status'];
    if ($idStatus == 0) {
        $status = 'Pendiente';
      } elseif ($idStatus == 1) {
        $status = 'En proceso';
      } elseif ($idStatus == 2) {
        $status = 'Completado';
      }
    $pdf->Cell(30, 10, $status, 1, 1, 'C');
}

$pdf->Output();
?>

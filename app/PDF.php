<?php

namespace App;
use Fpdf;

class PDF extends Fpdf {


  // Page header
	function Header()
	{
	    // Logo
	    $this->SetY(25);
	    $this->Image('img/logo2.jpg',20,15,30);
	    $this->SetFont('Helvetica','B',20);
	    // Move to the right
	    $this->Cell(100);
	    // Title
	    $this->SetTextColor(8,104,5);
	    $this->Cell(30,10,'INSTITUTE OF BIOLOGICAL SCIENCES',0,0,'C');
	    // Line break
	    $this->Ln(20);
	}

	// Page footer
	function Footer()
	{
	    // Position at 1.5 cm from bottom
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Page number
	    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}
?>
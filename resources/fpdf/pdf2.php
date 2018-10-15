<?php
require('resources/fpdf/fpdf.php');

class PDF extends FPDF {
	function Header() {
		$this->Image('resources/img/receipt/header.png',0,0);
		$this->Image('resources/img/receipt/rx.jpg',10,50,-300);
		
		$this->SetFont('Arial','B',18);
		$this->SetTextColor(36,49,142);	
		$this->Cell(0,10,'Jeffrey B. Lawas, M.D.',0,0,'C');
		$this->Ln(6);
		
		$this->SetFont('Arial','BI',11);		
		$this->Cell(0,10,'Address # 53 Spolarium Street, Cebu City',0,0,'C');
		
		$this->SetLineWidth(1);
		$this->Line(10, 26, 145, 26);
		$this->Ln(15);
	}
	
	function Footer() {
		$this->Line(10, 200, 145, 200);
		$this->SetTextColor(36,49,142);
		
		$this->SetY(-9);
		$this->SetFont('Arial','BI',10);		
		$this->Write(5, 'License No. 094634');
		
		$this->SetX(62);
		$this->Write(5, 'PTR No. 8141548');
		
		$this->SetX(110);
		$this->Write(5, 'TIN No. 223-640-145');
		/*
		$this->Cell(0,10,'License No. 094634 PTR No. 8141548',0,0,'C');
		$this->Ln(5);
		
		$this->Cell(0,10,'TIN No. 223-640-145',0,0,'C');
		$this->Ln(5);
		*/
	}
}
?>
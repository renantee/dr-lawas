<?php
require('resources/fpdf/fpdf.php');

class PDF extends FPDF {
	function Header() {
		$settings = file('resources/config.txt');
		$settings = json_decode($settings[0], true);
		
		$this->Image($settings['header'],5.5,.1,5.5);
		$this->Image($settings['rx'],5.75,1.4,1);
		
		/*
		$this->Image($settings['header'],0,.1,5.5);
		$this->Image($settings['rx'],.25,1.4,1);
		*/
		/*
		$this->Image('resources/img/receipt/header.png',0,.1,5.5);
		$this->Image('resources/img/receipt/rx.jpg',.25,1.4,1);
		*/
	}
	
	function Footer() {
		$settings = file('resources/config.txt');
		$settings = json_decode($settings[0], true);
			
		//$this->Line(.25, 8.15, 5.25, 8.15);
		//$this->Line(5.75, 8.15, 10.75, 8.15); // old coordinates
		$this->Line(5.75, 7.90, 10.75, 7.90);
		
		//$this->SetXY(.25,-.25);
		//$this->SetXY(5.75,-.25);
		$this->SetXY(5.75,-.5);
		$this->SetFont('Arial','BI',9);
		$this->Write(.1, 'License No. '.$settings['license']);
		//$this->Write(.1, 'License No. 094634');
		
		//$this->SetX(2.25);
		$this->SetX(7.75);
		$this->Write(.1, 'PTR No. '.$settings['ptr']);
		//$this->Write(.1, 'PTR No. 8141548');
		
		//$this->SetX(3.95);
		$this->SetX(9.25);
		$this->Write(.1, 'TIN No. '.$settings['tin']);
		//$this->Write(.1, 'TIN No. 223-640-145');
	}
}
?>
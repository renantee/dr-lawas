<?php
require('resources/fpdf/fpdf.php');

class PDF extends FPDF {
	function Header() {
		$settings = file('resources/config.txt');
		$settings = json_decode($settings[0], true);
		
		
		$this->Image($settings['header'],0,.1,5.5);
		$this->Image($settings['rx'],.25,1.4,1);

	}
	
	function Footer() {
		$settings = file('resources/config.txt');
		$settings = json_decode($settings[0], true);
			
		$this->Line(.25, 7.90, 5.25, 7.90);
		
		$this->SetXY(.25,-.5);
		$this->SetFont('Arial','BI',9);
		$this->Write(.1, 'License No. '.$settings['license']);
		//$this->Write(.1, 'License No. 094634');
		
		$this->SetX(2.25);
		$this->Write(.1, 'PTR No. '.$settings['ptr']);
		//$this->Write(.1, 'PTR No. 8141548');
		
		$this->SetX(3.75);
		$this->Write(.1, 'TIN No. '.$settings['tin']);
		//$this->Write(.1, 'TIN No. 223-640-145');
	}
}
?>
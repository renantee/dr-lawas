<?php
class Receipt extends CI_Controller {
	private $data;
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('Receiptmodel', 'receipt');
		$this->layout = "No";
	}	
	
	public function view($id) {
		require('resources/fpdf/pdf.php');			
		$info = $this->receipt->get_patient($id);

		$pdf = new PDF('L', 'in', array(11, 8.5));
		$pdf->AddPage();
		$pdf->SetRightMargin(.25);
		$pdf->SetXY(.2,.36);
		$pdf->SetFont('Arial','', 10);
		$pdf->Write(1, 'Patient');
		
		$pdf->SetX(.8);
		$pdf->Write(1, ': ');
		//$pdf->SetFont('','BU');		
		$pdf->Write(1, $info[0]->lastname.', '.$info[0]->firstname);
		
		$pdf->SetX(3.8);
		//$pdf->SetFont('','B');
		$pdf->Write(1, 'Date');
		$pdf->SetX(4.15);
		$pdf->Write(1, ': ');
		//$pdf->SetFont('','BU');
		$pdf->Write(1, $info[0]->date_visit);		
		$pdf->Ln(.01);
		
		$pdf->SetXY(.2,.56);
		//$pdf->SetFont('','B');
		$pdf->Write(1, 'Address');
		$pdf->SetX(.8);
		$pdf->Write(1, ': ');
		//$pdf->SetFont('','BU');
		$pdf->Write(1, $info[0]->address);
		
		$pdf->SetX(3.8);
		//$pdf->SetFont('','B');
		$pdf->Write(1, 'Age ');
		$pdf->SetX(4.15);
		$pdf->Write(1, ': ');
		//$pdf->SetFont('','BU');
		$pdf->Write(1, $info[0]->age);
		
		//$pdf->SetFont('','B');
		$pdf->Write(1, ' Sex ');
		$pdf->Write(1, ': ');
		//$pdf->SetFont('','BU');
		$pdf->Write(1, strtoupper($info[0]->sex));
		
		$pdf->Line(.25, 1.2, 5.25, 1.2);
		
		$pdf->Ln(.43);
		$medicine = $this->receipt->get_medicine($id);
		foreach($medicine as $k=>$v) {
			$k++;
			$pdf->SetX(1.35);
			$pdf->SetFont('Arial','', 10.5);
			$pdf->Write(1, "$k.) {$v->generic_name}");
			$pdf->SetFont('','I');
			$pdf->Write(1, " {$v->preparation} (#{$v->pcs})");
			$pdf->Ln(.25);
			
			$pdf->SetX(1.6);
			$pdf->SetFont('','');
			$pdf->Write(1, " ( {$v->brand_name} )");
			$pdf->Ln(.25);
			
			$pdf->SetFont('','');
			$pdf->SetX(1.6);

			$pdf->Write(1, 'Sig: '.$v->dosage);
			$pdf->Ln(.5);
		}
		
		
		$pdf->Output();
	}
	
	/*
	public function view($id, $type=1) {
		switch($type) {
			case 1:
				require('resources/fpdf/pdf.php');
				break;
				
			case 2:
				require('resources/fpdf/pdf.php');
				break;
		}
				
		$info = $this->receipt->get_patient($id);
		
		$pdf = new PDF('L');
		$pdf->SetRightMargin(150);
		$pdf->AddPage();
		
		$pdf->Line(30, 35, 107, 35);		
		$pdf->Line(121, 35, 142, 35);
		
		$pdf->Line(30, 42, 107, 42);
		$pdf->Line(121, 42, 128, 42);
		$pdf->Line(138, 42, 142, 42);
		
		$pdf->SetFont('','B', 11);
		$pdf->Write(5, 'Patient');
		$pdf->SetX(27);
		$pdf->Write(5, ': ');
		$pdf->Write(5, $info[0]->lastname.', '.$info[0]->firstname);
		
		$pdf->SetX(108);
		$pdf->SetFont('','B');
		$pdf->Write(5, 'Date');
		$pdf->SetX(118);
		$pdf->Write(5, ': ');
		$pdf->Write(5, $info[0]->date_visit);		
		$pdf->Ln(7);		
		
		$pdf->SetFont('','B');
		$pdf->Write(5, 'Address');
		$pdf->SetX(27);
		$pdf->Write(5, ': ');
		$pdf->Write(5, $info[0]->address);
		
		$pdf->SetX(108);
		$pdf->SetFont('','B');
		$pdf->Write(5, 'Age ');
		$pdf->SetX(118);
		$pdf->Write(5, ': ');
		$pdf->Write(5, $info[0]->age);
		
		$pdf->SetX(126);
		$pdf->SetFont('','B');
		$pdf->Write(5, ' Sex ');
		$pdf->Write(5, ': ');
		$pdf->Write(5, strtoupper($info[0]->sex));
		$pdf->Ln(15);		
		
		$medicine = $this->receipt->get_medicine($id);
		foreach($medicine as $k=>$v) {
			$k++;
			$pdf->SetX(30);
			$pdf->SetFont('Arial','B', 10);
			$pdf->Write(5, "$k.) {$v->generic_name}");
			$pdf->SetFont('','BI');
			$pdf->Write(5, " ({$v->brand_name})");
			$pdf->Ln(6);
			
			$pdf->SetFont('','');
			$pdf->SetX(35);
			$pdf->Write(5, $v->preparation);
			$pdf->Ln(6);
			$pdf->SetX(35);
			$pdf->Write(5, $v->dosage);
			$pdf->Ln(10);
		}
		
		
		$pdf->Output();
	}
	*/
}
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    require_once APPPATH."/third_party/fpdf/fpdf.php";

    class Pdf extends FPDF {		
		
        public function Header(){

          $this->Ln();
        $this->Image("uploads/audi.png", 20, 2, 60, 20, 'PNG');
        $this->SetFont('Arial', 'B', 10);
        //$this->Ln(10);

        //$this->SetY(-15);
           $this->SetFont('Arial','I',12);
           $this->Cell(191,0,'Pag. '.$this->PageNo().'/{nb}',0,0,'R');

            //si se requiere agregar una imagen
            //$this->Image('ruta de la imagen',x,y,ancho,alto);
            /*$this->SetFont('Arial','B',10);
            $this->Cell(30);
            $this->Cell(120,10,'TITULO CABECERA',0,0,'C');
            $this->Ln('5');*/

            //$this->Image("uploads/LOGOTIPO.png", 65, 80, 100, 100, 'PNG'); PARA MARCA DE AGUA
       }

	   public function Footer(){
           //$this->SetY(-15);
           //$this->SetFont('Arial','I',7);
           //$this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'R');*/
         
      }
}
?>
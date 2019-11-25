<?php
require('fpdf.php');

class PDF_Code128 extends FPDF {

protected $T128;                                         // Tableau des codes 128
protected $ABCset = "";                                  // jeu des caractères éligibles au C128
protected $Aset = "";                                    // Set A du jeu des caractères éligibles
protected $Bset = "";                                    // Set B du jeu des caractères éligibles
protected $Cset = "";                                    // Set C du jeu des caractères éligibles
protected $SetFrom;                                      // Convertisseur source des jeux vers le tableau
protected $SetTo;                                        // Convertisseur destination des jeux vers le tableau
protected $JStart = array("A"=>103, "B"=>104, "C"=>105); // Caractères de sélection de jeu au début du C128
protected $JSwap = array("A"=>101, "B"=>100, "C"=>99);   // Caractères de changement de jeu


function __construct($orientation='P', $unit='mm', $format='A4') {

	parent::__construct($orientation,$unit,$format);

	$this->T128[] = array(2, 1, 2, 2, 2, 2);                  
	$this->T128[] = array(2, 2, 2, 1, 2, 2);          
	$this->T128[] = array(2, 2, 2, 2, 2, 1);          
	$this->T128[] = array(1, 2, 1, 2, 2, 3);          
	$this->T128[] = array(1, 2, 1, 3, 2, 2);          
	$this->T128[] = array(1, 3, 1, 2, 2, 2);          
	$this->T128[] = array(1, 2, 2, 2, 1, 3);          
	$this->T128[] = array(1, 2, 2, 3, 1, 2);          
	$this->T128[] = array(1, 3, 2, 2, 1, 2);          
	$this->T128[] = array(2, 2, 1, 2, 1, 3);          
	$this->T128[] = array(2, 2, 1, 3, 1, 2);           
	$this->T128[] = array(2, 3, 1, 2, 1, 2);           
	$this->T128[] = array(1, 1, 2, 2, 3, 2);           
	$this->T128[] = array(1, 2, 2, 1, 3, 2);           
	$this->T128[] = array(1, 2, 2, 2, 3, 1);           
	$this->T128[] = array(1, 1, 3, 2, 2, 2);           
	$this->T128[] = array(1, 2, 3, 1, 2, 2);           
	$this->T128[] = array(1, 2, 3, 2, 2, 1);           
	$this->T128[] = array(2, 2, 3, 2, 1, 1);           
	$this->T128[] = array(2, 2, 1, 1, 3, 2);           
	$this->T128[] = array(2, 2, 1, 2, 3, 1);           
	$this->T128[] = array(2, 1, 3, 2, 1, 2);           
	$this->T128[] = array(2, 2, 3, 1, 1, 2);           
	$this->T128[] = array(3, 1, 2, 1, 3, 1);           
	$this->T128[] = array(3, 1, 1, 2, 2, 2);           
	$this->T128[] = array(3, 2, 1, 1, 2, 2);           
	$this->T128[] = array(3, 2, 1, 2, 2, 1);           
	$this->T128[] = array(3, 1, 2, 2, 1, 2);           
	$this->T128[] = array(3, 2, 2, 1, 1, 2);           
	$this->T128[] = array(3, 2, 2, 2, 1, 1);           
	$this->T128[] = array(2, 1, 2, 1, 2, 3);           
	$this->T128[] = array(2, 1, 2, 3, 2, 1);           
	$this->T128[] = array(2, 3, 2, 1, 2, 1);           
	$this->T128[] = array(1, 1, 1, 3, 2, 3);           
	$this->T128[] = array(1, 3, 1, 1, 2, 3);           
	$this->T128[] = array(1, 3, 1, 3, 2, 1);           
	$this->T128[] = array(1, 1, 2, 3, 1, 3);           
	$this->T128[] = array(1, 3, 2, 1, 1, 3);           
	$this->T128[] = array(1, 3, 2, 3, 1, 1);           
	$this->T128[] = array(2, 1, 1, 3, 1, 3);           
	$this->T128[] = array(2, 3, 1, 1, 1, 3);           
	$this->T128[] = array(2, 3, 1, 3, 1, 1);           
	$this->T128[] = array(1, 1, 2, 1, 3, 3);           
	$this->T128[] = array(1, 1, 2, 3, 3, 1);           
	$this->T128[] = array(1, 3, 2, 1, 3, 1);           
	$this->T128[] = array(1, 1, 3, 1, 2, 3);           
	$this->T128[] = array(1, 1, 3, 3, 2, 1);           
	$this->T128[] = array(1, 3, 3, 1, 2, 1);           
	$this->T128[] = array(3, 1, 3, 1, 2, 1);           
	$this->T128[] = array(2, 1, 1, 3, 3, 1);           
	$this->T128[] = array(2, 3, 1, 1, 3, 1);           
	$this->T128[] = array(2, 1, 3, 1, 1, 3);           
	$this->T128[] = array(2, 1, 3, 3, 1, 1);           
	$this->T128[] = array(2, 1, 3, 1, 3, 1);           
	$this->T128[] = array(3, 1, 1, 1, 2, 3);           
	$this->T128[] = array(3, 1, 1, 3, 2, 1);           
	$this->T128[] = array(3, 3, 1, 1, 2, 1);           
	$this->T128[] = array(3, 1, 2, 1, 1, 3);           
	$this->T128[] = array(3, 1, 2, 3, 1, 1);           
	$this->T128[] = array(3, 3, 2, 1, 1, 1);           
	$this->T128[] = array(3, 1, 4, 1, 1, 1);           
	$this->T128[] = array(2, 2, 1, 4, 1, 1);           
	$this->T128[] = array(4, 3, 1, 1, 1, 1);           
	$this->T128[] = array(1, 1, 1, 2, 2, 4);           
	$this->T128[] = array(1, 1, 1, 4, 2, 2);           
	$this->T128[] = array(1, 2, 1, 1, 2, 4);           
	$this->T128[] = array(1, 2, 1, 4, 2, 1);           
	$this->T128[] = array(1, 4, 1, 1, 2, 2);           
	$this->T128[] = array(1, 4, 1, 2, 2, 1);           
	$this->T128[] = array(1, 1, 2, 2, 1, 4);           
	$this->T128[] = array(1, 1, 2, 4, 1, 2);           
	$this->T128[] = array(1, 2, 2, 1, 1, 4);           
	$this->T128[] = array(1, 2, 2, 4, 1, 1);           
	$this->T128[] = array(1, 4, 2, 1, 1, 2);           
	$this->T128[] = array(1, 4, 2, 2, 1, 1);           
	$this->T128[] = array(2, 4, 1, 2, 1, 1);           
	$this->T128[] = array(2, 2, 1, 1, 1, 4);           
	$this->T128[] = array(4, 1, 3, 1, 1, 1);           
	$this->T128[] = array(2, 4, 1, 1, 1, 2);           
	$this->T128[] = array(1, 3, 4, 1, 1, 1);           
	$this->T128[] = array(1, 1, 1, 2, 4, 2);           
	$this->T128[] = array(1, 2, 1, 1, 4, 2);           
	$this->T128[] = array(1, 2, 1, 2, 4, 1);           
	$this->T128[] = array(1, 1, 4, 2, 1, 2);           
	$this->T128[] = array(1, 2, 4, 1, 1, 2);           
	$this->T128[] = array(1, 2, 4, 2, 1, 1);           
	$this->T128[] = array(4, 1, 1, 2, 1, 2);           
	$this->T128[] = array(4, 2, 1, 1, 1, 2);           
	$this->T128[] = array(4, 2, 1, 2, 1, 1);           
	$this->T128[] = array(2, 1, 2, 1, 4, 1);           
	$this->T128[] = array(2, 1, 4, 1, 2, 1);           
	$this->T128[] = array(4, 1, 2, 1, 2, 1);           
	$this->T128[] = array(1, 1, 1, 1, 4, 3);           
	$this->T128[] = array(1, 1, 1, 3, 4, 1);           
	$this->T128[] = array(1, 3, 1, 1, 4, 1);           
	$this->T128[] = array(1, 1, 4, 1, 1, 3);           
	$this->T128[] = array(1, 1, 4, 3, 1, 1);           
	$this->T128[] = array(4, 1, 1, 1, 1, 3);          
	$this->T128[] = array(4, 1, 1, 3, 1, 1);           
	$this->T128[] = array(1, 1, 3, 1, 4, 1);           
	$this->T128[] = array(1, 1, 4, 1, 3, 1);                           
	$this->T128[] = array(3, 1, 1, 1, 4, 1);          
	$this->T128[] = array(4, 1, 1, 1, 3, 1);           
	$this->T128[] = array(2, 1, 1, 4, 1, 2);           
	$this->T128[] = array(2, 1, 1, 2, 1, 4);           
	$this->T128[] = array(2, 1, 1, 2, 3, 2);           
	$this->T128[] = array(2, 3, 3, 1, 1, 1);           
	$this->T128[] = array(2, 1);                       

	for ($i = 32; $i <= 95; $i++) {                                            
		$this->ABCset .= chr($i);
	}
	$this->Aset = $this->ABCset;
	$this->Bset = $this->ABCset;

	for ($i = 0; $i <= 31; $i++) {
		$this->ABCset .= chr($i);
		$this->Aset .= chr($i);
	}
	for ($i = 96; $i <= 127; $i++) {
		$this->ABCset .= chr($i);
		$this->Bset .= chr($i);
	}
	for ($i = 200; $i <= 210; $i++) {                                           
		$this->ABCset .= chr($i);
		$this->Aset .= chr($i);
		$this->Bset .= chr($i);
	}
	$this->Cset="0123456789".chr(206);

	for ($i=0; $i<96; $i++) {                                                   
		@$this->SetFrom["A"] .= chr($i);
		@$this->SetFrom["B"] .= chr($i + 32);
		@$this->SetTo["A"] .= chr(($i < 32) ? $i+64 : $i-32);
		@$this->SetTo["B"] .= chr($i);
	}
	for ($i=96; $i<107; $i++) {                                                 
		@$this->SetFrom["A"] .= chr($i + 104);
		@$this->SetFrom["B"] .= chr($i + 104);
		@$this->SetTo["A"] .= chr($i);
		@$this->SetTo["B"] .= chr($i);
	}
}






function Code128($x, $y, $code, $w, $h) {
	$Aguid = "";                                                                     
	$Bguid = "";
	$Cguid = "";
	for ($i=0; $i < strlen($code); $i++) {
		$needle = substr($code,$i,1);
		$Aguid .= ((strpos($this->Aset,$needle)===false) ? "N" : "O"); 
		$Bguid .= ((strpos($this->Bset,$needle)===false) ? "N" : "O"); 
		$Cguid .= ((strpos($this->Cset,$needle)===false) ? "N" : "O");
	}

	$SminiC = "OOOO";
	$IminiC = 4;

	$crypt = "";
	while ($code > "") {

		$i = strpos($Cguid,$SminiC);                                                
		if ($i!==false) {
			$Aguid [$i] = "N";
			$Bguid [$i] = "N";
		}

		if (substr($Cguid,0,$IminiC) == $SminiC) {                                  
			$crypt .= chr(($crypt > "") ? $this->JSwap["C"] : $this->JStart["C"]);   
			$made = strpos($Cguid,"N");                                             
			if ($made === false) {
				$made = strlen($Cguid);
			}
			if (fmod($made,2)==1) {
				$made--;                                                            
			}
			for ($i=0; $i < $made; $i += 2) {
				$crypt .= chr(strval(substr($code,$i,2)));                          
			}
			$jeu = "C";
		} else {
			$madeA = strpos($Aguid,"N");                                      
			if ($madeA === false) {
				$madeA = strlen($Aguid);
			}
			$madeB = strpos($Bguid,"N");                      
			if ($madeB === false) {
				$madeB = strlen($Bguid);
			}
			$made = (($madeA < $madeB) ? $madeB : $madeA );                     
			$jeu = (($madeA < $madeB) ? "B" : "A" );               

			$crypt .= chr(($crypt > "") ? $this->JSwap[$jeu] : $this->JStart[$jeu]); 
			$crypt .= strtr(substr($code, 0,$made), $this->SetFrom[$jeu], $this->SetTo[$jeu]); 

		}
		$code = substr($code,$made);                                           
		$Aguid = substr($Aguid,$made);
		$Bguid = substr($Bguid,$made);
		$Cguid = substr($Cguid,$made);
	}                                                                          

	$check = ord($crypt[0]);                                                    
	for ($i=0; $i<strlen($crypt); $i++) {
		$check += (ord($crypt[$i]) * $i);
	}
	$check %= 103;

	$crypt .= chr($check) . chr(106) . chr(107);                               

	$i = (strlen($crypt) * 11) - 8;                                             
	$modul = $w/$i;

	for ($i=0; $i<strlen($crypt); $i++) {                                      
		$c = $this->T128[ord($crypt[$i])];
		for ($j=0; $j<count($c); $j++) {
			$this->Rect($x,$y,$c[$j]*$modul,$h,"F");
			$x += ($c[$j++]+$c[$j])*$modul;
		}
	}
}


}


?>

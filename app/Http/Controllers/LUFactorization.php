<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factorization;

class LUFactorization extends Controller
{
    public function LUHome(){
    	return view('opm.LU_Home');
    }

	public function IzracunajDeterminantu($matrica) {
		$det = 1;
		$velicina = count($matrica);
		for($x = 0; $x < $velicina; $x++)
			$det *= $matrica[$x][$x];		
		return $det;
	}	

	function ProvjeriNule($matrica){
		$velicina = count($matrica);
		$pom = 0;		
		for($i = 0; $i < $velicina; $i++){
			if($matrica[0][0] == 0){
				if($matrica[$i][0] != 0){
					$pom = $matrica[0];
					$matrica[0] = $matrica[$i];
					$matrica[$i] = $pom;
				}					
			}						
		}
		return($matrica);
	}

	function IzracunajDonjeTrokutastu($matrica, $k = 0, $pivot = false){	
		
		$velicina = count($matrica);
		$pom = $matrica;
		$brojevi = array();				
		
		for($x = $k; $x < $velicina; $x++){

			for($y = $x; $y < $velicina - 1; $y++){

				//broj za množenje reda
				if($pom[$x][$x] == 0) break;
				
				$broj = ($pom[$y + 1][$x] / $pom[$x][$x]) ;												
				
				if($broj != 0){
					$key = $y+1 . "-".$x;				
					$brojevi[$key] = $broj;					
				}				
				
				//množenje reda				
				for($i = 0; $i < $velicina; $i++)
					$pom[$y +1][$i] += $broj * $pom[$x][$i]* -1; 				
			}				
			if($pivot) break;
		}		
		
		$a = array($pom);
		$b = array($brojevi);			
		$c = array_merge($a,$b);		
		return $c;
	}
	
	public function IzracunajGornjeTrokutastu($matrica,$brojevi,$pivot){	
		$velicina = count($matrica);
		$pom = $matrica;
		$i = 0;			
		for($x = 0; $x < $velicina; $x++){
			$pom[$x][$x] = 1;
			for($y = $x; $y < $velicina - 1; $y++)
				$pom[$x][$y + 1] = 0;			
		}		
		if($pivot)
			for($i = 0; $i < count($brojevi); $i++){
				foreach ($brojevi[$i] as $key => $value) {
					$mat = explode("-", $key);
					$pom[$mat[0]][$mat[1]] = $value;
				}
			}
		else
			foreach ($brojevi as $key => $value) {
					$mat = explode("-", $key);
					$pom[$mat[0]][$mat[1]] = $value;
				}
		return $pom;		
	}
	
	public function Pivotiranje($matrica){

		$velicina = count($matrica);
		$pom = $matrica;
		$p = array();
		
		//postavljanje P matrice
		for ($x=0; $x < $velicina ; $x++)
			for ($y=0; $y < $velicina ; $y++){
				if($x == $y)
					$p[$x][$y] = 1;
				else
					$p[$x][$y] = 0;
			}								
		
		$max = 0;		
		$brojevi = array();		
		$zamjena = array();		
		
		for($x = 0; $x < $velicina -1; $x++){
			$red = 0;
			
			//traženje max u stupcu
			$max = $pom[$x][$x];
			
			for($y = $x; $y < $velicina; $y++){
				if($pom[$y][$x] > $max && $pom[$y][$x] > $pom[$x][$x]){					
					$max = $pom[$y][$x];
					$red = $y;
				}
			}	

			//zamjena ako je potrebno		
			if($red != 0){
				$pomRed = $pom[$x];
				$pom[$x] = $pom[$red];
				$pom[$red] = $pomRed;

				$pomRed = $p[$x];
				$p[$x] = $p[$red];
				$p[$red] = $pomRed;			
				if($x!=0)
					$zamjena[$red] = $x;
			}											
			$u = $this->IzracunajDonjeTrokutastu($pom, $x, true);				
			$pom = $u[0];
			array_push($brojevi, $u[1]);				
		}

		$l = $this->IzracunajGornjeTrokutastu($matrica,$brojevi,true);
		$u = array($pom);
		$finL = array($l);
		$finP = array($p);
		$mArray = array_merge($u,$finL,$finP);		

		return $mArray;
	}

	public function DohvatiVrijednosti(){		
		$velicina = $_POST['operacija'];

		for($x = 0; $x < $velicina; $x++)
			for($y = 0; $y < $velicina; $y++)
				$matrica[$x][$y] = $_POST['a'. $x . $y];

		return $matrica;										
	}

	public function IspisMatrice($matrica){
		for($x = 0; $x < count($matrica); $x++){
			for($y = 0; $y < count($matrica); $y++)
				echo $matrica[$x][$y] . " | ";
			echo "</br>";
		}
	}

	function LinearneJednadzbe($matrica, $matricaRjesenja){						
		echo "</br>";
		
		for ($x=0; $x < count($matrica); $x++){
			
			//prvo podijelimo cijeli red s vodećim da bi
			//kod vodećeg dobili '1'
			$broj = $matrica[$x][$x];
			if($broj == 0) $broj  = 1;
			
			for ($i=$x; $i < count($matrica); $i++)
				$matrica[$x][$i] /= $broj;

			$matricaRjesenja[$x] /= $broj;				
			//----------------------------------------------\\		
			
			

			//---------------Donjetrokutasta------------------\\		
			for ($k=$x+1; $k < count($matrica); $k++) { 
				
				$broj = $matrica[$k][$x] / $matrica[$x][$x] * -1;

				for ($i=$x; $i < count($matrica) ; $i++)
					$matrica[$k][$i] += $matrica[$x][$i] * $broj;				

				$matricaRjesenja[$k] += $matricaRjesenja[$x] * $broj;
			}
			
			//---------------Gornjetrokutasta------------------\\
			for ($k=$x-1; $k >= 0 ; $k--) { 

				$broj = $matrica[$k][$x] / $matrica[$x][$x] * -1;

				for ($i=$x; $i < count($matrica) ; $i++)
					$matrica[$k][$i] += $matrica[$x][$i] * $broj;									

				$matricaRjesenja[$k] += $matricaRjesenja[$x] * $broj;
			}
			//----------------------------------------------\\			
			
		}
		$this->IspisMatrice($matrica);
		echo "</br>";
		print_r($matricaRjesenja);
	}

	public function DohvatiIzBaze(Request $request){
		
		$zadatak = $request->get('zadatak');		
		$pivotiranje = $request->get('pivotiranje');
		$zadatakIzBaze = Factorization::where('zadatak_broj', '=', $zadatak)->firstOrFail();		
		$velicina = $zadatakIzBaze['velicina_matrice'];		
		$matricaIzBaze = explode(" ",$zadatakIzBaze['matrica']);
		$matricaRjesenja = explode(" ",$zadatakIzBaze['rjesenje']);

		
		$i=0;
		for($x = 0; $x < $velicina; $x++)
			for($y = 0; $y < $velicina; $y++)
				$matrica[$x][$y] = $matricaIzBaze[$i++];		

		if($matricaRjesenja[0] != null){			
			$lin = $this->LinearneJednadzbe($matrica,$matricaRjesenja);
			$rjesenja= $lin[1];			
			//return view('opm.LU_lin',compact('matrica','rjesenja','matricaRjesenja'));
		}
		else{						
			
			if($pivotiranje == 1){
				
				$matrica = $this->ProvjeriNule($matrica);		
				$pivot = $this->pivotiranje($matrica);
				$u = $pivot[0];					
				$l = $pivot[1];
				$p = $pivot[2];	
				$det = $this->IzracunajDeterminantu($u);			
			}		
			else{			
				
				$matrica = $this->ProvjeriNule($matrica);			
				
				$merge = $this->IzracunajDonjeTrokutastu($matrica);							
				
				$l = $this->IzracunajGornjeTrokutastu($merge[0],$merge[1],false);
		
				$det = $this->IzracunajDeterminantu($merge[0]);
				
				$u = $merge[0];
			}		
			if(count($matrica) > 5)		
				$stil = "ispis-okomito";
			else 
				$stil = "ispis";		

			return view('opm.LU_Home',compact('u','l','det','matrica','p','stil'));
		}		
	}

	public function Izracunaj(){		
		
		$matrica = $this->DohvatiVrijednosti();		
		
		if(isset($_POST['pivotiranje'])){
			$matrica = $this->ProvjeriNule($matrica);	
			$pivot = $this->pivotiranje($matrica);
			$u = $pivot[0];
			$l = $pivot[1];
			$p = $pivot[2];
			$det = $this->IzracunajDeterminantu($u);			
		}		
		
		else{			
			$matrica = $this->ProvjeriNule($matrica);	
			$merge = $this->IzracunajDonjeTrokutastu($matrica);					
			$l = $this->IzracunajGornjeTrokutastu($matrica,$merge[1],false);
			$det = $this->IzracunajDeterminantu($merge[0]);
			$u = $merge[0];			
		}		
		if(count($matrica) > 5)		
			$stil = "ispis-okomito";
		else 
			$stil = "ispis";
		return view('opm.LU_Home',compact('u','l','det','matrica','p','stil'));
	}
}
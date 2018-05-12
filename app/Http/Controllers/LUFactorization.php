<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LUFactorization extends Controller
{
    public function LUHome(){
    	return view('opm.LU_Home');
    }

	function IzracunajDeterminantu($matrica) {
		$det = 1;
		$velicina = count($matrica);
		for($x = 0; $x < $velicina; $x++)
			$det *= $matrica[$x][$x];		
		return $det;
	}	

	function IzracunajDonjeTrokutastu($matrica,$k = 0,$pivot = false){	
		$velicina = count($matrica);
		$pom = $matrica;
		$brojevi = array();				
		for($x = $k; $x < $velicina; $x++){

			for($y = $x; $y < $velicina - 1; $y++){

				//broj za množenje reda
				if($pom[$x][$x] == 0) break;
				$broj = ($pom[$y + 1][$x] / $pom[$x][$x]) ;												
				array_push($brojevi, $broj);
				
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
	public function IzracunajGornjeTrokutastu($matrica,$brojevi){	
		$velicina = count($matrica);
		$pom = $matrica;
		$i = 0;		
		for($x = 0; $x < $velicina; $x++){
			$pom[$x][$x] = 1;
			for($y = $x; $y < $velicina - 1; $y++){
				$pom[$y + 1][$x] = $brojevi[$i++];
				$pom[$x][$y + 1] = 0;
			}
		}
		return $pom;		
	}
	public function Pivotiranje($matrica){

		$velicina = count($matrica);
		$pom = $matrica;
		$p = array();
		for ($x=0; $x < 3 ; $x++)
			for ($y=0; $y < 3 ; $y++)				
				$p[$x][$y] = 0;
		$p[0][0] = 1;
		$p[1][1] = 1;
		$p[2][2] = 1;
		$max = 0;
		$stupac = 0;
		$brojevi = array();		
		$zamjena = array();		
		
		for($x = 0; $x < $velicina -1; $x++){
			
			//traženje max u stupcu
			$max = $pom[$x][$x];
			for($y = $x; $y < $velicina; $y++){
				if($pom[$y][$x] > $max){					
					$max = $pom[$y][$x];
					$stupac = $y;
				}
			}	

			//zamjena ako je potrebno		
			if($stupac != 0){
				$pomRed = $pom[$x];
				$pom[$x] = $pom[$stupac];
				$pom[$stupac] = $pomRed;

				$pomRed = $p[$x];
				$p[$x] = $p[$stupac];
				$p[$stupac] = $pomRed;			
				if($x!=0)
					$zamjena[$stupac] = $x;
			}											
			$u = $this->IzracunajDonjeTrokutastu($pom, $x, true);				
			$pom = $u[0];
			
			if(array_sum($u[1]) != 0 )
				foreach ($u[1] as $value)					
					array_push($brojevi, $value);		
		}				

		foreach ($zamjena as $key => $value) {
			$pomB = $brojevi[$key - 1];
			$brojevi[$key - 1] = $brojevi[$value - 1];
			$brojevi[$value - 1] = $pomB;
		}

		$l = $this->IzracunajGornjeTrokutastu($matrica,$brojevi);
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

	public function Izracunaj(){
		$matrica = $this->DohvatiVrijednosti();		

		if(isset($_POST['pivotiranje'])){
			$pivot = $this->pivotiranje($matrica);
			$u = $pivot[0];
			$l = $pivot[1];
			$p = $pivot[2];
			$det = $this->IzracunajDeterminantu($u);			
		}
		else{			
			
			$merge = $this->IzracunajDonjeTrokutastu($matrica);		
			$l = $this->IzracunajGornjeTrokutastu($matrica,$merge[1]);
			$det = $this->IzracunajDeterminantu($merge[0]);
			$u = $merge[0];			
		}		
		return view('opm.LU_Home',compact('u','l','det','matrica','p'));
	}
}
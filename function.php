<?php
	
	function division($divid, $divis){
		$dividende = (int)$divid;
		$diviseur = (int)$divis;
		$quotient = (int)($dividende / $diviseur);
		$reste = $dividende % $diviseur;
		$n1 = array_map('intval', str_split($dividende));
		$n2 = array_map('intval', str_split($diviseur));
		$n3 = array_map('intval', str_split($quotient));
		$p = array();
		$c = 0;
		$id = 1;

		$t  = '<table><tr>';
		$t .= '<td colspan="'.(count($n1)+1).'">Dividende</td>';
		$t .= '<td class="ver dividende"></td>';
		$t .= '<td colspan="'.(count($n2)).'" class="diviseur">Diviseur</td></tr>';
		$t .= '<tr><td rowspan="3" class="moins">-</td>';
		for ($i = 0; $i < count($n1); $i++) {
			$t .= '<td><input type="text" value="'.$n1[$i].'" readonly disabled></td>';
		}
		$t .= '<td rowspan="'.((3*count($n3))+2).'" class="ver"></td>';

		for ($i = 0; $i < count($n2); $i++) {
			$t .= '<td><input type="text" class="q" value="'.$n2[$i].'" readonly disabled></td>';
		}
		$t .= '</tr>';
		$t .= '<tr><td colspan="'.count($n1).'" style="height:3px;"></td>';
		$t .= '<td colspan="'.max(count($n2),count($n3)).'" class="hor"></td></tr>';

		$newDiv = (int)($dividende*pow(10,count($n2)-count($n1)));
		if ($newDiv >= $diviseur) { 
			$c = strlen($newDiv);
			$l = 1; 
		}
		else {
			$newDiv = (int)($dividende*pow(10,count($n2)-count($n1)+1));
			$c = strlen($newDiv);
			$l = 2; 
		}
		for ($j = 0; $j < strlen($quotient); $j++) {
			$pr = ($j == 0) ? ($newDiv) : (($r*10)+$n1[$c-1]);
			$p = $n3[$j]*$diviseur; 
			$r = $pr - $p;
			$pri = array_map('intval', str_split($pr));
			$pi  = array_map('intval', str_split($p));
			$ri  = array_map('intval', str_split($r));

			$id = ($j == 0) ? (count($pi)+1) : ($id + strlen($pr));
			$t .= '<tr>';
			if(strlen($p) < strlen($pr) && $p !== 0){
				for ($i = 0; $i < $c-count($pi); $i++) {
					$t .= '<td></td>';
				}
				for ($i = 0; $i < (count($pi)); $i++) {
					$var = ($p==0)?($id-$i-1):($id-$i);
					$t .= '<td><input type="text" class="case p'.($j+1).'" id="id'.($id-$i).'">';
					$t .= '<input type="hidden" value="'.$pi[$i].'"></td>';
				}
			}
			elseif ($p==0) {
				for ($i = 0; $i < $c-count($pri); $i++) {
					$t .= '<td></td>';
				}
				for ($i = 0; $i < count($pri); $i++) {
					if ($i==0) {
						$t .= '<td><input type="text" class="case p'.($j+1).'" id="id'.($id).'">';
						$t .= '<input type="hidden" value="0"></td>';
					}
					else {
						$t .= '<td><input type="text" class="case p'.($j+1).'" id="id'.($id-$i).'">';
						$t .= '<input type="hidden" value="'.$pi[$i-1].'"></td>';
					}
				}
			}
			else {
				for ($i = 0; $i < $c-count($pi); $i++) { $t .= '<td></td>'; }
				for ($i = 0; $i < count($pi); $i++) {
					$t .= '<td><input type="text" class="case p'.($j+1).'" id="id'.($id-$i).'">';
					$t .= '<input type="hidden" value="'.($pi[$i]).'"></td>';
				}
			}
			if ($j == 0) {
				if (count($n1)>$c) { $t .= '<td colspan="'.(count($n1)-$c).'"></td>'; }
				$s = 1;
				$r0 = $r;
				for ($i = 0; $i < count($n3); $i++) {
					$t .= '<td>';
					$t .= '<input type="text" class="case q'.($j+1).'" id="id'.($s).'">';
					$t .= '<input type="hidden" value="'.($n3[$i]).'">';
					$t .= '</td>';
					if ($i==0) { $s += (strlen($p)+strlen($r)+2); }
					else {
						$pr0 = ($r0*10)+$n1[count($n2)+$i-1];
						$p0 = $n3[$i]*$diviseur;
						$r0 = $pr0 - $p0;
						if($p0 == 0){$s += (strlen($r0)+strlen($pr0)+2);}
						else { $s += (strlen($p0)+strlen($r0)+2); }	
					}
				}
			}
			$t .= '</tr>';
			$t .= '<tr><td colspan="'.($j+count($n2)+$l).'" class="hor"></td></tr><tr>';
			if($j < (strlen($quotient)-1)){
				$t .= '<td rowspan="2" class="moins">-</td>';
			}
			else {
				$t .= '<td class="moins">=</td>';
			}
			for ($i = 0; $i < $c-strlen($r); $i++) {
				$t .= '<td></td>';
			}
			$id = $id + (count($ri));
			if(strlen($r) <= strlen($p)){
				for ($i = 0; $i < count($ri); $i++) {
					$t .= '<td>';
					$t .= '<input type="text" class="case p'.($j+1).'" id="id'.($id-$i).'">';
					$t .= '<input type="hidden" value="'.($ri[$i]).'">';
					$t .= '</td>';
				}
			}
			else {
				for ($i = 0; $i < count($ri); $i++) {
					$t .= '<td>';
					$t .= '<input type="text" class="case r'.($j+1).'" id="id'.($id-$i).'">';
					$t .= '<input type="hidden" value="'.($ri[$i]).'">';
					$t .= '</td>';
				}
			}
			if (isset($n1[$c])) {
				$t .= '<td>';
				$t .= '<input type="text" class="case x'.($j+1).'" id="id'.($id+1).'">';
				$t .= '<input type="hidden" value="'.($n1[$c]).'">';
				$t .= '</td>';
			}
			if($j == 0) {
				if (count($n1)-strlen($p) > 0) {
					$t .= '<td colspan="'.(count($n1)-$c-1).'"></td>';
				}
				$t .= '<td colspan="'.count($n3).'" class="quotient">Quotient</td>';
			}
			$t .= '</tr>';
			$c = $c + 1;
			$id += ($p==0)?(1):(2);
		}
		$t .= '</table><hr>';
		$t .= '<center>';
		$t .= '<form method="post" action="">';
		$t .= '<input type="button" class="btn btn-success mr-5 mb-3" value="Corrige" id="solution">';
		$t .= '<input type="submit" class="btn btn-info ml-5 mb-3" name="btn" value="Suivant">';
		$t .= '</form>';
		$t .= '</center>';

		return $t;
	}

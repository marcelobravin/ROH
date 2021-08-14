<?php
/**
 * Verifica se o valor se encaixa no padrão
 *
 * @param	string
 * @return	bool
 *
 * @example
		números para testes:
		01.004.823/001-12 AC
		240000048 AL
		030123459 AP
		999999990 AM
		123456-63 BA
		06000001-5 CE
		073.00001.001-09 DF
		999999990 ES
		10.987.654-7 GO
		120000385 MA
		0013000001-9 MT
		283115947 MS
		062.307.904/0081 MG
		15-999999-5 PA
		06000001-5 PB
		123.45678-50 PR
		0321418-40 PE
		18.1.001.0000004-9 PE
		012345679 PI
		99999993 RJ
		20.040.040-1 RN
		20.0.040.040-0 RN
		224/3658792 RS
		101.62521-3 RO
		0000000062521-3 RO
		24006628-1 RR
		251.040.852 SC
		110.042.490.114 SP
		27123456-3 SE
		29010227836 TO
 */
function CheckIE($ie, $uf) {
	if ( strtoupper($ie) == 'ISENTO' ) {
		return 1;
	} else {
		$uf = strtoupper($uf);
		$ie = preg_replace("[()-./,:]", "", $ie);

		$resultado = false;

		if ($uf == 'AC') { $resultado = CheckIEAC($ie); }
		if ($uf == 'AL') { $resultado = CheckIEAL($ie); }
		if ($uf == 'AM') { $resultado = CheckIEAM($ie); }
		if ($uf == 'AP') { $resultado = CheckIEAP($ie); }
		if ($uf == 'BA') { $resultado = CheckIEBA($ie); }
		if ($uf == 'CE') { $resultado = CheckIECE($ie); }
		if ($uf == 'DF') { $resultado = CheckIEDF($ie); }
		if ($uf == 'ES') { $resultado = CheckIEES($ie); }
		if ($uf == 'GO') { $resultado = CheckIEGO($ie); }
		if ($uf == 'MA') { $resultado = CheckIEMA($ie); }
		if ($uf == 'MT') { $resultado = CheckIEMT($ie); }
		if ($uf == 'MS') { $resultado = CheckIEMS($ie); }
		if ($uf == 'MG') { $resultado = CheckIEMG($ie); }
		if ($uf == 'PA') { $resultado = CheckIEPA($ie); }
		if ($uf == 'PB') { $resultado = CheckIEPB($ie); }
		if ($uf == 'PR') { $resultado = CheckIEPR($ie); }
		if ($uf == 'PE') { $resultado = CheckIEPE($ie); }
		if ($uf == 'PI') { $resultado = CheckIEPI($ie); }
		if ($uf == 'RJ') { $resultado = CheckIERJ($ie); }
		if ($uf == 'RN') { $resultado = CheckIERN($ie); }
		if ($uf == 'RS') { $resultado = CheckIERS($ie); }
		if ($uf == 'RO') { $resultado = CheckIERO($ie); }
		if ($uf == 'RR') { $resultado = CheckIERR($ie); }
		if ($uf == 'SC') { $resultado = CheckIESC($ie); }
		if ($uf == 'SP') { $resultado = CheckIESP($ie); }
		if ($uf == 'SE') { $resultado = CheckIESE($ie); }
		if ($uf == 'TO') { $resultado = CheckIETO($ie); }

		return $resultado;
	}
}

// INSCRIÇÂO ESTADUAL ==========================================================
//Acre
function CheckIEAC($ie) {
	if (strlen($ie) != 13) {return 0;}
	else{
		if (substr($ie, 0, 2) != '01') {return 0;}
		else{
			$b = 4;
			$soma = 0;
			for ($i=0;$i<=10;$i++) {
				$soma += $ie[$i] * $b;
				$b--;
				if ($b == 1) {$b = 9;}
			}
			$dig = 11 - ($soma % 11);
			if ($dig >= 10) {$dig = 0;}
			if ( $dig != $ie[11] ) {return 0;}
			else{
				$b = 5;
				$soma = 0;
				for($i=0;$i<=11;$i++) {
					$soma += $ie[$i] * $b;
					$b--;
					if ($b == 1) {$b = 9;}
				}
				$dig = 11 - ($soma % 11);
				if ($dig >= 10) {$dig = 0;}

				return ($dig == $ie[12]);
			}
		}
	}
}

// Alagoas
function CheckIEAL($ie) {
	if (strlen($ie) != 9) {return 0;}
	else{
		if (substr($ie, 0, 2) != '24') {return 0;}
		else{
			$b = 9;
			$soma = 0;
			for($i=0;$i<=7;$i++) {
				$soma += $ie[$i] * $b;
				$b--;
			}
			$soma *= 10;
			$dig = $soma - ( ( (int)($soma / 11) ) * 11 );
			if ($dig == 10) {$dig = 0;}

			return ($dig == $ie[8]);
		}
	}
}

//Amazonas
function CheckIEAM($ie) {
	if (strlen($ie) != 9) {return 0;}
	else{
		$b = 9;
		$soma = 0;
		for($i=0;$i<=7;$i++) {
			$soma += $ie[$i] * $b;
			$b--;
		}
		if ($soma <= 11) {$dig = 11 - $soma;}
		else{
			$r = $soma % 11;
			if ($r <= 1) {$dig = 0;}
			else{$dig = 11 - $r;}
		}

		return ($dig == $ie[8]);
	}
}

//Amapá
function CheckIEAP($ie) {
	if (strlen($ie) != 9) {return 0;}
	else{
		if (substr($ie, 0, 2) != '03') {return 0;}
		else{
			$i = substr($ie, 0, -1);
			if ( ($i >= 3000001) && ($i <= 3017000) ) {$p = 5; $d = 0;}
			elseif ( ($i >= 3017001) && ($i <= 3019022) ) {$p = 9; $d = 1;}
			elseif ($i >= 3019023) {$p = 0; $d = 0;}

			$b = 9;
			$soma = $p;
			for($i=0;$i<=7;$i++) {
				$soma += $ie[$i] * $b;
				$b--;
			}
			$dig = 11 - ($soma % 11);
			if ($dig == 10) {$dig = 0;}
			elseif ($dig == 11) {$dig = $d;}

			return ($dig == $ie[8]);
		}
	}
}

//Bahia
function CheckIEBA($ie) {
	if (strlen($ie) != 8) {return 0;}
	else{

		$arr1 = array('0','1','2','3','4','5','8');
		$arr2 = array('6','7','9');

		$i = substr($ie, 0, 1);

		if (in_array($i, $arr1)) {$modulo = 10;}
		elseif (in_array($i, $arr2)) {$modulo = 11;}

		$b = 7;
		$soma = 0;
		for($i=0;$i<=5;$i++) {
			$soma += $ie[$i] * $b;
			$b--;
		}

		$i = $soma % $modulo;
		if ($modulo == 10) {
			if ($i == 0) { $dig = 0; } else { $dig = $modulo - $i; }
		}else{
			if ($i <= 1) { $dig = 0; } else { $dig = $modulo - $i; }
		}
		if ( $dig != $ie[7] ) {return 0;}
		else{
			$b = 8;
			$soma = 0;
			for($i=0;$i<=5;$i++) {
				$soma += $ie[$i] * $b;
				$b--;
			}
			$soma += $ie[7] * 2;
			$i = $soma % $modulo;
			if ($modulo == 10) {
				if ($i == 0) { $dig = 0; } else { $dig = $modulo - $i; }
			}else{
				if ($i <= 1) { $dig = 0; } else { $dig = $modulo - $i; }
			}

			return ($dig == $ie[6]);
		}
	}
}

//Ceará
function CheckIECE($ie) {
	if (strlen($ie) != 9) {return 0;}
	else{
		$b = 9;
		$soma = 0;
		for($i=0;$i<=7;$i++) {
			$soma += $ie[$i] * $b;
			$b--;
		}
		$dig = 11 - ($soma % 11);

		if ($dig >= 10) {$dig = 0;}

		return ($dig == $ie[8]);
	}
}

// Distrito Federal
function CheckIEDF($ie) {
	if (strlen($ie) != 13) {return 0;}
	else{
		if ( substr($ie, 0, 2) != '07' ) {return 0;}
		else{
			$b = 4;
			$soma = 0;
			for ($i=0;$i<=10;$i++) {
				$soma += $ie[$i] * $b;
				$b--;
				if ($b == 1) {$b = 9;}
			}
			$dig = 11 - ($soma % 11);
			if ($dig >= 10) {$dig = 0;}

			if ( $dig != $ie[11] ) {return 0;}
			else{
				$b = 5;
				$soma = 0;
				for($i=0;$i<=11;$i++) {
					$soma += $ie[$i] * $b;
					$b--;
					if ($b == 1) {$b = 9;}
				}
				$dig = 11 - ($soma % 11);
				if ($dig >= 10) {$dig = 0;}

				return ($dig == $ie[12]);
			}
		}
	}
}

//Espirito Santo
function CheckIEES($ie) {
	if (strlen($ie) != 9) {return 0;}
	else{
		$b = 9;
		$soma = 0;
		for($i=0;$i<=7;$i++) {
			$soma += $ie[$i] * $b;
			$b--;
		}
		$i = $soma % 11;
		if ($i < 2) {$dig = 0;}
		else{$dig = 11 - $i;}

		return ($dig == $ie[8]);
	}
}

//Goias
function CheckIEGO($ie) {
	if (strlen($ie) != 9) {return 0;}
	else{
		$s = substr($ie, 0, 2);

		if ( !( ($s == 10) || ($s == 11) || ($s == 15) ) ) {return 0;}
		else{
			$n = substr($ie, 0, 7);

			if ($n == 11094402) {
				if ($ie[8] != 0) {
					if ($ie[8] != 1) {
						return 0;
					}else{return 1;}
				}else{return 1;}
			}else{
				$b = 9;
				$soma = 0;
				for($i=0;$i<=7;$i++) {
					$soma += $ie[$i] * $b;
					$b--;
				}
				$i = $soma % 11;
				if ($i == 0) {$dig = 0;}
				else{
					if ($i == 1) {
						if (($n >= 10103105) && ($n <= 10119997)) {$dig = 1;}
						else{$dig = 0;}
					}else{$dig = 11 - $i;}
				}

				return ($dig == $ie[8]);
			}
		}
	}
}

// Maranhão
function CheckIEMA($ie) {
	if (strlen($ie) != 9) {return 0;}
	else{
		if (substr($ie, 0, 2) != 12) {return 0;}
		else{
			$b = 9;
			$soma = 0;
			for($i=0;$i<=7;$i++) {
				$soma += $ie[$i] * $b;
				$b--;
			}
			$i = $soma % 11;
			if ($i <= 1) {$dig = 0;}
			else{$dig = 11 - $i;}

			return ($dig == $ie[8]);
		}
	}
}

// Mato Grosso
function CheckIEMT($ie) {
	if (strlen($ie) != 11) {return 0;}
	else{
		$b = 3;
		$soma = 0;
		for($i=0;$i<=9;$i++) {
			$soma += $ie[$i] * $b;
			$b--;
			if ($b == 1) {$b = 9;}
		}
		$i = $soma % 11;
		if ($i <= 1) {$dig = 0;}
		else{$dig = 11 - $i;}

		return ($dig == $ie[10]);
	}
}

// Mato Grosso do Sul
function CheckIEMS($ie) {
	if (strlen($ie) != 9) {return 0;}
	else{
		if (substr($ie, 0, 2) != 28) {return 0;}
		else{
			$b = 9;
			$soma = 0;
			for($i=0;$i<=7;$i++) {
				$soma += $ie[$i] * $b;
				$b--;
			}
			$i = $soma % 11;
			if ($i == 0) {$dig = 0;}
			else{$dig = 11 - $i;}

			if ($dig > 9) {$dig = 0;}

			return ($dig == $ie[8]);
		}
	}
}

//Minas Gerais
function CheckIEMG($ie) {
	if (strlen($ie) != 13) {return 0;}
	else{
		$ie2 = substr($ie, 0, 3) . '0' . substr($ie, 3);

		$b = 1;
		$soma = "";
		for($i=0;$i<=11;$i++) {
			$soma .= $ie2[$i] * $b;
			$b++;
			if ($b == 3) {$b = 1;}
		}
		$s = 0;
		for($i=0;$i<strlen($soma);$i++) {
			$s += $soma[$i];
		}
		$i = substr($ie2, 9, 2);
		$dig = $i - $s;
		if ($dig != $ie[11]) {return 0;}
		else{
			$b = 3;
			$soma = 0;
			for($i=0;$i<=11;$i++) {
				$soma += $ie[$i] * $b;
				$b--;
				if ($b == 1) {$b = 11;}
			}
			$i = $soma % 11;
			if ($i < 2) {$dig = 0;}
			else{$dig = 11 - $i;}

			return ($dig == $ie[12]);
		}
	}
}

//Pará
function CheckIEPA($ie) {
	if (strlen($ie) != 9) {return 0;}
	else{
		if (substr($ie, 0, 2) != 15) {return 0;}
		else{
			$b = 9;
			$soma = 0;
			for($i=0;$i<=7;$i++) {
				$soma += $ie[$i] * $b;
				$b--;
			}
			$i = $soma % 11;
			if ($i <= 1) {$dig = 0;}
			else{$dig = 11 - $i;}

			return ($dig == $ie[8]);
		}
	}
}

//Paraíba
function CheckIEPB($ie) {
	if (strlen($ie) != 9) {return 0;}
	else{
		$b = 9;
		$soma = 0;
		for($i=0;$i<=7;$i++) {
			$soma += $ie[$i] * $b;
			$b--;
		}
		$i = $soma % 11;
		if ($i <= 1) {$dig = 0;}
		else{$dig = 11 - $i;}

		if ($dig > 9) {$dig = 0;}

		return ($dig == $ie[8]);
	}
}

//Paraná
function CheckIEPR($ie) {
	if (strlen($ie) != 10) {return 0;}
	else{
		$b = 3;
		$soma = 0;
		for($i=0;$i<=7;$i++) {
			$soma += $ie[$i] * $b;
			$b--;
			if ($b == 1) {$b = 7;}
		}
		$i = $soma % 11;
		if ($i <= 1) {$dig = 0;}
		else{$dig = 11 - $i;}

		if ( ($dig != $ie[8]) ) {return 0;}
		else{
			$b = 4;
			$soma = 0;
			for($i=0;$i<=8;$i++) {
				$soma += $ie[$i] * $b;
				$b--;
				if ($b == 1) {$b = 7;}
			}
			$i = $soma % 11;
			if ($i <= 1) {$dig = 0;}
			else{$dig = 11 - $i;}

			return ($dig == $ie[9]);
		}
	}
}

//Pernambuco
function CheckIEPE($ie) {
	if (strlen($ie) == 9) {
		$b = 8;
		$soma = 0;
		for($i=0;$i<=6;$i++) {
			$soma += $ie[$i] * $b;
			$b--;
		}
		$i = $soma % 11;
		if ($i <= 1) {$dig = 0;}
		else{$dig = 11 - $i;}

		if ( $dig != $ie[7] ) {return 0;}
		else{
			$b = 9;
			$soma = 0;
			for($i=0;$i<=7;$i++) {
				$soma += $ie[$i] * $b;
				$b--;
			}
			$i = $soma % 11;
			if ($i <= 1) {$dig = 0;}
			else{$dig = 11 - $i;}

			return ($dig == $ie[8]);
		}
	}
	elseif (strlen($ie) == 14) {
		$b = 5;
		$soma = 0;
		for($i=0;$i<=12;$i++) {
			$soma += $ie[$i] * $b;
			$b--;
			if ($b == 0) {$b = 9;}
		}
		$dig = 11 - ($soma % 11);
		if ($dig > 9) {$dig = $dig - 10;}

		return ($dig == $ie[13]);
	}
	else{return 0;}
}

//Piauí
function CheckIEPI($ie) {
	if (strlen($ie) != 9) {return 0;}
	else{
		$b = 9;
		$soma = 0;
		for($i=0;$i<=7;$i++) {
			$soma += $ie[$i] * $b;
			$b--;
		}
		$i = $soma % 11;
		if ($i <= 1) {$dig = 0;}
		else{$dig = 11 - $i;}
		if ($dig >= 10) {$dig = 0;}

		return ($dig == $ie[8]);
	}
}

// Rio de Janeiro
function CheckIERJ($ie) {
	if (strlen($ie) != 8) {return 0;}
	else{
		$b = 2;
		$soma = 0;
		for($i=0;$i<=6;$i++) {
			$soma += $ie[$i] * $b;
			$b--;
			if ($b == 1) {$b = 7;}
		}
		$i = $soma % 11;
		if ($i <= 1) {$dig = 0;}
		else{$dig = 11 - $i;}

		return ($dig == $ie[7]);
	}
}

//Rio Grande do Norte
function CheckIERN($ie) {
	if ( !( (strlen($ie) == 9) || (strlen($ie) == 10) ) ) {return 0;}
	else{
		$b = strlen($ie);
		if ($b == 9) {$s = 7;}
		else{$s = 8;}
		$soma = 0;
		for($i=0;$i<=$s;$i++) {
			$soma += $ie[$i] * $b;
			$b--;
		}
		$soma *= 10;
		$dig = $soma % 11;
		if ($dig == 10) {$dig = 0;}

		$s += 1;
		return ($dig == $ie[$s]);
	}
}

// Rio Grande do Sul
function CheckIERS($ie) {
	if (strlen($ie) != 10) {return 0;}
	else{
		$b = 2;
		$soma = 0;
		for($i=0;$i<=8;$i++) {
			$soma += $ie[$i] * $b;
			$b--;
			if ($b == 1) {$b = 9;}
		}
		$dig = 11 - ($soma % 11);
		if ($dig >= 10) {$dig = 0;}

		return ($dig == $ie[9]);
	}
}

// Rondônia
function CheckIERO($ie) {
	if (strlen($ie) == 9) {
		$b=6;
		$soma =0;
		for($i=3;$i<=7;$i++) {
			$soma += $ie[$i] * $b;
			$b--;
		}
		$dig = 11 - ($soma % 11);
		if ($dig >= 10) {$dig = $dig - 10;}

		return ($dig == $ie[8]);
	}
	elseif (strlen($ie) == 14) {
		$b=6;
		$soma=0;
		for($i=0;$i<=12;$i++) {
			$soma += $ie[$i] * $b;
			$b--;
			if ($b == 1) {$b = 9;}
		}
		$dig = 11 - ( $soma % 11);
		if ($dig > 9) {$dig = $dig - 10;}

		return ($dig == $ie[13]);
	}
	else{return 0;}
}

//Roraima
function CheckIERR($ie) {
	if (strlen($ie) != 9) {return 0;}
	else{
		if (substr($ie, 0, 2) != 24) {return 0;}
		else{
			$b = 1;
			$soma = 0;
			for($i=0;$i<=7;$i++) {
				$soma += $ie[$i] * $b;
				$b++;
			}
			$dig = $soma % 9;

			return ($dig == $ie[8]);
		}
	}
}

//Santa Catarina
function CheckIESC($ie) {
	if (strlen($ie) != 9) {return 0;}
	else{
		$b = 9;
		$soma = 0;
		for($i=0;$i<=7;$i++) {
			$soma += $ie[$i] * $b;
			$b--;
		}
		$dig = 11 - ($soma % 11);
		if ($dig <= 1) {$dig = 0;}

		return ($dig == $ie[8]);
	}
}

//São Paulo
function CheckIESP($ie) {
	if ( strtoupper( substr($ie, 0, 1) )	== 'P' ) {
		if (strlen($ie) != 13) {return 0;}
		else{
			$b = 1;
			$soma = 0;
			for($i=1;$i<=8;$i++) {
				$soma += $ie[$i] * $b;
				$b++;
				if ($b == 2) {$b = 3;}
				if ($b == 9) {$b = 10;}
			}
			$dig = $soma % 11;
			return ($dig == $ie[9]);
		}
	}else{
		if (strlen($ie) != 12) {return 0;}
		else{
			$b = 1;
			$soma = 0;
			for($i=0;$i<=7;$i++) {
				$soma += $ie[$i] * $b;
				$b++;
				if ($b == 2) {$b = 3;}
				if ($b == 9) {$b = 10;}
			}
			$dig = $soma % 11;
			if ($dig > 9) {$dig = 0;}

			if ($dig != $ie[8]) {return 0;}
			else{
				$b = 3;
				$soma = 0;
				for($i=0;$i<=10;$i++) {
					$soma += $ie[$i] * $b;
					$b--;
					if ($b == 1) {$b = 10;}
				}
				$dig = $soma % 11;

				return ($dig == $ie[11]);
			}
		}
	}
}

//Sergipe
function CheckIESE($ie) {
	if (strlen($ie) != 9) {return 0;}
	else{
		$b = 9;
		$soma = 0;
		for($i=0;$i<=7;$i++) {
			$soma += $ie[$i] * $b;
			$b--;
		}
		$dig = 11 - ($soma % 11);
		if ($dig > 9) {$dig = 0;}

		return ($dig == $ie[8]);
	}
}

//Tocantins
function CheckIETO($ie) {
	if (strlen($ie) != 11) {return 0;}
	else{
		$s = substr($ie, 2, 2);
		if ( !( ($s=='01') || ($s=='02') || ($s=='03') || ($s=='99') ) ) {return 0;}
		else{
			$b=9;
			$soma=0;
			for($i=0;$i<=9;$i++) {
				if ( !(($i == 2) || ($i == 3)) ) {
					$soma += $ie[$i] * $b;
					$b--;
				}
			}
			$i = $soma % 11;
			if ($i < 2) {$dig = 0;}
			else{$dig = 11 - $i;}

			return ($dig == $ie[10]);
		}
	}
}

<?php
/**
 * Geração e conversão de cores
 * @package grimoire/bibliotecas
*/

/**
 * Determines if the given value is a valid CSS colour.
 *
 * A CSS colour can be one of the following:
 *	- Hex colour:	#AA66BB
 *	- RGB colour:	rgb(0-255, 0-255, 0-255)
 *	- RGBA colour: rgba(0-255, 0-255, 0-255, 0-1)
 *	- HSL colour:	hsl(0-360, 0-100%, 0-100%)
 *	- HSLA colour: hsla(0-360, 0-100%, 0-100%, 0-1)
 *
 * Or a recognised browser colour mapping {@link css_optimiser::$htmlcolours}
 *
 * @param string $value The colour value to check
 * @return bool
 */
function css_is_colour($value) {
	$value = trim($value);

	$hex	= '/^#([a-fA-F0-9]{1,3}|[a-fA-F0-9]{6})$/';
	$rgb	= '#^rgb\s*\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*\)$#i';
	$rgba = '#^rgba\s*\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1}(\.\d+)?)\s*\)$#i';
	$hsl	= '#^hsl\s*\(\s*(\d{1,3})\s*,\s*(\d{1,3})\%\s*,\s*(\d{1,3})\%\s*\)$#i';
	$hsla = '#^hsla\s*\(\s*(\d{1,3})\s*,\s*(\d{1,3})\%\s*,\s*(\d{1,3})\%\s*,\s*(\d{1}(\.\d+)?)\s*\)$#i';

	if (in_array(strtolower($value), array('inherit'))) {
		return true;
	} else if (preg_match($hex, $value)) {
		return true;
	// } else if (in_array(strtolower($value), array_keys(css_optimiser::$htmlcolours))) {
		// return true;
	} else if (preg_match($rgb, $value, $m) && $m[1] < 256 && $m[2] < 256 && $m[3] < 256) {
		// It is an RGB colour.
		return true;
	} else if (preg_match($rgba, $value, $m) && $m[1] < 256 && $m[2] < 256 && $m[3] < 256) {
		// It is an RGBA colour.
		return true;
	} else if (preg_match($hsl, $value, $m) && $m[1] <= 360 && $m[2] <= 100 && $m[3] <= 100) {
		// It is an HSL colour.
		return true;
	} else if (preg_match($hsla, $value, $m) && $m[1] <= 360 && $m[2] <= 100 && $m[3] <= 100) {
		// It is an HSLA colour.
		return true;
	}
	// Doesn't look like a colour.
	return false;
}

/**
 * Cria uma array de cores web safe
 * @package grimoire/bibliotecas/cores.php
 * @version 05-07-2015
 *
 * @return	array
 */
function gwsc() {
	$cs = array('00', '33', '66', '99', 'CC', 'FF');
	$c = array();
	for($i=0; $i<6; $i++) {
		for($j=0; $j<6; $j++) {
			for($k=0; $k<6; $k++) {
				$c[] = $cs[$i] .$cs[$j] .$cs[$k];
			}
		}
	}
	return $c;
}

/**
 * Converte uma cor hexadecimal para RGB
 * @package grimoire/bibliotecas/cores.php
 * @version 05-07-2015
 *
 * @param	string
 * @return	string
 */
function HexToRGB($hex) {
	$color = array();
	if ( strlen($hex) == 3 ) {
		// $color['r'] = hexdec(substr($hex, 0, 1) . $r);
		// $color['g'] = hexdec(substr($hex, 1, 1) . $g);
		// $color['b'] = hexdec(substr($hex, 2, 1) . $b);
	} if ( strlen($hex) == 6) {
		$color['r'] = hexdec(substr($hex, 0, 2));
		$color['g'] = hexdec(substr($hex, 2, 2));
		$color['b'] = hexdec(substr($hex, 4, 2));
	}
	return $color;
}

/**
 * Converte uma cor RGB para hexadecimal
 * @package grimoire/bibliotecas/cores.php
 * @version 05-07-2015
 *
 * @param	string
 * @param	string
 * @param	string
 * @return	string
 */
function RGBToHex($r, $g, $b) {
	$hex = "#";
	$hex.= str_pad(dechex($r), 2, "0", STR_PAD_LEFT);
	$hex.= str_pad(dechex($g), 2, "0", STR_PAD_LEFT);
	$hex.= str_pad(dechex($b), 2, "0", STR_PAD_LEFT);
	return $hex;
}

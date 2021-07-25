<?php
	// Conserves session language
	if ( array_key_exists('selectedLanguage', $_SESSION) ) {

		// priorize parameter language
		if ( !empty($_GET['idioma']) ) {
			$_SESSION['selectedLanguage'] = $_GET['idioma'];
		}

	} else {
		$_SESSION['selectedLanguage'] = 'en-US';
	}

	// Default in case of null
	if ( empty($_SESSION['selectedLanguage']) ) {
		$_SESSION['selectedLanguage'] = 'en-US';
	}

	$idioma = '';
	switch ( $_SESSION['selectedLanguage']) {
		case 'AR':	$idioma = 'arabe';
			break;
		case 'DE':	$idioma = 'alemao';
			break;
		case 'en-US': $idioma = 'ingles';
			break;
		case 'ES':	$idioma = 'espanhol';
			break;
		case 'FR':	$idioma = 'frances';
			break;
		case 'JP':	$idioma = 'japones';
			break;
		case 'pt-BR': $idioma = 'portugues';
			break;
		case 'RU':	$idioma = 'russo';
			break;
	}
?>

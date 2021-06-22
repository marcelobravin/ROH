<?php
class Security {

	// 50 milliseconds
	function verifyHashCost($timeTargetInMiliseconds=0.05) {

		$cost = 8;
		do {
			$cost++;
			$start = microtime(true);
			password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
			$end = microtime(true);
		} while (($end - $start) < $timeTargetInMiliseconds);

		return "Appropriate Cost Found: " . $cost;
	}

	function criptografar ($senha) {
		$options = ['cost' => 12];
		// return password_hash($senha, PASSWORD_BCRYPT, $options);
		return password_hash($senha, PASSWORD_DEFAULT, $options);
	}

	/*
	function hashPassword ($password, $timeCost=10) {
		$options = array(
			'time_cost'		=> $timeCost
			, 'memory_cost'	=> '2048k'
			, 'threads'		=> 6
		);

		//* https://stackoverflow.com/questions/56497578/php-warning-use-of-undefined-constant-password-argon2id-when-using-password-has *
		if( defined('PASSWORD_ARGON2ID') ) {
			$hash = password_hash($password, PASSWORD_ARGON2ID, $options);
		} else {
			$hash = password_hash($password, PASSWORD_DEFAULT , $options);
			// $hash = password_hash($password, PASSWORD_DEFAULT);
		}

		return $hash;
	}
	*/

}

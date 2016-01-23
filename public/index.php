<?php
$pathClass = dirname(__dir__);
$pathUsers = '/users';
$_USER = get_config_user($_GET['token'],$pathClass.$pathUsers);

require_once $pathClass.'/app/framework/'.$_USER['versionApp'].'/quantum.php';
use Atento\Quantum\app as Quantum;

	$QuantumObj = new Quantum\Quantum();
	$QuantumObj->get_theme($_USER['theme']);

	function get_config_user($token,$path){
		$fileJson = file_get_contents($path.'/'.$token.'/config.json');
		return json_decode($fileJson,true);
	}
?>
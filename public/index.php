<?php
$pathClass = dirname(__dir__);
$pathUsers = '/users';

require_once $pathClass.'/app/framework/'.$_GET['version'].'/quantum.php';
use Atento\Quantum\app as Quantum;
$QuantumObj = new Quantum\Quantum();

if(!isset($_GET['token'])){
	$QuantumObj->error_app('token',__line__);
	include '../app/alerts/error_404.php';
	exit();
}



switch ($_GET['src']) {
	case 'chat':
		# code...
		//$_USER = get_config_user($_GET['token'],$pathClass.$pathUsers);
		$_USER = $QuantumObj->getContructApp('client',$_GET['token']);
		$QuantumObj->get_theme($_USER['app'][0]['theme']);
	break;
	case 'agent':
		
	break;
	default:
		# code...
		break;
}

	
	

	function get_config_user($token,$path){
		$fileJson = file_get_contents($path.'/'.$token.'/config.json');
		return json_decode($fileJson,true);
	}
?>
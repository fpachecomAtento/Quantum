<?php		
	use Atento\Quantum\app as Quantum;
	$QuantumObjTheme = new Quantum\Quantum();

	$pathClass = dirname(dirname(dirname(__dir__)));
	$pathUsers = '/users';
	$_USERTheme = get_config_user($_GET['token'],$pathClass.$pathUsers);
?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $_USERTheme['title']; ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?= 
		$QuantumObjTheme->get_url_server()
			.$QuantumObjTheme->configDefault['pathPrimary']
			.$QuantumObjTheme->configDefault['pathTheme']
			.'/'.$_USERTheme['theme'];
	?>/uikit/css/uikit.css">
	<link rel="stylesheet" type="text/css" href="<?= 
		$QuantumObjTheme->get_url_server()
			.$QuantumObjTheme->configDefault['pathPrimary']
			.$QuantumObjTheme->configDefault['pathTheme']
			.'/'.$_USERTheme['theme'];
	?>/style.css">
	<script type="text/javascript" src="<?= 
		$QuantumObjTheme->get_url_server()
			.$QuantumObjTheme->configDefault['pathPrimary']
			.$QuantumObjTheme->configDefault['pathjQuery']
			.'/2.2.0.js';
	?>"></script>
	<script type="text/javascript" src="<?= 
		$QuantumObjTheme->get_url_server()
			.$QuantumObjTheme->configDefault['pathPrimary']
			.$QuantumObjTheme->configDefault['pathJsFramework']
			.'/'.$_USERTheme['versionApp']
			.'/quantum.js';
	?>"></script>
	<script type="text/javascript" src="<?= 
		$QuantumObjTheme->get_url_server()
			.$QuantumObjTheme->configDefault['pathPrimary']
			.$QuantumObjTheme->configDefault['pathTheme']
			.'/'.$_USERTheme['theme'];
		?>/script.js
	"></script>
</head>
<body>
	<div class="uk-navbar">
		<div class="uk-navbar-content uk-navbar-center">
			
		</div>
	</div>
	<div data-role="step_welcome">
		<div class="uk-text-center ip-logo-welcome"><?= $QuantumObjTheme->get_logo($_USERTheme['logo']); ?></div>
		<div class="uk-text-center ip-title-primary"><?= $_USERTheme['title']; ?></div>
		<div class="uk-text-center ip-title-principal ip-template" >
			<?= $_USERTheme['messages']['welcome']; ?>
		</div>
		<div class="uk-text-center ip-list-queues">
			<?php
				echo $QuantumObjTheme->get_queues($_USERTheme['queues'],'uk-nav');
			?>
		</div>
	</div>
	<div data-role="step_crm">
		<?= ($QuantumObjTheme->paintForm($_USERTheme['crm'])); ?>
	</div>
	<div data-role="step_wait">
		<div class="uk-text-center ip-logo-welcome"><?= $QuantumObjTheme->get_logo($_USERTheme['logo']); ?></div>
		<?php 
			if(isset($_GET['queue'])){
				include 'action.php';
				$titleService = $IP->getServiceClient($_GET['queue'],$_USERTheme['queues']);
				if($titleService){

					?>
						<div class="uk-text-center ip-title-primary"><?= $titleService ?></div>
					<?php
				}
			}
			else{
				?>
					<div class="uk-text-center ip-title-primary" data-role="titleService">[[!Title Service]]</div>
				<?php
			}
		?>

		<div class="uk-text-center ip-title-principal ip-template">
			<?= $_USERTheme['messages']['wait']; ?>
		</div>
	</div>

	<div data-role="step_chat">
		<div>
			
		</div>
		<div data-role="boxChat">
			<?= $QuantumObjTheme->getMessageBox(array(
				'class' => 'uk-width-1-1'
			)); ?>
		</div>
	</div>
</body>
</html>
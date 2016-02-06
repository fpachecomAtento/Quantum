<?php		
	use Atento\Quantum\app as Quantum;
	$QuantumObjTheme = new Quantum\Quantum();

	$pathClass = dirname(dirname(dirname(__dir__)));
	$pathUsers = '/users';
	//$_USERTheme = get_config_user($_GET['token'],$pathClass.$pathUsers);
	$_USERTheme = $QuantumObjTheme->getContructApp('client',$_GET['token']);
?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $_USERTheme['app'][0]['title']; ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?= 
		$QuantumObjTheme->get_url_server()
			.$QuantumObjTheme->configDefault['pathPrimary']
			.$QuantumObjTheme->configDefault['pathTheme']
			.'/'.$_USERTheme['app'][0]['theme'];
	?>/uikit/css/uikit.css">
	<link rel="stylesheet" type="text/css" href="<?= 
		$QuantumObjTheme->get_url_server()
			.$QuantumObjTheme->configDefault['pathPrimary']
			.$QuantumObjTheme->configDefault['pathTheme']
			.'/'.$_USERTheme['app'][0]['theme'];
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
			.$QuantumObjTheme->configDefault['pathAppClient']
			.'/'.$_USERTheme['app'][0]['versionApp']
			.'/quantum.js';
	?>"></script>
	<script type="text/javascript" src="<?= 
		$QuantumObjTheme->get_url_server()
			.$QuantumObjTheme->configDefault['pathPrimary']
			.$QuantumObjTheme->configDefault['pathTheme']
			.'/'.$_USERTheme['app'][0]['theme'];
		?>/script.js
	"></script>
</head>
<body>
	<div data-role="step_welcome">
		
		<div class="uk-text-center ip-title-primary"><?= $_USERTheme['app'][0]['title']; ?></div>
		<div class="uk-text-center ip-title-principal ip-template" >
			<?= $_USERTheme['app'][0]['messages']['welcome']; ?>
		</div>
		<div class="uk-text-center ip-logo-welcome"><?= $QuantumObjTheme->get_logo($_USERTheme['app'][0]['logo']); ?></div>
		<div class="ip-list-queues">
			<?php
				echo $QuantumObjTheme->get_queues($_USERTheme['queues'],'ip-nav',array(
						'caption' => true,
						'icon' => true
					));
			?>
		</div>
	</div>
	<div data-role="step_crm">
		<?= ($QuantumObjTheme->paintForm($_USERTheme['crm'])); ?>
	</div>
	<div data-role="step_wait">
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
		<div class="uk-text-center ip-logo-welcome" style="margin-top:70px"><?= $QuantumObjTheme->get_logo($_USERTheme['app'][0]['logo']); ?></div>
		<div class="uk-text-center ip-title-principal" style="padding: 150px 30px 0px 30px;color:#333">
			<?= $_USERTheme['app'][0]['messages']['wait']; ?>
		</div>
	</div>

	<div data-role="step_chat">
		<div class="uk-navbar" data-role="navBar">
			<ul class="uk-navbar-nav">
				 <li class="uk-active"><a href=""><i class="uk-icon-chevron-left"></i></a></li>
			</ul>
			<div class="uk-navbar-content uk-navbar-center">
				<b>Atento :</b>
			</div>
		</div>
		<div data-role="messageBody">
			<ul>
				<li class="ip-popover-in">
					<div>
						<div class="ip-popover-in-body">Ultricies dignissim turpis phasellus! Vel cursus ac mattis ut et, aliquam risus eros sed porta. Ultrices. Cursus lectus nec amet urna, ut nunc! Sed magnis tincidunt mid rhoncus?</div>
						<div class="ip-popover-in-time">06:10 pm</div>
					</div>
				</li>
				<li class="ip-popover-out">
					<div>
						<div class="ip-popover-in-body">Urna mid proin tortor ac vel augue magna, augue ultricies, montes est porttitor dolor. Dignissim mattis velit integer. Turpis habitasse.</div>
						<div class="ip-popover-in-time">06:12 pm</div>
					</div>
				</li>
			</ul>
		</div>
		<div data-role="boxChat" class="ip-message-box">
			<div class="uk-grid uk-grid-small">
				<div class="uk-width-9-10"><?= $QuantumObjTheme->getMessageBox(array('class' => 'uk-width-1-1')); ?></div>
				<div class="uk-width-1-10">
						<button><i class="uk-icon-paper-plane-o"></i></button>
				</div>
			</div>
			
		</div>
	</div>
</body>
</html>
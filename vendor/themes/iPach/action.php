<?php
	namespace Atento\Quantum\iPachTheme;
	use Atento\Quantum\app as Quantum;
	$QuantumObjTheme = new Quantum\Quantum();


	$IP = new iPachTheme();

	class iPachTheme {
		public function getServiceClient($queue, $arrayService){			
			foreach ($arrayService as $key => $value) {

				if($value['_id'] == $queue)
					return $value['name'];
			}

			return false;
		}
	}
?>
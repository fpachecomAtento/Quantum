<?php
	namespace Atento\Quantum\iPachTheme;

	$IP = new iPachTheme();

	class iPachTheme {
		public function getServiceClient($queue, $arrayService){
			foreach ($arrayService as $key => $value) {
				if($value['id'] == $queue)
					return $value['name'];
			}

			return false;
		}
	}
?>
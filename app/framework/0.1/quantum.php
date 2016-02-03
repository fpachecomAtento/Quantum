<?php
	namespace Atento\Quantum\app;

	$a = new Quantum();
	$a->get_settings();

	class Quantum{
		var $propertiesApp;

		protected $configDefault = array(
				'pathPrimary' => '/Quantum',
				'pathConfig' => '/config',
				'pathTheme' => '/vendor/themes',
				'pathjQuery' => '/vendor/jquery',
				'pathJsFramework' => '/app/framework',
				'pathAppClient' => '/app/client'
			);
		protected $errorMessage = array(
				'get_settings' => 'No se encontro el archivo de configuraciones'
			);

		public function get_settings(){
		 	$pathFileConfig = $this->get_path_app().$this->configDefault['pathConfig'].'/conf.ini';
			$fileConfig = file_exists($pathFileConfig);

			if($fileConfig)
				return parse_ini_file($pathFileConfig,true);
			else{
				$this->error_app(__FUNCTION__, __line__);
				exit();
			}
		}

		public function get_theme($theme = 'iPach'){
			include $this->get_path_app().$this->configDefault['pathTheme'].'/'.$theme.'/index.php';
		}

		public function get_queues($queues,$class = false, $properties){
			$listQueues = '<ul '.(($class) ? 'class="'.$class.'"' : '').'>';
			foreach ($queues as $key => $value) {
				$listQueues .= '<li><a href="#" id="q_'.$value['id'].'" data-role="q_queue" class="ip-primary-text-color">'.(($properties['icon']) ? '<i class="'.$value['icon'].'"></i>' : '').$value['name'].'</a>'.(($properties['caption'])? '<label>'.$value['caption'].'</label>' : '').'</li>';
			}
			$listQueues .= '</ul>';

			return $listQueues;
		}

		public function get_logo($logo){
			switch ($logo['type']) {
				case 'icon':
					# code...
					return '<i class="'.$logo['src'].'"></i>';
				break;
				default:
					# code...
					break;
			}
		}

		public function getMessageBox($properties){
<<<<<<< HEAD
			return '<textarea rows="3" '.((isset($properties['class']) ? 'class="'.$properties['class'].'"' : ''))
					.' placeholder="Escribenos un mensaje"></textarea>';
=======
			return '<textarea '.((isset($properties['class']) ? 'class="'.$properties['class'].'"' : ''))
					.'></textarea>';
>>>>>>> refs/remotes/origin/master
		}

		public function paintForm($_FORM,$withForm = true){
			$t='';
			foreach ($_FORM['fields'] as $key => $value) {
				switch ($value['type']) {
					case 'text':
						$t .= '<div class="uk-form-row">';
							$t .= '<label class="uk-form-label">'.$value['label'].'</label>';
							$t .= '<div class="uk-form-controls">';
								$t .= '<input type="text" name="'.$value['name'].'" placeholder="'.((!isset($value['placeholder'])) ? '' : $value['placeholder']).'" class="uk-width-1-1" data-require="'.$value['require'].'" data-min="'.$value['length']['min'].'" data-max="'.$value['length']['max'].'" autocomplete="off">';
							$t .= '</div>';
						$t .= '</div>';

					break;
					case 'number':
						$t .= '<div class="uk-form-row">';
							$t .= '<label class="uk-form-label">'.$value['label'].'</label>';
							$t .= '<div class="uk-form-controls">';
								$t .= '<input type="text" name="'.$value['name'].'" placeholder="'.((!isset($value['placeholder'])) ? '' : $value['placeholder']).'" class="" data-require="'.$value['require'].'" data-min="'.$value['length']['min'].'" data-max="'.$value['length']['max'].'" autocomplete="off">';
							$t .= '</div>';
						$t .= '</div>';
					break;
					case 'textArea':
						$t .= '<div class="uk-form-row">';
<<<<<<< HEAD
							$t .= '<label class="uk-form-label">'.$value['label'].'</label>';
=======
							$t .= '<label class="uk-form-label" style="color:#646464">'.$value['label'].'</label>';
>>>>>>> refs/remotes/origin/master
							$t .= '<div class="uk-form-controls">';
								$t .= '<textarea type="text" name="'.$value['name'].'" class="uk-width-1-1" data-require="'.$value['require'].'" data-min="'.$value['length']['min'].'" data-max="'.$value['length']['max'].'" autocomplete="off"></textarea>';
							$t .= '</div>';
						$t .= '</div>';

					break;
					case 'combo':
						$t .= '<div class="uk-form-row">';
							$t .= '<label class="uk-form-label" for="">'.$value['label'].'</label>';
							$t .= '<div class="uk-form-controls">';
								$t .= '<select name="'.$value['name'].'">';
								foreach ($value['items'] as $key => $content) {
									$t .= '<option value="'.$content['value'].'">'.$content['label'].'</option>';
								}
								$t .= '</select>';
							$t .= '</div>';
						$t .= '</div>';
					break;
					case 'hidden':
						$t .= '<input type="hidden" name="'.$value['name'].'" value="'.$value['value'].'">';
					break;
					default:
					break;
				}
			}

			if(isset($_FORM['buttons'])){
				$t .= '<div class="uk-form-row">';
				foreach ($_FORM['buttons'] as $key => $value) {
						$t .= '<button class="'.$value['class'].'" onClick=\''.$value['action'].'\'>'.$value['label'].'</button> ';
				}
				$t .= '</div>';
			}
			

		return ($withForm) ? '<form '.(($_FORM['autosumbit']) ? 'data-submit="true"' : 'data-submit="false"')
				.' class="uk-form uk-form-horizontal" id="'.$_FORM['id']
				.'" action="'.$_FORM['action'].'" method="'.$_FORM['method']
				.'" data-callback="'.$_FORM['callBack'].'"><fieldset data-uk-margin><div class="uk-text-center" data-role="frm-title">'
				.$_FORM['title'].'</div><div style="margin:15px;">'.$t.'</div></fieldset></form>' : $t;
		}

		public function get_url_server(){
			$https = !empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') === 0 ||
				!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
				strcasecmp($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') === 0;
			return
				($https ? 'https://' : 'http://').
				(!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : '').
				(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'].
				($https && $_SERVER['SERVER_PORT'] === 443 ||
				$_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT'])));
		}

		protected function error_app($function, $line, $print = true){
			if($print)
				echo "Error $function $line: ".$this->errorMessage[$function];
			else
				return "Error $function $line: ".$this->errorMessage[$function];
		}
		protected function get_path_app(){return dirname(dirname(dirname(__DIR__)));}
	}
?>
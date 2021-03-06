<?php
namespace Opencart\Application\Controller\Startup;
class Extension extends \Opencart\System\Engine\Controller {
	public function index() {

		// Add extension paths from the DB
		$this->load->model('setting/extension');

		// Default template directory
		//$this->template->addPath(DIR_TEMPLATE);

		// Default language directory
		//$this->language->addPath(DIR_LANGUAGE);

		$results = $this->model_setting_extension->getExtensions();

		foreach ($results as $result) {
			$extension = str_replace(['_', '/'], ['', '\\'], ucwords($result['extension'], '_/'));

			// Register controllers, models and system extension folders
			$this->autoloader->register('Opencart\Application\Controller\Extension\\' . $extension, DIR_EXTENSION . $result['extension'] . '/catalog/controller/');
			$this->autoloader->register('Opencart\Application\Model\Extension\\' . $extension, DIR_EXTENSION . $result['extension'] . '/catalog/model/');
			$this->autoloader->register('Opencart\System\Extension\\' . $extension, DIR_EXTENSION . $result['extension'] . '/system/');

			// Extension template directory
			//$this->template->addPath('extension/' . $result['extension'], DIR_EXTENSION . $result['extension'] . '/catalog/view/template/');

			// Extension language directory
			//$this->language->addPath('extension/' . $result['extension'], DIR_EXTENSION . $result['extension'] . '/catalog/language/');
		}
	}
}
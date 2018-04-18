<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function __construct() {
        parent::__construct(NULL, FALSE);
	}

	public function _remap($method, $params)
	{
		$this->classname = get_class($this);
		$this->methodname = $method;
		$this->classparams = $params;

		$this->initData();

		if (method_exists($this, $method)) {
			return call_user_func_array(array($this, $method), $params);
		}
		show_404();
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$layout = $this->layout->get_layout();
		$this->load->view('welcome_message', $this->data);
	}
}

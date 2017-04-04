<?php
namespace CodeExperts;

use Silex\Application;

class View
{
	private $data = [];
	private $view;
	private $app;

	public function __construct($view, Application $app = null)
	{
		$this->view = $view;
		$this->app = $app;
	}

	public function __get($value)
	{
		if(!isset($this->data[$value])) {
			return null;
		}

		return $this->data[$value];
	}

	public function __set($key, $value)
	{
		$this->data[$key] = $value;
	}	

	public function render()
	{
		ob_start();
		
		require $this->view;

		return ob_get_clean();
	}

}
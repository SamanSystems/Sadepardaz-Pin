<?php

class AppController extends Controller{
	var $view = 'Theme';
	var $theme = 'default';
	var $helpers = array('Html', 'Form', 'Javascript');
	
	function beforeRender()
	{
		$this->pageTitle = '';
	}
}
?>
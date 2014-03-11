<?php

class ControllerModuleVkComments extends Controller {
	protected function index() {
		//Load the language file for this module - catalog/language/module/vk_comments.php
		$this->language->load('module/vk_comments');
		


		//Get the title from the language file
      	$this->data['heading_title'] = $this->language->get('heading_title');
      	$this->data['footer_text'] = $this->language->get('footer_text');		

		//Load any required model files - catalog/product is a common one, or you can make your own DB access
		//methods in catalog/model/module/vk_comments.php
		$this->load->model('setting/setting');
		
		if($this->config->get('vk_comments_autopublish'))
		{
			$var_autopublish = 1;
		} 
		else
		{
			$var_autopublish = 0;			
		}
		
		$config_str['autoPublish'] = $var_autopublish;
		
		if($this->config->get('vk_comments_limit')) $config_str['limit'] = $this->config->get('vk_comments_limit');
		
		if($this->config->get('vk_comments_width')) $config_str['width'] = $this->config->get('vk_comments_width');
		
		
		
		
		$this->data['config_str'] = $config_str;
		if($this->config->get('vk_comments_widgetid')) $this->data['widgetid'] = $this->config->get('vk_comments_widgetid'); 
		if($this->config->get('vk_comments_switch')) {
			$this->data['switch'] = $this->config->get('vk_comments_switch'); 
			$this->document->addScript('http://userapi.com/js/api/openapi.js');	
		}	

		$this->data['product_id'] = $this->request->get['product_id'];	
			
		//Choose which template to display this module with
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/vk_comments.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/vk_comments.tpl';
		} else {
			$this->template = 'default/template/module/vk_comments.tpl';
		}

		//Render the page with the chosen template
		$this->render();
	}
}
?>
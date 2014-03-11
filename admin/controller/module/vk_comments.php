<?php
class ControllerModuleVkComments extends Controller {
	
	private $error = array(); 
	private $module_name = 'vk_comments';
	
	public function index() { 
	
		//Load the language file for this module
		$this->load->language('module/vk_comments');
		

		//Set the title from the language file $_['heading_title'] string
		$this->document->setTitle($this->language->get('heading_title'));
		
		//Load the settings model. You can also add any other models you want to load here.
		$this->load->model('setting/setting');
		
		
		//Save the settings if the user has submitted the admin form (ie if someone has pressed save).
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('vk_comments', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
			//подключение языковых функций
		$text_strings = array(
				'heading_title',
				'entry_widgetid',
				'text_enabled',
				'text_disabled',
				'text_content_top',
				'text_content_bottom',
				'text_column_left',
				'text_column_right',
				'entry_layout',
				'entry_limit',
				'entry_width',
				'entry_position',
				'entry_status',
				'entry_off',
				'entry_on',
				'entry_switch',
				'entry_sort_order',
				'button_save',
				'button_cancel',
				'button_add_module',
				'button_remove',
				'entry_autopublish' //this is an example extra field added
		);
		
		foreach ($text_strings as $text) {
			$this->data[$text] = $this->language->get($text);
		}
		//END LANGUAGE
		
		//The following code pulls in the required data from either config files or user
		//submitted data (when the user presses save in admin). Add any extra config data
		// you want to store.
		//
		// NOTE: These must have the same names as the form data in your vk_comments.tpl file
		//
		$config_data = array(
				'vk_comments_widgetid', //this becomes available in our view by the foreach loop just below.
				'vk_comments_limit',
				'vk_comments_width',
				'vk_comments_switch',
				'vk_comments_autopublish'
		);
		
		foreach ($config_data as $conf) {
			if (isset($this->request->post[$conf])) {
				$this->data[$conf] = $this->request->post[$conf];
			} else {
				$this->data[$conf] = $this->config->get($conf);
			}
		}

		
		//галочка автопубликации		
		if($this->data['vk_comments_autopublish'])  
		{
			$this->data['vk_comments_autopublish_checked'] = 'checked';
		}
		else{
			$this->data['vk_comments_autopublish_checked'] = NULL;
		}
		
		//Статус модуля
		$this->data['switch_status_true'] = NULL;
		$this->data['switch_status_false'] = NULL;		
		if($this->data['vk_comments_switch'])  
		{ 
			$this->data['switch_status_true'] = 'selected="selected"';
		}
		else 
		{
			$this->data['switch_status_false'] = 'selected="selected"';
		}
	
		//This creates an error message. The error['warning'] variable is set by the call to function validate() in this controller (below)
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		//SET UP BREADCRUMB TRAIL. YOU WILL NOT NEED TO MODIFY THIS UNLESS YOU CHANGE YOUR MODULE NAME.
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/vk_comments', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/vk_comments', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

	
		//This code handles the situation where you have multiple instances of this module, for different layouts.
		$this->data['modules'] = array();
		
		if (isset($this->request->post['vk_comments_module'])) {
			$this->data['modules'] = $this->request->post['vk_comments_module'];
		} elseif ($this->config->get('vk_comments_module')) { 
			$this->data['modules'] = $this->config->get('vk_comments_module');
		}		

		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		//Choose which template file will be used to display this request.
		$this->template = 'module/vk_comments.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);

		//Send the output.
		$this->response->setOutput($this->render());
	}
	
	/*
	 * 
	 * This function is called to ensure that the settings chosen by the admin user are allowed/valid.
	 * You can add checks in here of your own.
	 * 
	 */
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/vk_comments')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}


}
?>
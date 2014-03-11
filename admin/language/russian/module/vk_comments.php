<?php
################################################################################################
#  DIY Module Builder for Opencart 1.5.1.x From HostJars http://opencart.hostjars.com   	   #
################################################################################################

/*
 * This file contains the english version of any static text required by your module in the admin area.
 * If you want to translate your module to another language, the idea is that you can just replace the
 * right hand column below with the changed language, rather than modifying every file in your module.
 * 
 * We will call these language strings through in the controller to make them available in the view. 
 * 
 * For your module, think about any text that you want to display and add it in here. Also replace all the
 * "My Module" text for the name of your module.
 * 
 */

// Example field added (see related part in admin/controller/module/vk_comments.php)
$_['vk_comments_example'] = 'Example Extra Text';



// Heading Goes here:
$_['heading_title']    = 'Комментарии ВК';


// Text
$_['text_module']      = 'Модули';
$_['text_success']     = 'Success: You have modified module My Module!';
$_['text_content_top']    = 'Content Top';
$_['text_content_bottom'] = 'Content Bottom';
$_['text_column_left']    = 'Column Left';
$_['text_column_right']   = 'Column Right';

// Entry
$_['entry_widgetid']       = 'ID виджета:'; 
$_['entry_width']       = 'Ширина виджета:'; // this will be pulled through to the controller, then made available to be displayed in the view.
$_['entry_autopublish']        = 'Автоматическая публикация на стене:';
$_['entry_limit']        = 'Лимит сообщений:';
$_['entry_layout']        = 'Страница:';
$_['entry_position']      = 'Позиция:';
$_['entry_status']        = 'Статус:';
$_['entry_sort_order']    = 'Порядок сортировки:';
$_['entry_on']			= 'Включён';
$_['entry_off']			= 'Выключен';
$_['entry_switch']			= 'Статус модуля';
// Error
$_['error_permission'] = 'Warning: You do not have permission to modify module My Module!';
?>
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('heading')) {
		function unreadReports() {
			$CI =& get_instance();
			$CI->load->model('paste_model');
			return $CI->paste_model->getUnreadReports();
		}
}
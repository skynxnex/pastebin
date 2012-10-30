<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

if (!function_exists('heading')) {
  function flow() {
    $CI = &get_instance();
    $CI->load->model('paste_model');
    return $CI->doctrine->em->getRepository('Entities\Snippet')->findBy(array('visibility' => 1), array('date' => 'DESC'), 10);
  }

}

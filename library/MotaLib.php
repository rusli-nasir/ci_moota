<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 09/05/2018
 * Time: 19:26
 * Project: moota
 */

require_once APPPATH .'third_party/MootaRest/MotaRest.php';

class MotaLib extends MotaRest
{

    /**
     * @var CI_Controller
     */
    private $_ci;

    private $api_key;

    public function __construct()
    {
        if (!function_exists('curl_init')) {
            log_message('error', 'cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.');
        }

        $this->_ci = & get_instance();
        $this->_ci->load->config('motaconfig', TRUE);

        if ($this->_ci->config->item('mota_api_key', 'motaconfig') == "") {
            log_message("error", "Harap masukkan API KEY Anda di config.");
        } else {
            $this->api_key = $this->_ci->config->item('mota_api_key', 'motaconfig');
        }
        parent::__construct($this->api_key);
    }

}
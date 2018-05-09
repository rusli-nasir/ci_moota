<?php

/**
 *
 */
require_once 'restclient.php';

class MotaRest {

    /**
     * @var $loader RESTClient
     */
    private $loader;

    public function __construct($apiKey) {

        $this->loader = new RESTClient($apiKey);
    }

    /**
     * Public function profile() For
     **/
    public function profile()
    {
        return $this->loader->get('profile');
    }

    /**
     * Public function balance() For
     **/
    public function balance()
    {
        return $this->loader->get('balance');
    }


    /**
     * @param null $bankID for bank akun detail
     * @return string
     */
    public function akun_bank($bankID = null)
    {
        if($bankID){
            return $this->loader->get("bank/{$bankID}");
        }else{
            return $this->loader->get('bank');
        }
    }


    /**
     * @param null $bankID
     * @param string $mode mode can be current_month or last or amount description
     * @param int $page_limit maximum 20
     * @param null $search search for amount or description mode
     * @return string
     */
    public function mutasi($bankID, $mode = 'current_month', $page_limit = 10, $search = null)
    {
        $params = '';
        switch ($mode){
            case 'current_month':
                $params = "{$bankID}/mutation/";
                break;
            case 'last':
                $params = "{$bankID}/mutation/recent/{$page_limit}";
                break;
            case 'amount':
                $amount = is_numeric($search)? $search:0;
                $params = "{$bankID}/mutation/search/{$amount}";
                break;
            case 'description':
                $desk = ($search) ? urlencode($search):null;
                $params = "{$bankID}/mutation/search/description/{$desk}";
                break;
        }

        return $this->loader->get('bank/' . $params);
    }



}

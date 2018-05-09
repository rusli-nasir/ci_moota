<?php

/**
 * REST Client
 *
 *
 */
class RESTClient {

    /**
     * @var string //data can profile,balance,bank,
     */
    private $endpoint;
    private $api_key;
    private $api_url;

    public function __construct($api_key) {
        $this->api_key = $api_key;
        $this->api_url = "https://app.moota.co/api/v1/";
    }

//    /**
//     * HTTP POST method
//     *
//     * @param array Parameter yang dikirimkan
//     * @return string Response dari cURL
//     */
//    function post($params) {
//        $curl = curl_init();
//        $header[] = "Content-Type: application/x-www-form-urlencoded";
//        $header[] = "key: $this->api_key";
//        $query = http_build_query($params);
//        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
//        curl_setopt($curl, CURLOPT_URL, $this->api_url . "" . $this->account_type . "/" . $this->endpoint);
//        curl_setopt($curl, CURLOPT_POST, TRUE);
//        curl_setopt($curl, CURLOPT_POSTFIELDS, $query);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
//        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
//        $request = curl_exec($curl);
//        $return = ($request === FALSE) ? curl_error($curl) : $request;
//        curl_close($curl);
//        return $return;
//    }

    /**
     * HTTP GET method
     * 
     * @param array Parameter yang dikirimkan
     * @return string Response dari cURL
     */
    function get($params) {
        $curl = curl_init();
        $header[] = "'Accept: application/json'";
        $header[] = "Authorization: Bearer {$this->api_key}";
        if(is_array($params)){
            $query = implode('/',$params);
        }else{
            $query = $params;
        }

        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_URL, $this->api_url . $query);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        $request = curl_exec($curl);
        $return = ($request === FALSE) ? curl_error($curl) : $request;
        curl_close($curl);
        return $return;
    }

}

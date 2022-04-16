<?php

class client
{
    public function __construct()
    {
        $params = array('location' => 'http://localhost/soap/server.php',
                        'uri' => 'urn://wamp64/www/soap/server.php',
                        'trace' => 1);
        $this->instance = new SoapClient(NULL , $params);

        //set the header

        $auth_params = new stdClass();
        $auth_params->username = 'redouane';
        $auth_params->password = 'root';

        $header_params = new SoapVar($auth_params, SOAP_ENC_OBJECT);
        $header = new SoapHeader('codev', 'authenticate' , $header_params, false);

        $this->instance->__setSoapHeaders(array($header));


    }
    public function getName($id_array)
    {
        return $this->instance->__soapCall('getIntervenantName', $id_array);
    }


}


$client = new client;
?>
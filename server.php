<?php


class server
{

    private $con;

    public static function authenticate($header_params){
        if($header_params->username == 'redouane' && $header_params->password =='root') return true;
        else throw new SOAPFault('wrong user/pass ' , 401);
    }
    public function __construct()
    {
        $this->con = (is_null($this->con)) ? self::connect(): $this->con;
    }

    static function connect()
    {
        $con = mysqli_connect('localhost', 'root' ,'');
        $db = mysqli_select_db('soap', $con);
        

        return $con;
    }
    public function getIntervenantName($id_array)
    {
        $id= $id_array['id'];
        $sql = "SELECT name FROM intervenant WHERE id = '$id' ";
        $qry = mysqli_query($sql, $this->con);
        $res = mysqli_fetch_array($qry);
        return $res['name'];
    } 
}

$params = array('uri' => 'wamp64/www/soap/server.php');
$server = new SoapServer(NULL, $params);
$server->setClass('server');

$server->handle();

?>
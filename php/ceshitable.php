


<?php
header("content-type:text/html;charset=utf8");
date_default_timezone_set('Asia/Shanghai');
//Mysql数据库连接
class Mysql{
    public $db_host;
    public $db_user;
    public $db_pass;
    public $db_charset;
    public $db_name;
	public $connect;
    public function __construct($db_host,$db_user,$db_pass,$db_charset,$db_name){
        $this->db_host=$db_host;
        $this->db_user=$db_user;
        $this->db_pass=$db_pass;
        $this->db_charset=$db_charset;
        $this->db_name=$db_name;
        $this->connect();
    }
    public function connect(){
        $this->connect = @mysqli_connect($this->db_host,$this->db_user,$this->db_pass);
        mysqli_set_charset($this->connect,$this->db_charset);
        mysqli_select_db($this->connect,$this->db_name);
    }
    public function getAll($sql){
        $res =mysqli_query($this->connect,$sql);
		
        $rows=[];
        while(!is_bool($res)&&$row=mysqli_fetch_assoc($res)){
            $rows[]=$row;
        }
        return $rows;
    }
    public function __destruct(){
        mysqli_close($this->connect);
    }
}
$mysql=new Mysql('127.0.0.1','root','123','utf8','1');



$search_arr = explode(':', "94:65:2d:44:55:66");
					$search_str = $search_arr[0] . ':' . $search_arr[1] . ':' . $search_arr[2];
					
					
					
					var_dump($search_str);

$sql = "select * from macofbrand where mac_short = '{$search_str}'";


var_dump($sql);



$result = $mysql->getAll($sql);
var_dump($result);
$result = isset($result[0])?$result[0]:[];
var_dump($result);					
					
					if($result && $result['brand']){
						
						
						
						$brand = $result['brand'];
						
						
					}else{
						$brand = "Unkonwn";
					}
					echo $brand;




?>
	
	
	
	
	
	







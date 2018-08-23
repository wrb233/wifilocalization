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

    public function __construct($db_host,$db_user,$db_pass,$db_charset,$db_name){
        $this->db_host=$db_host;
        $this->db_user=$db_user;
        $this->db_pass=$db_pass;
        $this->db_charset=$db_charset;
        $this->db_name=$db_name;
        $this->connect();
    }

    public function connect(){
        @mysql_connect($this->db_host,$this->db_user,$this->db_pass);
        mysql_set_charset($this->db_charset);
        mysql_select_db($this->db_name);
    }

    public function getAll($sql){
        $res =mysql_query($sql);
		
        $rows=[];
        while(!is_bool($res)&&$row=mysql_fetch_assoc($res)){
            $rows[]=$row;
        }
        return $rows;
    }

    public function __destruct(){
        mysql_close();
    }

}




$mysql=new Mysql('127.0.0.1','root','123','utf8','1');
// 获取当天的 0 点
$start_timestamp = strtotime(date('Y-m-d',time()).'00:00:00');
$end_timestamp = strtotime(date('Y-m-d',time()).'23:59:59');
// 时间间隔
$n = 180; //三分钟
$my_result = array();
$defaultDate = [];
$fakeDate = [];
while (true){
    $left_time = date('Y-m-d H:i:s',$start_timestamp);
    $right_time = date('Y-m-d H:i:s',$start_timestamp+$n); //加三分钟
    $sql = 
	
	"(select distinct mac from 00f92b8c_detail where tc in ('Y' , 'N') and time between '{$left_time}' and '{$right_time}') UNION (select distinct mac from 00f92b8c_detail where ds='Y' and time between '{$left_time}' and '{$right_time}') UNION (select distinct mac from 00f92b8d_detail where tc in ('Y' , 'N') and time between '{$left_time}' and '{$right_time}') UNION (select distinct mac from 00f92b8d_detail where ds='Y' and time between '{$left_time}' and '2018-08-23 18:59') UNION (select distinct mac from 00f92b8e_detail where tc in ('Y' , 'N') and time between '{$left_time}' and '{$right_time}') UNION (select distinct mac from 00f92b8e_detail where ds='Y' and time between '{$left_time}' and '{$right_time}') UNION (select distinct mac from 00f92b8f_detail where tc in ('Y' , 'N') and time between '{$left_time}' and '{$right_time}') UNION (select distinct mac from 00f92b8f_detail where ds='Y' and time between '{$left_time}' and '{$right_time}')";

	
	/*便于人理解的sql语句
	"
		(select distinct mac from 00f92b8c_detail where tc in ('Y' , 'N') and time between '{$left_time}' and '{$right_time}')
        UNION
        (select distinct mac from 00f92b8c_detail where ds='Y' and time between '{$left_time}' and '{$right_time}') 
		
		UNION
		
		(select distinct mac from 00f92b8d_detail where tc in ('Y' , 'N') and time between '{$left_time}' and '{$right_time}')
        UNION
        (select distinct mac from 00f92b8d_detail where ds='Y' and time between '{$left_time}' and '{$right_time}') 
		
		UNION
		
		(select distinct mac from 00f92b8e_detail where tc in ('Y' , 'N') and time between '{$left_time}' and '{$right_time}')
        UNION
        (select distinct mac from 00f92b8e_detail where ds='Y' and time between '{$left_time}' and '{$right_time}')
		
		UNION
		
		(select distinct mac from 00f92b8f_detail where tc in ('Y' , 'N') and time between '{$left_time}' and '{$right_time}')
        UNION
        (select distinct mac from 00f92b8f_detail where ds='Y' and time between '{$left_time}' and '{$right_time}')
		";
		
		*/
		
		
    $arr=$mysql->getAll($sql);

    $defaultDate[] = date('H:i',$start_timestamp);
    $fakeDate[]= [
        'y'=>count($arr)
    ];
    if($start_timestamp + $n >= $end_timestamp ){
        break;
    }else{
        $start_timestamp+= $n;
    }
}
echo  json_encode([
    "defaultDate"=>$defaultDate,
    "fakeDate"=>$fakeDate
]);

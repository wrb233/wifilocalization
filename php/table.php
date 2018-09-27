<?php
header("Content-Type:text/html; charset=utf-8");

/*传这些是没问题的,我已经拿这些做了测试，现在就是想办法让这个表格和数据库的表挂钩，从数据取出数据，而且要每三分钟更新
echo '<tr role="row" class="odd">';
echo '<td class="sorting_1">第1个手机MAC地址</td>
      <td>通过查表匹配到的手机品牌</td>
	  </tr>';
	  
echo '<tr role="row" class="even">';
echo '<td class="sorting_1">第2个手机MAC地址</td>
      <td>通过查表匹配到的手机品牌</td>
	  </tr>';
	  
echo '<tr role="row" class="odd">';
echo '<td class="sorting_1">第3个手机MAC地址</td>
      <td>通过查表匹配到的手机品牌</td>
	  </tr>';
	  
echo '<tr role="row" class="even">';
echo '<td class="sorting_1">第4个手机MAC地址</td>
      <td>通过查表匹配到的手机品牌</td>
	  </tr>';
	  
	  
echo '<tr role="row" class="odd">';
echo '<td class="sorting_1">第1个手机MAC地址</td>
      <td>通过查表匹配到的手机品牌</td>
	  </tr>';
	  
echo '<tr role="row" class="even">';
echo '<td class="sorting_1">第2个手机MAC地址</td>
      <td>通过查表匹配到的手机品牌</td>
	  </tr>';
	  
echo '<tr role="row" class="odd">';
echo '<td class="sorting_1">第3个手机MAC地址</td>
      <td>通过查表匹配到的手机品牌</td>
	  </tr>';
	  
echo '<tr role="row" class="even">';
echo '<td class="sorting_1">第4个手机MAC地址</td>
      <td>通过查表匹配到的手机品牌</td>
	  </tr>';
	  
echo '<tr role="row" class="odd">';
echo '<td class="sorting_1">第1个手机MAC地址</td>
      <td>通过查表匹配到的手机品牌</td>
	  </tr>';
	  
echo '<tr role="row" class="even">';
echo '<td class="sorting_1">第2个手机MAC地址</td>
      <td>通过查表匹配到的手机品牌</td>
	  </tr>';
	  
echo '<tr role="row" class="odd">';
echo '<td class="sorting_1">第3个手机MAC地址</td>
      <td>通过查表匹配到的手机品牌</td>
	  </tr>';
	  
echo '<tr role="row" class="even">';
echo '<td class="sorting_1">第4个手机MAC地址</td>
      <td>通过查表匹配到的手机品牌</td>
	  </tr>';
	  
echo '<tr role="row" class="odd">';
echo '<td class="sorting_1">第1个手机MAC地址</td>
      <td>通过查表匹配到的手机品牌</td>
	  </tr>';
	  
echo '<tr role="row" class="even">';
echo '<td class="sorting_1">第2个手机MAC地址</td>
      <td>通过查表匹配到的手机品牌</td>
	  </tr>';
	  
echo '<tr role="row" class="odd">';
echo '<td class="sorting_1">第3个手机MAC地址</td>
      <td>通过查表匹配到的手机品牌</td>
	  </tr>';
	  
echo '<tr role="row" class="even">';
echo '<td class="sorting_1">第4个手机MAC地址</td>
      <td>通过查表匹配到的手机品牌</td>
	  </tr>';
*/



/*


//下面是正二八经的代码：



/* 首先当然是连接数据库服务器啦 */
$mysqli = new MYSQLi(
    'localhost',  /* The host to connect to 连接MySQL地址 */
    'root',      /* The user to connect as 连接MySQL用户名 */
    '123',  /* The password to use 连接MySQL密码 */
    '1');    /* The default database to query 连接数据库名称*/

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

//定义左右时间
date_default_timezone_set('PRC');    //中国时间
	
$diff_time = time() -strtotime(date('Y-m-d H:',time())."00:00");

$diff_time = intval($diff_time/180)*180/60;

$right_time =  date('Y-m-d H:',time()).str_pad($diff_time,2,"0",STR_PAD_LEFT).':00';

$left_time = date('Y-m-d H:i:s',strtotime($right_time)-180);
	
	
	
	
	
	


//熟悉的sql语句，也许这种语句也就傻逼才会写吧,作为测试我先写了一条简单的sql，嘻嘻嘻
$sql = 

    "select distinct mac from 00f92b8c_detail where time between '2018-08-31 00:00' and '2018-08-31 03:00'";
/*
		"(select distinct mac from 00f92b8c_detail where tc in ('Y' , 'N') and time between '{$left_time}' and '{$right_time}') UNION (select distinct mac from 00f92b8c_detail where ds='Y' and time between '{$left_time}' and '{$right_time}') UNION (select distinct mac from 00f92b8d_detail where tc in ('Y' , 'N') and time between '{$left_time}' and '{$right_time}') UNION (select distinct mac from 00f92b8d_detail where ds='Y' and time between '{$left_time}' and '{$right_time}') UNION (select distinct mac from 00f92b8e_detail where tc in ('Y' , 'N') and time between '{$left_time}' and '{$right_time}') UNION (select distinct mac from 00f92b8e_detail where ds='Y' and time between '{$left_time}' and '{$right_time}') UNION (select distinct mac from 00f92b8f_detail where tc in ('Y' , 'N') and time between '{$left_time}' and '{$right_time}') UNION (select distinct mac from 00f92b8f_detail where ds='Y' and time between '{$left_time}' and '{$right_time}')";
*/

/*	
	"(select distinct mac from 00f92b8c_detail where tc in ('Y' , 'N') and time between '{$left_time}' and '{$right_time}') UNION (select distinct mac from 00f92b8c_detail where ds='Y' and time between '{$left_time}' and '{$right_time}') UNION (select distinct mac from 00f92b8d_detail where tc in ('Y' , 'N') and time between '{$left_time}' and '{$right_time}') UNION (select distinct mac from 00f92b8d_detail where ds='Y' and time between '{$left_time}' and '{$right_time}') UNION (select distinct mac from 00f92b8e_detail where tc in ('Y' , 'N') and time between '{$left_time}' and '{$right_time}') UNION (select distinct mac from 00f92b8e_detail where ds='Y' and time between '{$left_time}' and '{$right_time}') UNION (select distinct mac from 00f92b8f_detail where tc in ('Y' , 'N') and time between '{$left_time}' and '{$right_time}') UNION (select distinct mac from 00f92b8f_detail where ds='Y' and time between '{$left_time}' and '{$right_time}')";
	
*/
	
	
$res = $mysqli->query($sql);





				  


//循环取出数据,在这里我只会取出这张表的第一列数据，即手机MAC，至于手机品牌，还请大神赐教

//这样显示出来的表格数据，破坏了bootstrap原有模板的表格功能

while($row=$res->fetch_row()){
	 
	echo '<tr role="row" class="odd">';                    //这里我想针对MAC数的奇偶，赋值tr不同的class
        
		foreach($row as $value){
	  
			echo '<td class="sorting_1">';
			
				echo "$value";
				
					echo '</td>';
					
					
//这是为了输出手机MAC地址对应的手机品牌					
					echo '<td>';
					
					
					
					
					$shortmac_arr = explode(':', "$value");
					$shortmac_str = $shortmac_arr[0] . ':' . $shortmac_arr[1] . ':' . $shortmac_arr[2];
					
					
					
					

					$sql = "select * from macofbrand where mac_short = '{$shortmac_str}'";
					
					
					
					$result = $mysql->getAll($sql);
					
					$result = isset($result[0])?$result[0]:[];
								
					
					
					
					if($result && $result['brand']){
						
						
						
						$brand = $result['brand'];
						
						
					}else{
						$brand = "Unkonwn";
					}
					echo $brand;
					
					echo '</td>';
					
					
        }

    echo '</tr>';  
}


$res->free();


?>
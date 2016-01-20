<?php
	
function connect($servername,$username,$password,$database){
	$conn=mysql_connect($servername,$username,$password);
	if(!$conn){
		die('Could not connect:'.mysql_error());
	}
	mysql_select_db($database,$conn);
	return $conn;
}
function execution($sql,$conn){
	$result = mysql_query($sql,$conn);	
	if($result){
		return $result;
	}else{
		echo 'SQL execution FAILED:'.mysql_error();
	}
	return 0;
}
return var_dump(execution('select * from db',connect('10.59.80.178','root','123456','mysql'))); 
?>

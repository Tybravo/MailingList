<?php
// if it's goin to need the database, then its
// probably smart to require it before we start.

require_once(LIB_PATH.DS.'database.php');
class List_mailing extends DatabaseObject{

protected static $table_name= "list_mailing";
protected static $db_fields= array('id','email','firstname','lastname','phone_digit','converted','subscribe','setups','verify_string','created','s_day','s_month','s_year','time_current');
public $id;
public $email;
public $firstname;
public $lastname;
public $phone_digit;
public $converted;
public $subscribe;
public $setups;
public $verify_string;
public $created;
public $s_day;
public $s_month;
public $s_year;
public $time_current;

//common database method

public static function find_all(){
return self::find_by_sql("SELECT * FROM ".self::$table_name);
}

public static function create_list_mailing($email="", $firstname="", $lastname="", $phone_digit="", $converted="", $subscribe="", $setups="", $verify_string="", $time_current=""){
if(!empty($email)){

$bookses= new List_mailing();
$bookses->email= (string)$email;
$bookses->firstname= (string)$firstname;
$bookses->lastname= (string)$lastname;
$bookses->phone_digit= (string)$phone_digit;
$bookses->converted= (int)$converted;
$bookses->subscribe= (int)$subscribe;
$bookses->setups= (int)$setups;
$bookses->verify_string= (string)$verify_string;
$bookses->created=strftime("%Y-%m-%d %H:%M:%S", time());
$bookses->s_day=strftime("%d", time());
$bookses->s_month=strftime("%m", time());
$bookses->s_year= strftime("%Y", time());
$bookses->time_current= (string)$time_current;



return $bookses;
}
else{
return false;
}
}




public static function find_by_vstring($vstring=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE verify_key='{$vstring}'");
return !empty($result_array)? array_shift($result_array):false;
}

public static function find_by_id($id=0){
global $database;
$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id={$id} LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

public static function find_by_token($s_token=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE s_token='{$s_token}'");
return !empty($result_array)? array_shift($result_array):false;
}




//CHECK IF EMAIL ALREADY EXIST
public static function find_by_newuser_email($email=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE email='".$email."' ");
return !empty($result_array)? array_shift($result_array):false;
}

//CHECK IF SETUPS IS ACCESSIBLE ALREADY EXIST
public static function find_by_access_setups($access_setups=0){
global $database;
return self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE setups='".$access_setups."' ");
}

//GET EMAIL ADDRESS AND OTHER INFO IF ALREADY SUBMITTED BY VISITORS AND USERS
public static function find_by_visitor_email($email_address=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE email_address='".$email_address."' LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

//GET EMAIL ADDRESS AND OTHER INFO FROM VISITORS AND USERS FOR RESULTANT
public static function find_by_all(){
global $database;
return self::find_by_sql("SELECT * FROM ".self::$table_name);
}







public static function find_by_sql($sql=""){
global $database;
$result_set = $database->query($sql);
$object_array=array();
while ($row =$database->fetch_array($result_set)){
$object_array[]=self::instantiate($row);
}
return $object_array;
}

public static function count_all(){
global $database;
$sql= "SELECT COUNT(*) FROM ".self::$table_name;
$result_set = $database->query($sql);
$row = $database->fetch_array($result_set);
return array_shift($row);
}



private static function instantiate($record){
$object = new self;
//$object->id 		= $record['id'];
//$object->username 	= $record['username'];
//$object->password 	= $record['password'];
//$object->first_name 	= $record['first_name'];
//$object->last_name 	= $record['last_name'];

foreach($record as $attribute=>$value){
if($object->has_attribute($attribute)){
$object->$attribute=$value;
}
}

return $object;
}

private function has_attribute($attribute){
//get_object_vars returns an associative array with all attributes
$object_vars = $this->attributes();

return array_key_exists($attribute, $object_vars);

}


protected function attributes() {

//return an array of attribute keys and their values

$attributes = array();
foreach(self::$db_fields as $field){
if(property_exists($this, $field)){
 $attributes[$field]=$this->$field;
}
}
return $attributes;

}


protected function sanitized_attributes() {
global $database;
$clean_attributes=array();
//sanitize the values before submitting
//Note: does not alter the actual value of each attribute
foreach($this->attributes() as $key=>$value){
 $clean_attributes[$key] = $database->escape_value($value);
}
return $clean_attributes;
}

public function create(){
global $database;
//dont forget SQL syntax and good habits;
//INSERT INTO table (key,key) VALUES('value', value)
//single quotes around all values
//escape all values to prevent SQL injection
$attributes=$this->sanitized_attributes();
$sql= "INSERT INTO ".self::$table_name." (";
$sql .= join(", ", array_keys($attributes));
$sql .= ") VALUES('";
$sql .= join("', '", array_values($attributes));
$sql .= "')";

if($database->query($sql)){
 $this->id=$database->insert_id();
 return true;
}
else{
 return false;
}

}


public function save(){
// A new record won't have an id
return isset($this->id)? $this->update() : $this->create();
}


public function update(){

global $database;
//dont forget SQL syntax and good habits;
//UPDATE table SET key='value' WHERE condition
//single quotes around all values
//escape all values to prevent SQL injection
$attributes=$this->sanitized_attributes();
$attribute_pairs=array();
foreach($attributes as $key=>$value){
 $attribute_pairs[]="{$key}='{$value}'";
}

$sql = "UPDATE ".self::$table_name." SET ";
$sql .= join(", ", $attribute_pairs);
$sql .= " WHERE id='".$database->escape_value($this->id)."'";
$database->query($sql);
return ($database->affected_rows()==1)? true : false;
}

public function delete(){
global $database;
//dont forget SQL syntax and good habits;
//DELETE FROM table WHERE condition LIMIT 1
//single quotes around all values
//escape all values to prevent SQL injection
// Use LIMIT 1
$sql ="DELETE FROM ".self::$table_name;
$sql .=" WHERE id=" .$database->escape_value($this->id);
$sql .=" LIMIT 1";
$database->query($sql);
return ($database->affected_rows()==1)? true : false;
}
}
?>
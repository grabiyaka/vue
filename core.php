<?php

class myDB extends MySQLi
{
    public function q($query){
        $this->real_query($query);
        return new myDB_Result($this);
    }
}

class myDB_Result extends MySQLi_Result
{
    public function json(){
		$output = [];
		while ($row = $this->fetch_assoc()){
			$output[] = $row;
		}
		return json_encode($output, JSON_UNESCAPED_UNICODE);

    }

    public function arr(){
        $output = [];
		while ($row = $this->fetch_assoc()){
			$output[] = $row;
		}
		return $output;
    }

    public function get($field){
        $res = $this->fetch_assoc();
        return $res[$field];
    }
}

$db = new myDB("localhost", "root", "", "jojo");
$db->set_charset("utf8");

function post_check(){
    global $db;
    foreach (array_keys($_POST) as $field) { 
        $GLOBALS[$field] = $_POST[$field] ? htmlspecialchars(
            $db->real_escape_string( trim($_POST[$field]) )) : false;
    }
}

function to_json($a){
    return json_encode($a, JSON_UNESCAPED_UNICODE);
}
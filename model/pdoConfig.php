<?php

class PDOConfig extends PDO {

  private $engine;
  public $host;
  public $database;
  public $user;
  public $pass;

  public function __construct(){

    // DB CONFIG
    $dbhost = 'localhost';
    $dbuser = 'jjcretsuser2';
    $dbpass = '77work77!';
    $dbname = 'jjcRets';

    $this->engine = 'mysql';
    $this->host = $dbhost;
    $this->database = $dbname;
    $this->user = $dbuser;
    $this->pass = $dbpass;
    $dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
    parent::__construct( $dns, $this->user, $this->pass );
    //$this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		//$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  }

}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	GLOBAL UTILITY FUNCTIONS - because not everything should be in a class
//
/////////////////////////////////////////////////////////////////////
function fixBlanks($inStg){
	return str_replace(" ","-",$inStg);
}

function fixDashes($inStg){
	return str_replace("-"," ",$inStg);
}
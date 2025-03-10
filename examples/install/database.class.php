<?php

/**
 *	Class Database (PDO Extension)
 *  ---------------------------- 
 *  Description : encapsulates database operations & properties with PDO
 *  Updated	    : 22.12.2011
 *  Version     : 1.0.3
 *	Written by  : ApPHP
 *	Syntax (standard)  : $db = new Database($database_host, $database_name, $database_username, $database_password, EI_DATABASE_TYPE, $is_installation);
 *	Syntax (singleton) : $db = Database::GetInstance($database_host, $database_name, $database_username, $database_password, EI_DATABASE_TYPE, $is_installation);
 *
 *  PUBLIC           STATIC				 PROTECTED           PRIVATE
 *  -------          ----------          ----------          ---------- 
 *  __construct      GetInstance
 *	__destruct       IsConnected
 *	Create           
 *	Open             
 *	Close
 *	GetVersion
 *	GetDbDriver
 *	Query
 *	Exec
 *	AffectedRows
 *	RowCount
 *	ColumnCount
 *	InsertID
 *	SetEncoding
 *	Error
 *	ErrorCode
 *	ErrorInfo
 *	FetchAssoc
 *	FetchArray
 *
 *	CHANGE LOG
 *	-----------	
 *  1.0.3
 *      - improved Exec() - added $check_error parameter
 *      - improved Query() - added fetch type
 *      - added oci connection case in Open() method
 *      - improved oci connection string
 *      - added connect syntaxt for "ibm"
 *  1.0.2
 *  	- added FetchAssoc()
 *  	- fixed bug in RowCount
 *  	- fixed bug in GetInstance()
 *  	- added IsConnected()
 *  	- fixed error with $installation property
 *  1.0.1
 *  	- added GetDbDriver
 *  	- improved GetVersion()
 *  	- added Create()
 *  	- added GetInstance()
 *  	- added default params for SetEncoding()
 *	
 **/

class Database
{
    // connection parameters
	
	private $host = "";
	private $port = "";
	private $db_driver = "";
    private $database = "";
    private $user = "";
    private $password = "";
	private $force_encoding = false;
	private static $installation = false;

	private $error = "";
	
	private $affectedRows = "0";

	// database connection handler 
    private $dbh = NULL;
	
	// database statament handler 
	private $sth = NULL;
    
	// static data members	
	private static $objInstance; 


	//==========================================================================
    // Class Constructor
	// 		@param $database_host
	// 		@param $database_name
	// 		@param $database_username
	// 		@param $database_password
	// 		@param $db_driver
	// 		@param $force_encoding
	// 		@param $is_installation
	//==========================================================================
    function __construct($database_host="", $database_name="", $database_username="", $database_password="", $db_driver="", $force_encoding=false, $is_installation=false)	
    {
		$this->host 	 = $database_host;
		$this->port 	 = "";
		
		$host_parts 	 = explode(":", $database_host);		
		if(isset($host_parts[1]) && is_numeric($host_parts[1])){
			$this->host = $host_parts[0];	
			$this->port = $host_parts[1];	
		}
		
		if($database_host == ""){
			$config = new Config();	
			$this->host = $config->getHost();
			$this->user = $config->getUser();
			$this->password = $config->getPassword();
			$this->database = $config->getDatabase();
			$this->db_driver = $config->getDatabaseType();
			$this->force_encoding = $force_encoding;
		}else{
			$this->database  = $database_name;   	
			$this->user 	 = $database_username;
			$this->password  = $database_password;
			$this->db_driver = strtolower($db_driver);
			$this->force_encoding = $force_encoding;
			
		}
		
		self::$installation = ($is_installation) ? true : false;
	}

	//==========================================================================
    // Class Destructor
	//==========================================================================
    function __destruct()
	{
		// echo 'this object has been destroyed';
    }

    /**
     *	Create database
     */
    public function Create()
    {
		$this->dbh = new PDO($this->db_driver.":host=".$this->host, $this->user, $this->password);
		$this->dbh->exec("CREATE DATABASE IF NOT EXISTS `".$this->database."`;");
		if($this->dbh->errorCode() != "00000"){
			$err = $this->dbh->errorInfo();
			$this->error = $err[2];
			return false; 
		}
		return true; 
	}

    /**
     *	Checks and opens connection with database
     */
    public function Open()
    {
		if(version_compare(PHP_VERSION, '5.0.0', '<') || !defined('PDO::ATTR_DRIVER_NAME')){
			$this->error = "You must have PHP 5 or newer installed to use PHP Data Objects (PDO) extension";
			return false; 
		}

		$port = (!empty($this->port)) ? ";port=".$this->port : "";

		try{
			switch($this->db_driver){
				case "mssql": 
					$this->dbh = new PDO("mssql:host=".$this->host.$port.";dbname=".$this->database, $this->user, $this->password);
					break;
				case "sybase": 
					$this->dbh = new PDO("sybase:host=".$this->host.$port.";dbname=".$this->database, $this->user, $this->password);
					break;
				case "sqlite":
					$this->dbh = new PDO("sqlite:my/database/path/database.db");
					break;
				case "pgsql":
					$this->dbh = new PDO("pgsql:host=".$this->host.$port.";dbname=".$this->database, $this->user, $this->password);
					break;
                case "ibm": 
                    $db_conn = new PDO("ibm:".$this->database, $this->user, $this->password); 
				case "oci":
					// Look for valid parameters in product\10.2.0\server\NETWORK\ADMIN	
					// Example: $tns = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = private-22269fa)(PORT = 1521)) (CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = XE) ))";
					$port = (!empty($this->port)) ? $this->port : "1521";
					$tns = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = ".$this->host.")(PORT = ".$port.")) (CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = ".$this->database.") ))";
					$this->dbh = new PDO("oci:dbname=".$tns, $this->user, $this->password);
					break;
				case "mysql":
				default:
					$this->dbh = new PDO($this->db_driver.":host=".$this->host.$port.";dbname=".$this->database, $this->user, $this->password);
					break;
			}
			$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if(empty($this->dbh)){
				return false;
			}else if($this->force_encoding){
				$this->dbh->exec("set names utf8");
			}
		}catch(PDOException $e){  
			$this->error = $e->getMessage();
			return false; 
		}            

        return true;
    }	
    
    /**
     *	Close connection 
     */
    public function Close()
    {
		$this->sth = null;
		$this->dbh = null;
    }

    /**
     *	Returns database engine version
     */
	public function GetVersion()
	{
		// clean version number from alphabetic characters
		$version = $this->dbh->getAttribute(PDO::ATTR_SERVER_VERSION);
		return preg_replace("/[^0-9,.]/", "", $version);
	}

    /**
     *	Get DB driver
     */
    public function GetDbDriver()
    {
		return $this->db_driver;
    }

    /**
     *	Runs query
     *		@param $query
     */
    public function Query($query = '', $fetch_mode = PDO::FETCH_ASSOC)
    {
		try{  
			$this->sth = $this->dbh->query($query);
			if($this->sth !== FALSE){
				//if(!empty($fetch_mode))
				$this->sth->setFetchMode($fetch_mode);
				return $this->sth;
			}
			else return false; 
		}catch(PDOException $e){
			$this->error = $e->getMessage();
			
			if(!self::$installation){
				$error_no = $e->getCode();
				$error_descr  = "ENV:        ". $_SERVER['SERVER_NAME']."<br><br>";
				$error_descr .= "TIME:       ".@date("M d, Y g:i A")."<br><br>";
				$error_descr .= "SCRIPT:     ".$_SERVER['PHP_SELF']."<br><br>";
				$error_descr .= "ERROR LINE: ".(int)$e->getLine()."<br><br>"; 
				$error_descr .= "ERROR:      ".$this->error."<br><br>";
				$error_descr .= "QUERY:      ".$query."<br><br>";
				$current_file = basename($_SERVER['PHP_SELF'], ".php").".php";
				
				$ip_address = get_ip_address();
				$sql_log = "INSERT INTO ".TABLE_SYSTEM_LOGS." (id, log_type, title, file_name, log, ip_address, date_created)
						    VALUES (NULL, 'Error', 'DB Error #".$error_no."', '".$current_file."', '".encode_text($error_descr)."', '".$ip_address."', '".@date("Y-m-d H:i:s")."')";
				$this->Exec($sql_log, false);
			}
			return false; 
		}            
    }

    /**
     *	Executes query
     *		@param $query
     */
    public function Exec($query = '', $check_error = true)
	{
		try{
			$this->affectedRows = $this->dbh->exec($query);
			return $this->affectedRows;	
		}catch(PDOException $e){			
			if($check_error){
				$this->error = $e->getMessage();				
				if(!self::$installation){
					$error_no = $e->getCode();
					$error_descr  = "ENV:        ". $_SERVER['SERVER_NAME']."<br><br>";
					$error_descr .= "TIME:       ".@date("M d, Y g:i A")."<br><br>";
					$error_descr .= "SCRIPT:     ".$_SERVER['PHP_SELF']."<br><br>";
					$error_descr .= "ERROR LINE: ".(int)$e->getLine()."<br><br>"; 
					$error_descr .= "ERROR:      ".$this->error."<br><br>";
					$error_descr .= "QUERY:      ".$query."<br><br>";
					$current_file = basename($_SERVER['PHP_SELF'], ".php").".php";
					
					$ip_address = get_ip_address();
					$sql_log = "INSERT INTO ".TABLE_SYSTEM_LOGS." (id, log_type, title, file_name, log, ip_address, date_created)
							    VALUES (NULL, 'Error', 'DB Error #".$error_no."', '".$current_file."', '".encode_text($error_descr)."', '".$ip_address."', '".@date("Y-m-d H:i:s")."')";
					$this->Query($sql_log);
				}				
			}			
			return false; 
		}		
	}

    /**
     *	Set encoding and collation on database
     *		@param $encoding
     *		@param $collation
     */
    public function SetEncoding($encoding = "utf8", $collation = "utf8_unicode_ci")
    {		
		if(empty($encoding)) $encoding = "utf8";
        if(empty($collation)) $collation = "utf8_unicode_ci";    
        $sql_variables = array(
                'character_set_client'  =>$encoding,
                'character_set_server'  =>$encoding,
                'character_set_results' =>$encoding,
                'character_set_database'=>$encoding,
                'character_set_connection'=>$encoding,
                'collation_server'      =>$collation,
                'collation_database'    =>$collation,
                'collation_connection'  =>$collation
        );
        foreach($sql_variables as $var => $value){
            $sql = "SET $var=$value;";
            $this->Query($sql);
        }        
    }

    /**
     *	Returns affected rows after exec()
     */
    public function AffectedRows()
    {
		return $this->affectedRows;
    }	

    /**
     *	Returns rows count for query()
     */
    public function RowCount()
    {
		return $this->sth->rowCount(); 
    }		

    /**
     *	Returns columns count for query()
     */
    public function ColumnCount()
    {
		return $this->sth->columnCount(); 
    }		

    /**
     *	Returns last insert ID
     */
	public function InsertID()
    {
		return $this->dbh->lastInsertId();
    }

    /**
     *	Returns error 
     */
    public function Error()
    {
		return $this->error;		
    }
	
    /**
     *	Returns error code
     */
    public function ErrorCode()
    {
		return $this->dbh->errorCode();
    }

    /**
     *	Returns error code
     */
    public function ErrorInfo()
    {
		return $this->sth->errorInfo();
    }
 
	/**
	 * Fetch assoc
	 */
    public function FetchAssoc()
    {
		return $this->sth->fetch(PDO::FETCH_ASSOC);
    }
 
	/**
	 * Fetch array
	 */
    public function FetchArray()
    {
		return $this->sth->fetch(PDO::FETCH_BOTH);
    }

	//==========================================================================
    // Returns DB instance or create initial connection 
	// 		@param $database_host
	// 		@param $database_name
	// 		@param $database_username
	// 		@param $database_password
	// 		@param $db_driver
	// 		@param $force_encoding
	// 		@param $is_installation
	//==========================================================================
	public static function GetInstance($database_host = "", $database_name = "", $database_username = "", $database_password = "", $db_driver = "", $force_encoding = false, $is_installation = false)
	{
		$database_port = "";
		
		$host_parts = explode(":", $database_host);		
		if(isset($host_parts[1]) && is_numeric($host_parts[1])){
			$database_host = $host_parts[0];	
			$database_port = $host_parts[1];	
		}
		
		if($database_host == ""){
			$config = new Config();	
			$database_host = $config->getHost();
			$database_name = $config->getDatabase();
			$database_username = $config->getUser();
			$database_password = $config->getPassword();			
			$db_driver = $config->getDatabaseType();
		}
		
		if(!self::$objInstance){
			self::$objInstance = new Database($database_host, $database_name, $database_username, $database_password, $db_driver, $force_encoding, $is_installation);
			self::$objInstance->Open();
        }		
        return self::$objInstance; 
	}
	
	/**
	 * Check if connected
	 */
	public static function IsConnected()
	{
		return (self::$objInstance) ? true : false; 
	}
	
}

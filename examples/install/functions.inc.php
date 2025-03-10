<?php

/**
 * 	Prepare reading of SQL dump file and executing SQL statements
 * 		@param $sql_dump_file
 */
function apphp_db_install($sql_dump_file) {
	global $error_mg;
	global $username;
	global $password;
	global $database_prefix;
	global $password_encryption;
	global $db;
	
	$sql_array = array();
	$query = "";
	
	// get  sql dump content
	$sql_dump = file($sql_dump_file);
	
	// replace database prefix if exists
	$sql_dump = str_ireplace('<DB_PREFIX>', $database_prefix, $sql_dump);

	// add ";" at the end of file
	if(substr($sql_dump[count($sql_dump)-1], -1) != ";") $sql_dump[count($sql_dump)-1] .= ";";		
								
	// replace username and password if exists
	if(EI_USE_USERNAME_AND_PASWORD){
		$sql_dump = str_ireplace("<USER_NAME>", $username, $sql_dump);
		if(EI_USE_PASSWORD_ENCRYPTION){
			if($password_encryption == "AES"){
				$sql_dump = str_ireplace("<PASSWORD>", "AES_ENCRYPT('".$password."', '".EI_PASSWORD_ENCRYPTION_KEY."')", $sql_dump);
			}else if($password_encryption == "MD5"){
				$sql_dump = str_ireplace("<PASSWORD>", "MD5('".$password."')", $sql_dump);
			}else{
				$sql_dump = str_ireplace("<PASSWORD>", "AES_ENCRYPT('".$password."', '".EI_PASSWORD_ENCRYPTION_KEY."')", $sql_dump);				
			}
		}else{
			$sql_dump = str_ireplace("<PASSWORD>", "'".$password."'", $sql_dump);
		}
	}else{
		$sql_dump = str_ireplace("<USER_NAME>", "", $sql_dump);
		$sql_dump = str_ireplace("<PASSWORD>", "''", $sql_dump);
	}
	$sql_dump = str_ireplace("<ENCRYPTION_TYPE>", $password_encryption, $sql_dump);

	// encode connection, server, client etc.	
	if(EI_USE_ENCODING){
		$db->SetEncoding(EI_DUMP_FILE_ENCODING, EI_DUMP_FILE_COLLATION);
	}		
	
	foreach($sql_dump as $sql_line){
		$tsl = trim(utf8_decode($sql_line));
		if(($sql_line != "") && (substr($tsl, 0, 2) != "--") && (substr($tsl, 0, 1) != "?") && (substr($tsl, 0, 1) != "#")) {
			$query .= $sql_line;
			if(preg_match("/;\s*$/", $sql_line)){
				if(EI_MODE == "debug"){
					if(!$db->Query($query)){ $error_mg[] = $db->Error(); return false; }						
				}else{
					if(!@$db->Query($query)){ $error_mg[] = $db->Error(); return false; }
				}
				$query = "";
			}
		}
	}
	return true;
}

/**
 *	Get encoded text
 *		@param $string
 */
function encode_text($string = '')
{
	$search	 = array("\\","\0","\n","\r","\x1a","'",'"',"\'",'\"');
	$replace = array("\\\\","\\0","\\n","\\r","\Z","\'",'\"',"\\'",'\\"');
	return str_replace($search, $replace, $string);
}

/**
 *	Remove bad chars from input
 *	  	@param $str_words - input
 **/
function prepare_input($str_words, $escape = false, $level = 'high')
{
    $found = false;
    $str_words = htmlentities(strip_tags($str_words));
    if($level == 'low'){
        $bad_string = array('drop', '--', 'insert', 'xp_', '%20union%20', '/*', '*/union/*', '+union+', 'load_file', 'outfile', 'document.cookie', 'onmouse', '<script', '<iframe', '<applet', '<meta', '<style', '<form', '<body', '<link', '_GLOBALS', '_REQUEST', '_GET', '_POST', 'include_path', 'prefix', 'ftp://', 'smb://', 'onmouseover=', 'onmouseout=');
    }else if($level == 'medium'){
        $bad_string = array('select', 'drop', '--', 'insert', 'xp_', '%20union%20', '/*', '*/union/*', '+union+', 'load_file', 'outfile', 'document.cookie', 'onmouse', '<script', '<iframe', '<applet', '<meta', '<style', '<form', '<body', '<link', '_GLOBALS', '_REQUEST', '_GET', '_POST', 'include_path', 'prefix', 'ftp://', 'smb://', 'onmouseover=', 'onmouseout=');		
    }else{
        $bad_string = array('select', 'drop', '--', 'insert', 'xp_', '%20union%20', '/*', '*/union/*', '+union+', 'load_file', 'outfile', 'document.cookie', 'onmouse', '<script', '<iframe', '<applet', '<meta', '<style', '<form', '<img', '<body', '<link', '_GLOBALS', '_REQUEST', '_GET', '_POST', 'include_path', 'prefix', 'http://', 'https://', 'ftp://', 'smb://', 'onmouseover=', 'onmouseout=');
    }
    for($i = 0; $i < count($bad_string); $i++){
        $str_words = str_replace($bad_string[$i], '', $str_words);
    }
    
    if($escape){
        $str_words = encode_text($str_words); 
    }
    
    return $str_words;
}

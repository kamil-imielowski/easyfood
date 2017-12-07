<?php
namespace classes\Users;
/**
*
*/
class UsersController
{
	var $userID            = '';
	var $logID             = '';

	var $err_log           = '';
	var $err_txt           = '';

	var $user_login        = '';

	var $user_name         = '';
	var $user_surname      = '';
	var $user_email        = '';
	var $user_type		   = '';



	public function __construct()
	{
		if (session_panel=='' || session_panel=='session_panel') die('"session_panel" not defined.');

		$this->userID = '';
		$this->logID = '';

		if(isset($_SESSION[session_panel]['userID']) && $_SESSION[session_panel]['userID'] > 0){
			$this->userID = $_SESSION[session_panel]['userID'];
			$this->logID  = $_SESSION[session_panel]['logID'];
		}

		$this->getUserInfo();
		define('user_id', $this->userID);
	}

	public function userLogin($login, $pass)
	{
		$t=db_get_arr('users', 'id, email, state', 'LOWER(email)=LOWER("'.$login.'") AND pass="'.$pass.'" LIMIT 0, 1');
		$o = false;

		if (is_Array($t))
	    {
	    	if ($t[0]['state']!='on' && $t[0]['state']!='moderate')
	        {
	        	$msg = 'account_blocked';
	        	$this->err_log[] = $msg;
	        	$log_id = db_add('users_logging', '"0", NOW(), "0000-00-00 00:00:00", 1, "'.mysqli_real_escape_string($login).'", "0", "'.getenv("REMOTE_ADDR").'", "'.gethostbyaddr(getenv("REMOTE_ADDR")).'", "'.mysqli_real_escape_string(getenv("HTTP_USER_AGENT")).'", "blocked"');
	        }
	     	else
	       	{
	        	$this->userID = $t[0]['id'];


	        	$_SESSION[session_panel]['userID'] = $this->userID;

	        	$log_id = db_add('users_logging', '"0", NOW(), "0000-00-00 00:00:00", 1, "'.mysqli_real_escape_string($login).'", "'.$this->userID.'", "'.getenv("REMOTE_ADDR").'", "'.gethostbyaddr(getenv("REMOTE_ADDR")).'", "'.mysqli_real_escape_string(getenv("HTTP_USER_AGENT")).'", "in"');

	        	$this->logID  = $_SESSION[session_panel]['logID'] = $log_id;

	       		$this->getUserInfo();

	        	$o = true;
	        }
	    }
	  	else
	    {
	    	$msg = 'account_bad_username_password';

	    	$this->err_log[] = $msg;

	    }

		return $o;
	}

	public function prepareUserAvatar($id = ''){
		if(empty($id)) $id = $this->userID;

		$a = db_get_arr('users','picture','id="'.$id.'"');
		if(is_array($a) && $a[0]['picture'] != '')
			return base_url.filesDir(user_files, $id).$a[0]['picture'];
		else return base_url.'images/av.png';
	}

	public function CheckEmailExist($email)
	{
		$a = db_count('users','email="'.$email.'"');
		if($a > 0)
			return true;
		else
			return false;
	}

	private function getUserInfo()
	{
		if(is_numeric($this->userID)){

			$a = db_get_arr('users', 'id, firstname, email, lastname, user_type', 'id="'.$this->userID.'"');

			if (is_array($a)){
				$a = $a[0];

				$this->user_name    = $a['firstname'];
				$this->user_surname = $a['lastname'];
				$this->user_email   = $a['email'];
				$this->user_type		= $a['user_type'];
		  }
		}
	}


	public function isLogged()
	{
		if (is_numeric($this->logID) && $this->logID>0) return true;
		else                                            return false;
	}


	public function logoutMe()
	{
		$this->userID = $_SESSION[session_panel]['userID'] = '';
		$this->logID  = $_SESSION[session_panel]['logID'] = '';
	}


	public function isAdmin()
	{
		$a = db_get_arr('users','*','id="'.$this->userID.'" and user_type="admin"');
		if(is_array($a))
			return true;
		else
			return false;
	}
}

?>

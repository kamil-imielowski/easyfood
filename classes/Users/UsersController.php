<?php
namespace classes\Users;


use classes\Database\DatabaseController;
/**
*
*/
class UsersController
{
	private $db;
	private $logID            = '';
	private $err_log          = [];

	public $userID            = '';
	public $user_name         = '';
	public $user_surname      = '';
	public $user_email        = '';
	public $user_type		   		= '';



	public function __construct(DatabaseController $DB)
	{
		$this->db = $DB;

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
		$query = 'SELECT id, email, state FROM users where LOWER(email) = :email AND pass = :pass LIMIT 0, 1';//WHERE id = :id
		$param = [
		            'email' => $login,
								'pass' => md5($pass)
		          ];

		$this->db->setQuery($query)->setParams($param)->execute();
		$t = $this->db->fetchData();

		$o = false;

		if (!empty($t))
	    {
	    	if ($t[0]['state']!='on' && $t[0]['state']!='moderate')
	        {
	        	$msg = 'account_blocked';
	        	array_push($this->err_log,$msg);
						$query = "
		            INSERT INTO users_logging(date_log, login, user_id, ip, hostname, system, state)
		            VALUES (NOW(), :login, :user_id, :ip, :hostname, :system, 'blocked')
		        ";

		        $params = [
		            "login" => $login,
		            "user_id" => $t[0]['id'],
		            "ip" => getenv("REMOTE_ADDR"),
		            "hostname" => gethostbyaddr(getenv("REMOTE_ADDR")),
		            "system" => getenv("HTTP_USER_AGENT")
		        ];

		        $this->db->setQuery($query)->setParams($params)->execute();
						$log_id = $this->db->getLastId();

	        }
	     	else
	       	{
	        	$this->userID = $t[0]['id'];


	        	$_SESSION[session_panel]['userID'] = $this->userID;

						$query = "
		            INSERT INTO users_logging (date_log, login, user_id, ip, hostname, system, state)
		            VALUES (NOW(), :login, :user_id, :ip, :hostname, :system, 'in')
		        ";

		        $params = [
		            "login" => $login,
		            "user_id" => $t[0]['id'],
		            "ip" => getenv("REMOTE_ADDR"),
		            "hostname" => gethostbyaddr(getenv("REMOTE_ADDR")),
		            "system" => getenv("HTTP_USER_AGENT")
		        ];

		        $this->db->setQuery($query)->setParams($params)->execute();
						$log_id = $this->db->getLastId();

	        	$this->logID  = $_SESSION[session_panel]['logID'] = $log_id;

	       		$this->getUserInfo();

	        	$o = true;
	        }
	    }
	  	else
	    {
	    	$msg = 'account_bad_username_password';

	    	array_push($this->err_log,$msg);
				$o = false;

	    }

		return $o;
	}

	public function CheckEmailExist($email): bool
	{
		$query = 'SELECT COUNT(*) as _ct FROM users where email like :email';//WHERE id = :id
		$param = [
								'email' => $email
							];

		$this->db->setQuery($query)->setParams($param)->execute();
		$a= $this->db->fetchData();


		return (bool) $a[0]['_ct'];
	}

	private function getUserInfo()
	{
		if(is_numeric($this->userID)){

			$query = 'SELECT id, firstname, email, lastname, user_type FROM users where id = :id';//WHERE id = :id
			$param = [
			            'id' => $this->userID
			          ];

			$this->db->setQuery($query)->setParams($param)->execute();
			$a= $this->db->fetchData();

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


	public function logout()
	{
		$this->userID = $_SESSION[session_panel]['userID'] = '';
		$this->logID  = $_SESSION[session_panel]['logID'] = '';
	}
}

?>

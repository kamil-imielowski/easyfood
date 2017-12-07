<?php
namespace classes\Database;

use PDO;

class DatabaseController
{
    private $functions;
    private $pdo;
    private $pdoCfg;
    public $query;
    private $queryCount;
    private $params;
    private $host;
    private $port;
    private $database;
    private $username;
    private $password;
    private $charset;
    private $status;
    private $data;
    public $error;
    private $lastId;
    private $queryHistory = [];
    private $numReconnectTries = 0;
    private $maxReconnectTries = 5;



    function __construct($__dbConfig)
    {
        $this->host = $__dbConfig["host"];
        $this->port = $__dbConfig["port"];
        $this->database = $__dbConfig["database"];
        $this->username = $__dbConfig["user"];
        $this->password = $__dbConfig["password"];
        $this->charset = $__dbConfig["charset"];

        $this->pdoCfg = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_PERSISTENT => false
        ];

        $this->connect();
    }


    private function connect()
    {
        try
        {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->database;charset=$this->charset", $this->username, $this->password, $this->pdoCfg);

            $this->queryCount = 0;
            $this->numReconnectTries = 0;
        }
        catch(\PDOException $e)
        {
            if($this->numReconnectTries < $this->maxReconnectTries)
            {
                $this->reconnect();
            }
            else
            {
                //require __CFG_DIR__ . "/config.php";

                if($this->functions->isDev())
                {
                    die(var_dump($e));
                }
                else
                {
                    $response = [
                        "status" => "fail",
                        "msg" => "general server error, please contact server admin at " . $__config["server_admin"]
                    ];

                    die(json_encode($response));
                }
            }
        }
        catch(Exception $e)
        {
            die("Generic error...");
        }
    }


    private function reconnect()
    {
        echo "[error] Connection lost, trying to reconnect... \n";

        $this->numReconnectTries++;
        $this->connect();
    }

    public function getStatus()
    {
        $tmp = $this->status;
        $this->status = null;

        return $tmp;
    }


    public function getPdo()
    {
        return $this->pdo;
    }


    public function getQueryCount()
    {
        return $this->queryCount;
    }


    public function getLastId() : int
    {
        return $this->lastId;
    }


    public function setQuery(string $query)
    {
        $this->query = $query;
        $this->queryHistory[] = $query;

        return $this;
    }

    public function setParams(array $params)
    {
        $this->params = $params;

        return $this;
    }

    public function execute()
    {
        $tmp = null;
        $this->status = null;


        if($this->pdo === null || !$this->pdo || $this->pdo == null) $this->reconnect();


        try
        {
            $tmp = $this->pdo->prepare(stripslashes($this->query));
        }
        catch(\PDOException $e)
        {
            $this->reconnect();
            $this->execute();
        }
        catch(Exception $e)
        {
            $this->reconnect();
            $this->execute();
        }


        if($this->params)
        {
            $params = $this->params;
        }
        else
        {
            $params = [];
        }

        $this->queryCount++;

        $this->status = (bool)$tmp->execute($params);

        $this->lastId = $this->pdo->lastInsertId();
        $this->data = $tmp->fetchAll();

        $this->params = null;
        $this->query = null;
    }

    public function fetchData()
    {
        return $this->data;
    }


    public function getQueryHistory() : array
    {
        return $this->queryHistory;
    }


    public function getOne(string $table, string $cols, string $condition, array $params)
    {
        $tmp = $this->get($table, $cols, $condition . " LIMIT 1", $params);

        if(isset($tmp[0]) && is_array($tmp[0]))
        {
            $tmp = $tmp[0];
        }
        else
        {
            $tmp = [];
            $this->status = false;
            $this->error = "no data";
        }

        return $tmp;
    }



    public function add(string $table, array $data)
    {
        if($data != [])
        {
            $keys = array_keys($data);
            $query = "INSERT INTO {$table} (" . implode(", ", $keys) . ") VALUES (:" . implode(", :", $keys) . ")";

            $this->setParams($data)->setQuery($query)->execute();
        }
        else
        {
            $this->status = false;
            $this->error = "empty array";
        }

        return $this->status;
    }


    public function getTableColumn(string $rowName, string $table) : array
    {
        $query = "
          SELECT {$rowName} FROM {$table}
        ";
        $this->setQuery($query)->execute();
        $tmp = $this->fetchData();

        if($tmp)
        {
            foreach($tmp as $t)
            {
                $ret[] = $t[$rowName];
            }

            return $ret;
        }

        return [];
    }
}
?>

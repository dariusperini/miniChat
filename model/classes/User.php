<?php

class User {

    const STATUS_NOTCONNECTED   = 0;
    const STATUS_CONNECTED      = 1;

    protected $id;
    protected $email;
    protected $pass;
    protected $firstname;
    protected $lastname;
    protected $lastLog;
    
    protected static $database;

    private $status = self::STATUS_NOTCONNECTED;
    
    function getId() 
    {
        return $this->id;
    }

    function getEmail() 
    {
        return $this->email;
    }

    function getPass() 
    {
        return $this->pass;
    }

    function getFirstname() 
    {
        return $this->firstname;
    }

    function getLastname() 
    {
        return $this->lastname;
    }

    function getStatus() 
    {
        return $this->status;
    }

    function getLastLog() 
    {
        return $this->lastLog;
    }
   
    static function getDatabase() {
        return self::$database;
    }

        
    function setId($id) 
    {
        $this->id = $id;
    }

    function setEmail($email) 
    {
        $this->email = $email;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    function setFirstname($firstname) 
    {
        $this->firstname = $firstname;
    }

    function setLastname($lastname) 
    {
        $this->lastname = $lastname;
    }

    function setStatus($status) 
    {
        $this->status = $status;
    }
    
    function setLastLog($lastLog) 
    {
        $this->lastLog = $lastLog;
    }
    
    static function setDatabase($database) {
        self::$database = $database;
    }

    
    public function __construct($database,$id=0) 
    {
        $this->setId($id);
        $this->setDatabase($database);
        if ($id != 0) {
            $sql = "SELECT * from user where user.id='{$id}'";

            try {
                $query = $database->query($sql);
            } catch (\PDOException $error) {
             $tabErrors[] = $error->getMessage();
            }

            if($result = $query->fetch()) {
                $this->setEmail($result['email']);
                $this->setFirstname($result['firstname']);
                $this->setLastname($result['lastname']);
                $this->setLastLog($result['last_log']);
            }    
        }

    }

    public function login($login,$pass)
    {
        $sql = "SELECT user.id from user where user.email='{$login}' and user.pass='{$pass}'";
        $query = self::$database->query($sql);

        if($result = $query->fetch()) {
        // utiliusateur trouvé on le met en session
            $this->setId($result['id']);


                $insert = 'UPDATE user set last_log = NOW() where id=:userId;';
                $query = self::$database->prepare($insert);
                $query->bindValue(':userId', $this->getId());
                $query->execute();    
        }

    }
    
}
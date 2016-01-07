<?php

class Chat 
{
    private $sessionStartDate;
    private $lastMessageId;
    
    
    
    protected static $database;
    
    function getSessionStartDate() {
        return $this->sessionStartDate;
    }

    static function getDatabase() {
        return self::$database;
    }

    function getLastMessageId() {
        return $this->lastMessageId;
    }

    function setSessionStartDate($sessionStartDate) {
        $this->sessionStartDate = $sessionStartDate;
    }

    function setLastMessageId($lastMessageId) {
        $this->lastMessageId = $lastMessageId;
    }

    static function setDatabase($database) {
        self::$database = $database;
    }

    public function getAllSessionMessages()
    {
       
        $sql = "SELECT messageId,message.message,user.firstname from message,user where user.id=message.user_id and message.date_posted>'{$this->getSessionStartDate()}' order by messageId  ASC";

        try {
            $query = self::$database->query($sql);
        } catch (\PDOException $error) {
         echo $error->getMessage();
        }

        $i=0;
        $tabMessages = [];
        
        while ($result = $query->fetch()) {
            $tabMessages[$i] = '<b>'.$result['firstname'].':</b> '.$result['message'];
            $this->setLastMessageId($result['messageId']);
            $i++;
        }
        return $tabMessages;
    }
    

    public function getAllMessages()
    {
        $sql = "SELECT messageId,message.message,user.firstname from message,user where user.id=message.user_id order by messageId  ASC";

        try {
            $query = self::$database->query($sql);
        } catch (\PDOException $error) {
         echo $error->getMessage();
        }

        $i=0;
        while ($result = $query->fetch()) {
            $tabMessages[$i] = '<b>'.$result['firstname'].':</b> '.$result['message'];
            $this->setLastMessageId($result['messageId']);
            $i++;
        }
        return $tabMessages;
    }
    
    public function getAllMessageAfterMessageId($id)
    {
        // SELECTION DES MESSAGES DEJA EN BASE
        $sql = "SELECT messageId,message.message,user.firstname from message,user where user.id=message.user_id and messageId>'{$id}' order by messageId ASC";

        try {
            $query = self::$database->query($sql);
        } catch (\PDOException $error) {
         echo $error->getMessage();
        }
        
        $tabMessages = "";
        
        while ($result = $query->fetch()) {
            $tabMessages .= '<p><b>'.$result['firstname'].':</b> '.$result['message'].'</p>';
            $this->setLastMessageId($result['messageId']);
        }
        
        return $tabMessages;
        
    }

    public function getLastMessage()
    {
        // SELECTION DU DERNIER MESSAGE
        $sql = "SELECT messageId,message.message,user.firstname from message,user where user.id=message.user_id order by messageId DESC";

        try {
            $query = self::$database->query($sql);
        } catch (\PDOException $error) {
         echo $error->getMessage();
        }
        
        $tabMessages = "";
        
            $result = $query->fetch();
            $tabMessages .= '<p><b>'.$result['firstname'].':</b> '.$result['message'].'</p>';
            $this->setLastMessageId($result['messageId']);
        
        return $tabMessages;
        
    }

    function __construct($database,$sessionStartDate) {
        
        $this->setSessionStartDate($sessionStartDate);
        $this->setDatabase($database);
        
    }

    
    
}
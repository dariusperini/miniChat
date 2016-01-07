<?php

class ChatMessage 
{
    private $strMessage;
    private $dateMessage;
    private $userId;
    
    protected static $database;
    
    
    function getMessage() {
        return $this->message;
    }

    function getDateMessage() {
        return $this->dateMessage;
    }

    function getUserId() {
        return $this->userId;
    }

    static function getDatabase() {
        return self::$database;
    }

        
    function setMessage($message) {
        $this->message = $message;
    }

    function setDateMessage($dateMessage) {
        $this->dateMessage = $dateMessage;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

   static function setDatabase($database) {
        self::$database = $database;
    }

     public function __construct($message,$userId,$database) 
    {
        $this->setUserId($userId);
        $this->setMessage($message);
        $this->setDatabase($database);
    }
    
    public function insertMessageInDatabase() 
    {
        $insert = 'INSERT INTO "message" ("user_id", "message") VALUES(:userId, :message);';
        $query = self::$database->prepare($insert);
        $query->bindValue(':userId', $this->getUserId());
        $query->bindValue(':message', urldecode($this->getMessage()));
        $query->execute();    
    }
 

}
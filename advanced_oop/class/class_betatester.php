<?php

class betatester extends DatabaseTable {

/**
* Contains the betatester the user has called.
* @var [objectified array]
*/
  private $player;

  public function __construct($mysqli) {
    $this->player = (object) array();
      $this->table = "willl__betatesters";
      parent::__construct($mysqli);
  }


    // Getters
      public function getId() {
        return $this->player->id;
      }
      public function getUsername() {
        return $this->player->username;
      }
      public function getEmail() {
        return $this->player->email;
      }



    // Setters
    public function setId($id) {
      $this->player->id = $id;
    }
    public function setUsername($usr) {
      $this->player->username = $usr;
    }
    public function setEmail($email) {
      $this->player->email = $email;
    }


      /**
      *  Retrieves a player from the database with a specific Username
      * @return boolean
      */
    public function getPlayerByUsername() {

      try {
      $this->player = $this->selectData(["id", "username", "email"], "username=".$this->player->username);
      }
      catch (Exception $e) {
        echo "An Error there was.<br>".
             "error code:".$e->getCode()."<br>".
             $e->getMessage();
      }

      // Because this function only has to get the first record we don't need multi dimmensional array:
      $this->player = (object) $this->player[0];
    }

    /**
    *  Retrieves a player from the database with a specific ID
    * @return boolean
    */
      public function getPlayerById() {
        try {
        $this->player = $this->selectData(["id", "username", "email"], "id=".$this->player->id);
        }
        catch (Exception $e) {
          echo "An Error there was.<br>".
               "error code:".$e->getCode()."<br>".
               $e->getMessage();
        }

        // Because this function only has to get the first record we don't need multi dimmensional array:
        $this->player = (object) $this->player[0];
      }

      /**
      *  Saves a record in the database.
      * @return boolean
      */
      public function save() {
        $goaround = array();
        foreach($this->player as $needed) {
          $goaround[] = '"'.$needed.'"';
        }
        try {
          $save = $this->insertData($goaround);
          if ($save) {
            return true;
          }
        }
        catch (Exception $e) {
          echo "An Error there was.<br>".
               "error code:".$e->getCode()."<br>".
               $e->getMessage();
        }
        return false;
      }
      /**
      *  Removes a record with a specific ID
      * @return boolean
      */
      public function delete() {
        try {
          $del = "id=".$this->player->id;
          $deletion = $this->removeData($del);
          if ($deletion) {
            echo "i have deleted the record";
          }
        }
        catch (Exception $e) {
          echo "An Error there was.<br>".
               "error code:".$e->getCode()."<br>".
               $e->getMessage();
        }
      }

      /**
      *  Updates a record with a specific ID
      * @return boolean
      */
     public function update() {
       try {

         $values = array("username" => $this->player->username, "email" => $this->player->email);

         $this->updateData($values, "id=".$this->player->id);
       }
       catch (Exception $e) {
         die("Could not retrieve data.".$e->getMessage());
       }
     }
}
 ?>

<?php

class Game extends DatabaseTable {

/**
* Contains the betatester the user has called.
* @var [objectified array]
*/
  private $game;

  public function __construct($mysqli) {
    $this->game = (object) array();
      $this->table = "willl__games";
      parent::__construct($mysqli);
  }


    // Getters
      public function getId() {
        return $this->game->id;
      }
      public function getTitle() {
        return $this->game->title;
      }
      public function getDescription() {
        return $this->game->description;
      }
      public function getMD5() {
        return $this->game->md5;
      }

    // Setters
    public function setId($id) {
      $this->game->id = $id;
    }
    public function setTitle($tit) {
      $this->game->title = $tit;
    }
    public function setDescription($desc) {
      $this->game->description = $desc;
    }
    public function setMD5($md5) {
      $this->game->md5 =  $md5;
    }


      /**
      *  Retrieves a game from the database with a specific Username
      * @return boolean
      */
    public function getGameByTitle() {
      try {
      $this->game = $this->selectData(["id", "title", "description", "md5"], "username=".$this->game->title);
      }
      catch (Exception $e) {
        echo "An Error there was.<br>".
             "error code:".$e->getCode()."<br>".
             $e->getMessage();
      }

      // Because this function only has to get the first record we don't need multi dimmensional array:
      $this->game = (object) $this->game[0];
    }

    /**
    *  Retrieves a game from the database with a specific ID
    * @return boolean
    */
      public function getGameById() {
        try {
          $this->game = $this->selectData(["id", "title", "description", "md5"], "id=".$this->game->id);
        }
        catch (Exception $e) {
          echo "An Error there was.<br>".
               "error code:".$e->getCode()."<br>".
               $e->getMessage();
        }

        // Because this function only has to get the first record we don't need multi dimmensional array:
        $this->game = (object) $this->game[0];
      }

      /**
      *  Saves a record in the database.
      * @return boolean
      */
      public function save() {
        $goaround = array();
        foreach($this->game as $needed) {
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
          $del = "id=".$this->game->id;
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

         $values = array("title" => $this->game->title, "description" => $this->game->description, "md5" => $this->game->md5);

         $this->updateData($values, "id=".$this->game->id);
       }
       catch (Exception $e) {
         die("Could not retrieve data.".$e->getMessage());
       }
     }
}
 ?>

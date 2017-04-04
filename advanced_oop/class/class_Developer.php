<?php
class Developer extends DatabaseTable {

/**
* Contains the betatester the user has called.
* @var [objectified array]
*/
  private $developer;

  public function __construct($mysqli) {
    $this->developer = (object) array();
      $this->table = "willl__developers";
      parent::__construct($mysqli);
  }


    // Getters
      public function getId() {
        return $this->developer->id;
      }
      public function getFirstName() {
        return $this->developer->first_name;
      }
      public function getLastName() {
        return $this->developer->last_name;
      }
      public function getEmail() {
        return $this->developer->email;
      }

    // Setters
    public function setId($id) {
      $this->developer->id = $id;
    }
    public function setFirstName($fn) {
      $this->developer->first_name = $fn;
    }
    public function setLastName($ln) {
      $this->developer->last_name = $ln;
    }
    public function setEmail($email) {
      $this->developer->email = $email;
    }


      /**
      *  Retrieves a developer from the database with a specific Username
      * @return boolean
      */
    public function getdeveloperByName() {
      try {
        $this->developer = $this->selectData(["id", "first_name", "last_name", "email"], "first_name=".$this->developer->first_name. "AND last_name =".$this->developer->last_name);
      }
      catch (Exception $e) {
        echo "An Error there was.<br>".
             "error code:".$e->getCode()."<br>".
             $e->getMessage();
      }

      // Because this function only has to get the first record we don't need multi dimmensional array:
      $this->developer = (object) $this->developer[0];
    }

    /**
    *  Retrieves a developer from the database with a specific ID
    * @return boolean
    */
      public function getdeveloperById() {
        try {
          $this->developer = $this->selectData(["id", "first_name", "last_name", "email"], "id=".$this->developer->id);
        }
        catch (Exception $e) {
          echo "An Error there was.<br>".
               "error code:".$e->getCode()."<br>".
               $e->getMessage();
        }

        // Because this function only has to get the first record we don't need multi dimmensional array:
        $this->developer = (object) $this->developer[0];
      }

      /**
      *  Saves a record in the database.
      * @return boolean
      */
      public function save() {
        $goaround = array();
        foreach($this->developer as $needed) {
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
          $del = "id=".$this->developer->id;
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

         $values = array("first_name" => $this->developer->first_name, "last_name" => $this->developer->last_name, "email" => $this->developer->email);

         $this->updateData($values, "id=".$this->developer->id);
       }
       catch (Exception $e) {
         die("Could not retrieve data.".$e->getMessage());
       }
     }
   }
?>

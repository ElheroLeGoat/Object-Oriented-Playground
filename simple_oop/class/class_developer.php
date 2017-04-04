<?php
/**
 * Class Name: Developers
 * Class Desc: This class controls the "wi2_developers" table from my database.
 *
 */

 class Developer {

// fillable
  private $developer;
// Database connection
  private $mysqli;

  public function __construct($mysqli) {
	$this->developer = (object) array();
    $this->mysqli = $mysqli;
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
  *  Retrieves a developer from the database with a specific Userusername
  * @return boolean
  */
public function getDeveloperByName() {
    if ($stmt = $this->mysqli->prepare("SELECT id, first_name, last_name, email FROM willl__developers WHERE first_name=? AND last_name=?")) {
      $stmt->bind_param("ss",$this->developer->first_name, $this->developer->last_name);
      $stmt->execute();
      $stmt->bind_result($id, $first_name, $last_name, $email);
      if ($stmt->fetch()) {
          $this->developer->id 	     	  = $id;
	        $this->developer->first_name 	= $first_name;
          $this->developer->last_bame   = $last_name;
          $this->developer->email 	  	= $email;
        }
      else {
        throw new exception("Could not find developer with name ".$this->developer->first_name." ".$this->developer->last_name."in database");
        $stmt->close();
        return false;
      }
      $stmt->close();
    }
  return true;
}
/**
*  Retrieves a developer from the database with a specific ID
* @return boolean
*/
  public function getDeveloperById() {
    if ($stmt = $this->mysqli->prepare("SELECT id, first_name, last_name, email FROM willl__developers WHERE id=?")) {
      $stmt->bind_param("i",$this->developer->id);
      $stmt->execute();
      $stmt->bind_result($id, $first_name, $last_name, $email);
      if ($stmt->fetch()) {
          $this->developer->id 	     	  = $id;
	        $this->developer->first_name 	= $first_name;
          $this->developer->last_bame   = $last_name;
          $this->developer->email 	  	= $email;
        }
      else {
        throw new exception("Could not find developer with id ".$this->developer->id." in database");
        $stmt->close();
        return false;
      }
      $stmt->close();
    }
  return true;
  }

  /**
  *  Saves a record in the database.
  * @return boolean
  */
  public function save() {
      if ($stmt = $this->mysqli->prepare("INSERT INTO willl__developers (first_name, last_name, email) VALUES (?,?,?)")) {
        $stmt->bind_param("sss", $this->developer->first_name, $this->developer->last_name, $this->developer->email);
        if ($stmt->execute()) {
        }
        else {
          throw new exception("Developer was not saved to database.");
          $stmt->close();
          return false;
        }
        $stmt->close();
      }
    return true;
  }

  /**
  *  Removes a record with a specific ID
  * @return boolean
  */
  public function delete() {
      if ($stmt = $this->mysqli->prepare("DELETE FROM willl_developers WHERE id=?")) {
        $stmt->bind_param("i", $this->developer->id);
        if ($stmt->execute()) {

        }
        else {
          throw new exception("Developer with id: ".$this->developer->id." was not deleted");
          $stmt->close();
          return false;
        }
        $stmt->close();
      }
      return true;
  }

   /**
   *  Updates a record with a specific ID
   * @return boolean
   */
  public function update() {
      if ($stmt = $this->mysqli->prepare("UPDATE willl_developers SET first_name=?, last_name=?, email=? WHERE id=?")) {
        $stmt->bind_param("sssi", $this->developer->first_name, $this->developer->last_name, $this->developer->email, $this->developer->id);
        if ($stmt->execute()) {

        }
        else {
          throw new exception("Could not update developer ".$this->developer->username);
          $stmt->close();
          return false;
        }
        $stmt->close();
      }
      return true;
  }
}
 ?>

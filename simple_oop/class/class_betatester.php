<?php
/**
 * Class Name: Players
 * Class Desc: This class controls the "wi2_players" table from my database.
 *
 */

 class Betatester {

// fillable
  private $player;
// Database connection
  private $mysqli;

  public function __construct($mysqli) {
	$this->player = (object) array();
    $this->mysqli = $mysqli;
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
  *  Retrieves a player from the database with a specific Userusername
  * @return boolean
  */
public function getPlayerByUsername() {
    if ($stmt = $this->mysqli->prepare("SELECT id, username, email FROM willl__players WHERE username=?")) {
      $stmt->bind_param("s",$this->player->username);
      $stmt->execute();
      $stmt->bind_result($id, $username, $email);
      if ($stmt->fetch()) {
          $this->player->id 	     	= $id;
	        $this->player->username 	= $username;
          $this->player->email 	  	= $email;
        }
      else {
        throw new exception("Could not find player with username ".$this->player->username." in database");
        $stmt->close();
        return false;
      }
      $stmt->close();
    }
  return true;
}
/**
*  Retrieves a player from the database with a specific ID
* @return boolean
*/
  public function getPlayerById() {
    if ($stmt = $this->mysqli->prepare("SELECT id, username, email FROM willl__betatesters WHERE id=?")) {
      $stmt->bind_param("i",$this->player->id);
      $stmt->execute();
      $stmt->bind_result($id, $username, $email);
      if ($stmt->fetch()) {
          $this->player->id 	     	= $id;
	        $this->player->username 	= $username;
          $this->player->email 	  	= $email;
        }
      else {
        throw new exception("Could not find player with id ".$this->player->id." in database");
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
      if ($stmt = $this->mysqli->prepare("INSERT INTO willl__players (username, email) VALUES (?,?)")) {
        $stmt->bind_param("ss", $this->player->username, $this->player->email);
        if ($stmt->execute()) {
        }
        else {
          throw new exception("Player was not saved to database.");
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
      if ($stmt = $this->mysqli->prepare("DELETE FROM willl_players WHERE id=?")) {
        $stmt->bind_param("i", $this->player->id);
        if ($stmt->execute()) {

        }
        else {
          throw new exception("Player with id: ".$this->player->id." was not deleted");
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
      if ($stmt = $this->mysqli->prepare("UPDATE willl_players SET username=?, email=? WHERE id=?")) {
        $stmt->bind_param("ssi", $this->player->username, $this->player->email, $this->player->id);
        if ($stmt->execute()) {

        }
        else {
          throw new exception("Could not update player ".$player->player->username);
          $stmt->close();
          return false;
        }
        $stmt->close();
      }
      return true;
  }
}
 ?>

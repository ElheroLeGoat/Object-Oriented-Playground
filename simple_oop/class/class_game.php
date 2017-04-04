<?php
/**
 * Class Name: Games
 * Class Desc: This class controls the "wi2_games" table from my database.
 *
 */

 class Game {

// fillable
  private $game;
// Database connection
  private $mysqli;

  public function __construct($mysqli) {
	   $this->game = (object) array();
     $this->mysqli = $mysqli;
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
  *  Retrieves a game from the database with a specific Userusername
  * @return boolean
  */
public function getGameByTitle() {
    if ($stmt = $this->mysqli->prepare("SELECT id, title, description, md5 FROM willl__games WHERE title=?")) {
      $stmt->bind_param("s",$this->game->title);
      $stmt->execute();
      $stmt->bind_result($id, $title, $description, $md5);
      if ($stmt->fetch()) {
          $this->game->id 	       	= $id;
	        $this->game->title 	  = $title;
          $this->game->description 	= $description;
          $this->game->md5          = $md5;
        }
      else {
        throw new exception("Could not find game with title ".$this->game->title." in database");
        $stmt->close();
        return false;
      }
      $stmt->close();
    }
  return true;
}
/**
*  Retrieves a game from the database with a specific ID
* @return boolean
*/
  public function getGameById() {
    if ($stmt = $this->mysqli->prepare("SELECT id, title, description, md5 FROM willl__games WHERE id=?")) {
      $stmt->bind_param("s",$this->game->id);
      $stmt->execute();
      $stmt->bind_result($id, $title, $description, $md5);
      if ($stmt->fetch()) {
          $this->game->id 	       	= $id;
	        $this->game->title 	      = $title;
          $this->game->description 	= $description;
          $this->game->md5          = $md5;
        }
      else {
        throw new exception("Could not find game with id ".$this->game->id." in database");
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
      if ($stmt = $this->mysqli->prepare("INSERT INTO willl__games (title, description, md5) VALUES (?,?,?)")) {
        $stmt->bind_param("sss", $this->game->title, $this->game->description, $this->game->md5);
        if ($stmt->execute()) {
        }
        else {
          throw new exception("Game was not saved to database.");
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
      if ($stmt = $this->mysqli->prepare("DELETE FROM willl__games WHERE id=?")) {
        $stmt->bind_param("i", $this->game->id);
        if ($stmt->execute()) {

        }
        else {
          throw new exception("Game with id: ".$this->game->id." was not deleted");
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
      if ($stmt = $this->mysqli->prepare("UPDATE willl_games SET title=?, description=?, md5=? WHERE id=?")) {
        $stmt->bind_param("sssi", $this->title, $this->description, $this->md5, $this->id);
        if ($stmt->execute()) {

        }
        else {
          throw new exception("Could not update game ".$this->game->title);
          $stmt->close();
          return false;
        }
        $stmt->close();
      }
      return true;
  }
}
 ?>

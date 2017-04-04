<?php

/**
 * A Superclass to manage database calls.
 *
 */

class DatabaseTable {
  /**
   * Holds the standard SQL sentences
   * @var [string]
   */
  private $sql;

  /**
   * Holds the mysqli object that's injected.
   * @var [object]
   */
   private $mysqli;

/**
 * holds the table that has to be modified.
 * @var [string]
 */
   protected $table;


/**
 * Assigns the needed information to the variables in the superclass.
 * @param [object] $mysqli [the injection of an mysqli object.]
 */
  public function __construct($mysqli) {

    $this->mysqli = $mysqli;

    if (!is_object($this->mysqli)) {
      throw new Exception("Database was not called.", 1);
    }
    else if ($this->mysqli->connect_errno) {
      throw new Exception("Database problems: ".$this->mysqli->connect_error, 2);
    }
  }

/**
 * Contains the SQL code for inserting data.
 * @param  [Array]    $values  [Contains the values that has to be inserted.]
 * @return [Boolean]           [If an error occur "the system throws an exception" the function will return false.]
 */
protected function insertData($values) {
  if (is_array($values)) {
    $useable_values = implode(",", $values);

    $this->sql = "INSERT INTO $this->table VALUES (null, $useable_values)";
    echo $this->sql;
    $this->mysqli->query($this->sql);
    print_r($this->mysqli);
    if ($this->mysqli->affected_rows <= 0) {
      throw new exception("Could not insert values, please check values and the table is correct.", 1011);
      return false;
    }
  }
  else {
    throw new exception("The values has to be an array in order for the system to make a insert statement.", 1001);
    return false;
  }
  return true;
}

/**
 * Selects data from the database and returns them as an multi dimmensional array.
 * @param   [Array]         $col      [contains the columns the system has to find in the database.]
 * @param   [string]        $clause   [a Where clause.]
 * @return  [boolean/array]           [Returns multidimmensional array on success and false on failure.]
 */
protected function SelectData($col, $clause = 1) {
  $returnVal = array();

  if (is_array($col)) {
    $useable_col = implode(",", $col);
    $this->sql = "SELECT $useable_col FROM $this->table WHERE $clause";

    $result = $this->mysqli->query($this->sql);

    if ($this->mysqli->affected_rows <= 0) {
      throw new exception("Could not Select rows, please check columns and the table is correct.", 1012);
      return false;
    }
    while ($row = $result->fetch_assoc()) {
      $returnVal[] = $row;
    }
  }
  else {
    throw new exception("The columns has to be an array in order for the system to make a SELECT statement.", 1002);
    return false;
  }
  return $returnVal;
}

/**
 * Updates a given row in the database.
 * @param   [assoc array]   $values   [An associative array with the column names and values like: COLUMN => VALUE]
 * @param   [String]        $clause   [The where clause set to check what rows to affect.]
 * @return  [Boolean]                 [If an error occur "the system throws an exception" and the function will return false.]
 */
protected function updateData($values, $clause){
if (is_array($values)) {
  $useable_values ="";
  foreach ($values as $key => $value) {
      $useable_values .= "$key = \"$value\", ";
  }
  $useable_values = trim($useable_values);
  $useable_values = trim($useable_values, ",");
  $this->sql = "UPDATE $this->table SET $useable_values WHERE $clause";
  $this->mysqli->query($this->sql);

  if ($this->mysqli->affected_rows <= 0) {
    throw new exception("Could not update row, make sure the array is associative with column => value and the table is correct.", 1013);
    return false;
  }
}
else {
  throw new exception("The values has to be an array in order for the system to make a update statement.", 1003);
  return false;
}
return true;
}

/**
 * Updates a given row in the database.
 * @param   [String]        $clause   [The where clause set to check what rows to affect.]
 * @return  [Boolean]                 [If an error occur "the system throws an exception" and the function will return false.]
 */
protected function removeData($clause) {
  $this->sql = "DELETE FROM $this->table WHERE $clause";
  $this->mysqli->query($this->sql);
    if ($this->mysqli->affected_rows < 0) {
      throw new exception("Record was not deleted.");
      return false;
    }
    return true;
}


}?>

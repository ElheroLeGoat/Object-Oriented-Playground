<?php
class Calculator {

  private $calculation_piece;

  private $t1;

  private $t2;

  /**
   * Checks if a number is a prime
   * @param  [int] $val  [The value that has to be checked.]
   * @param  [int] $ceil [The square root of the value.]
   * @return [Boolean]
   */
  private function prime($val, $ceil) {
      if ($val == 2) {
          return true;
      }
      if ($val == 1 || $val % 2 == 0) {
          return false;
      }
      for ($i = 3; $i <= $ceil; $i = $i + 2) {
          if($val % $i == 0) {
              return false;
          }
      }
      return true;
  }
  /**
   * Get Next Prime in the order
   * @param  [int] $val [The start value for checking for prime]
   * @return [int] $val [Returns the prime]
   */
  public function nextPrime($val) {
    $i = 0;
    while ($i <= 100) {
        $ceil = ceil(sqrt($val));
        if ($this->prime($val, $ceil)) {
          break;
        }
        $i++;
        $val++;
    }
    return $val;
}
/**
 * Get previus Prime in the order
 * @param  [int] $val [The start value for checking for prime]
 * @return [int] $val [Returns the prime]
 */
public function prevPrime($val) {
  $i = 0;
  while ($i <= 100) {
      $ceil = ceil(sqrt($val));
      if ($this->prime($val, $ceil)) {
        break;
      }
      $i++;
      $val--;
  }
  return $val;
}



}

$calc = new Calculator();

echo "næste primtal er: " . $calc->nextPrime(1234223);
echo "Forrige primtal er: ". $calc->prevPrime(1234123123523465);


?>

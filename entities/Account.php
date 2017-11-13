
<?php


/**
 * Account
 */
class Account{

  protected $_id;
  protected $_name;
  protected $_sold;


  public function __construct(array $donnees){
    $this->hydrate($donnees);
    $this->_type = strtolower(static::class);
  }

  public function hydrate(array $donnees){
    foreach ($donnees as $key => $value){
      $method = 'set'.ucfirst($key);
      if (method_exists($this, $method)){
        $this->$method($value);
      }
    }
  }

  /*
  ** Getter
  */
  public function id() { return $this->_id; }
  public function name() { return $this->_name; }
  public function sold() { return $this->_sold; }


  /*
  ** Setter
  */
  public function setId(int $id){
    $this->_id = (int) $id;
  }
  public function setName(string $name){
    if (is_string($name) && strlen($name) <= 20){
      $this->_name = $name;
    }
  }
  public function setsold(int $sold){
    $this->_sold = (int) $sold;
  }

  // Add money methode
  public function addMoney(int $amount){
    if (($this->_sold + $amount) <= 1000) {
      $this->_sold += $amount;
      return "Success";
    }
    else {
      return "enought money (max :1000)";
    }
  }

  // Output money methode
  public function outputMoney(int $amount){
    if (($this->_sold - $amount) >= -20) {
      $this->_sold -= $amount;
      return "Success";
    }
    else {
      return "not enought money (max : -20)";
    }
  }


}
 ?>

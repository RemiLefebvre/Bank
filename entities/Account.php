
<?php


/**
 * Account
 */
class Account{

  protected $_id;
  protected $_name;
  protected $_solde;


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
  public function solde() { return $this->_solde; }


  /*
  ** Setter
  */
  public function setId(int $id){
    $this->_id = (int) $id;
  }
  public function setName($name){
    if (is_string($name) && strlen($name) <= 20){
      $this->_name = $name;
    }
  }
  public function setSolde(int $solde){
    $this->_solde = (int) $solde;
  }

  public function addMoney(int $amount){
    if (($this->_solde + $amount) <= 1000) {
      $this->_solde += $amount;
    }
    else {
      return "enought money";
    }
  }

  public function outputMoney(int $amount){
    if (($this->_solde - $amount) >= -20) {
      $this->_solde -= $amount;
    }
    else {
      return "not enought money";
    }
  }


}
 ?>

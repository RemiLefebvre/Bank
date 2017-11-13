
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
  public function setId($id){
    $this->_id = (int) $id;
  }
  public function setName($name){
    if (is_string($name) && strlen($name) <= 20){
      $this->_name = $name;
    }
  }
  public function setSolde($solde){
    $this->_solde = (int) $solde;
  }
}
 ?>

<?php

require("phpmyadmin.php");

/*
**Manager of Account class
*/
class AccountManager{
  private $_db; // Instance de PDO

  /*
  **DDB
  */
  public function __construct($db){
    $this->setDb($db);
  }
  /*
  **Setter
  */
  public function setDb(PDO $db){
    $this->_db = $db;
  }

  /*
  **Add account
  */
  public function add(Account $account){
    $q = $this->_db->prepare('INSERT INTO accounts(name) VALUES(:name)');
    $q->execute(array(
      'name'=>$account->name()
    ));
  }

  /*
  **Delete account in DBB
  */
  public function delete(int $id){
    if (is_int($id)){
      $this->_db->query('DELETE FROM accounts WHERE id = '.$id);
    }
  }

  /*
  **Get account
  */
  public function get($info){
    $q = $this->_db->query('SELECT id, sold FROM accounts WHERE id ='.$info);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    $account = new Account(["id" => $donnees['id'],"sold" => $donnees['sold']]);

    return $account;
  }

  /*
  **Get list of accounts
  */
  public function getList(){
    $listAccounts = [];

    $q = $this->_db->query('SELECT id, name, sold FROM accounts');
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC)){
      $listAccounts[] = new Account(["id" => $donnees['id'],"name" => $donnees['name'],"sold" => $donnees['sold']]);
    }
    return $listAccounts;
  }

  /*
  **Update account
  */
  public function update(Account $account){
    $q = $this->_db->prepare('UPDATE accounts SET sold = :sold WHERE id = :id');
    $q->execute(array(
      'id'=>$account->id(),
      'sold'=>$account->sold(),
    ));
    return true;
  }

  /*
  **Existe account
  */
  public function existe(Account $account){
    $q = $this->_db->prepare('SELECT * FROM accounts WHERE name = :name');

    $q->execute(array(
      'name'=>$account->name()
    ));

    $q=$q->fetch(PDO::FETCH_ASSOC);
    if ($q) {
      return true;
    }
    else {
      return false;
    }
  }

  /*
  **list Id accounts
  */
  public function listIdAccounts(){

    $listIdAccounts = [];
    $q = $this->_db->query('SELECT id FROM accounts');
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC)){
      $listIdAccounts[] = $donnees['id'];
    }
    return $listIdAccounts;
  }
}
 ?>

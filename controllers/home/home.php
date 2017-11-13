<?php
require("entities/Account.php");
require("model/manager.php");
require("services/XSS.php");



/*
**Create Account manager
*/
$manager = new AccountManager($db);


/*
**Add account
*/
if (isset($_POST['addAccount']) AND isset($_POST['name'])) {
  if (!empty($_POST['name'])) {
    // Security XSS
    $name=htmlspecialchars($_POST['name']);
    $addAccount= new Account(['name'=>$name]);
    $manager->add($addAccount);
  }
  // if input empty
    // if input empty
  else {
    $message="input empty";
  }
}

/*
**Supp account
*/
if (isset($_POST['suppAccount'])) {
  $id=sercureXSS($_POST['id']);
  $manager->delete($id);
}

/*
**Output money
*/
if (isset($_POST['outputMoney']) AND isset($_POST['amountOutput']) AND isset($_POST['solde'])) {
  if (!empty($_POST['amountOutput']) AND !empty($_POST['solde'])){
    // Security XSS
    $id=sercureXSS($_POST['id']);
    $amount=sercureXSS($_POST['amountOutput']);
    $solde=sercureXSS($_POST['solde']);
    $solde-=$amount;
    $outputMoneyAccount=new account(['solde'=>$solde,'id'=>$id]);
    $manager->update($outputMoneyAccount);
  }
    // if input empty
  else {
    $message="input empty";
  }
}

/*
**Add money
*/
if (isset($_POST['addMoney']) AND isset($_POST['amountAdd']) AND isset($_POST['solde']) AND isset($_POST['id'])) {
  if (!empty($_POST['amountAdd'])){
    // Security XSS
    $id=sercureXSS($_POST['id']);
    $amount=sercureXSS($_POST['amountAdd']);
    $solde=sercureXSS($_POST['solde']);
    // $solde+=$amount;

    // creation object addMoneyAccount
    $addMoneyAccount=new account(['solde'=>$solde,'id'=>$id]);

    // Adding money methode
    $addMoneyAccount->addMoney($amount);

    // update on DDB
    $manager->update($addMoneyAccount);
  }
    // if input empty
  else {
    $message="input empty";
  }
}



/*
**Transfert money
*/
if (isset($_POST['transfertMoney']) && isset($_POST['amountTransfert']) && isset($_POST['id']) && isset($_POST['idAddMoneyAccount']) && isset($_POST['solde'])){
  if (!empty($_POST['transfertMoney']) && !empty($_POST['amountTransfert']) && !empty($_POST['id']) && !empty($_POST['idAddMoneyAccount']) && !empty($_POST['solde'])){
    // Security XSS
    $idAddMoneyAccount=sercureXSS($_POST['idAddMoneyAccount']);
    $idOutputMoneyAccount=sercureXSS($_POST['id']);
    $soldeOutputMoneyAccount=sercureXSS($_POST['solde']);
    $amount=sercureXSS($_POST['amountTransfert']);

    // Ouput money on account
    $soldeOutputMoneyAccount-=$amount;
    $outputMoneyAccount=new account(['solde'=>$soldeOutputMoneyAccount,'id'=>$idOutputMoneyAccount]);
    $validator=$manager->update($outputMoneyAccount);

    // if ouput money its ok
    if ($validator) {
      // Add money on account
      $addMoneyAccount = $manager->get($idAddMoneyAccount);
      $soldeAddMoneyAccount=$addMoneyAccount->solde();
      // add solde
      $soldeAddMoneyAccount+=$amount;
      $addMoneyAccount->setSolde($soldeAddMoneyAccount);
      $manager->update($addMoneyAccount);
    }
  }
    // if input empty
  else {
    $message="input empty";
  }
}

/*
**List of accounts
*/
$accounts= $manager->getList();


/*
**List of id accounts
*/
$listIdAccounts= $manager->listIdAccounts();

include_once("view/homeView.php")

 ?>

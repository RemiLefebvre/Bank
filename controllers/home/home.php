<?php
require("entities/Account.php");
require("model/manager.php");



/*
**Create Véhicule manager
*/
$manager = new AccountManager($db);


/*
**Add account
*/
if (isset($_POST['addAccount']) AND isset($_POST['name'])) {
  if (!empty($_POST['name'])) {
    $name=htmlspecialchars($_POST['name']);
    $addAccount= new Account(['name'=>$name]);
    $manager->add($addAccount);
  }
  else {
    $message="input empty";
  }
}

/*
**Supp account
*/
if (isset($_POST['suppAccount'])) {
  $id=htmlspecialchars($_POST['id']);
  $manager->delete($id);
}

/*
**Output money
*/
if (isset($_POST['outputMoney']) AND isset($_POST['amountOutput']) AND isset($_POST['solde'])) {
  if (!empty($_POST['amountOutput']) AND !empty($_POST['solde'])){
    $id=intval(htmlspecialchars($_POST['id']));
    $amount=intval(htmlspecialchars($_POST['amountOutput']));
    $solde=intval(htmlspecialchars($_POST['solde']));
    $solde-=$amount;
    $outputMoneyAccount=new account(['solde'=>$solde,'id'=>$id]);
    $manager->update($outputMoneyAccount);
  }
  else {
    $message="input empty";
  }
}

/*
**Add money
*/
if (isset($_POST['addMoney']) AND isset($_POST['amountAdd']) AND isset($_POST['solde']) AND isset($_POST['id'])) {
  if (!empty($_POST['amountAdd'])){
    $id=intval(htmlspecialchars($_POST['id']));
    $amount=intval(htmlspecialchars($_POST['amountAdd']));
    $solde=intval(htmlspecialchars($_POST['solde']));
    $solde+=$amount;
    $addMoneyAccount=new account(['solde'=>$solde,'id'=>$id]);

    $manager->update($addMoneyAccount);
  }
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
    $idAddMoneyAccount=intval(htmlspecialchars($_POST['idAddMoneyAccount']));
    $idOutputMoneyAccount=intval(htmlspecialchars($_POST['id']));
    $soldeOutputMoneyAccount=intval(htmlspecialchars($_POST['solde']));
    $amount=intval(htmlspecialchars($_POST['amountTransfert']));

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
  else {
    $message="input empty";
  }
}

/*
**List of accounts
*/
$accounts= $manager->getList();


/*
**Number of accounts
*/
$listIdAccounts= $manager->count();

include_once("view/homeView.php")

 ?>

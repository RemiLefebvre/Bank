<?php include_once("view/template/header.php") ?>



<main class="mt-5 container card">
  <?php if (isset($message)) {
    echo $message;
  } ?>
  <form class="mb-5" action="index.php" method="post">
    <h3>Add account:</h3>
    <input type="text" name="name" placeholder="Name">
    <input type="submit" name="addAccount" value="Ok">
  </form>

  <hr>
  <hr>

  <div class="mt-4 accounts">
    <div class="d-flex">
      <h5 class="w-25"><strong>ID</strong></h5>
      <h5 class="w-25"><strong>Name</strong></h5>
      <h5 class="w-25"><strong>sold</strong></h5>
      <h5 class="w-25"><strong>Options</strong></h5>
    </div>

    <?php
      foreach ($accounts as $account) {
        ?>
        <div class="account">
          <div class="d-flex infos">
            <h5 class="w-25"><?php echo $account->id() ?></h5>
            <h5 class="w-25"><?php echo $account->name() ?></h5>
            <h5 class="w-25"><?php echo $account->sold() ?></h5>
            <h5 class="w-25"><button type="button" name="button">USE</button></h5>
          </div>
          <form class="options" action="index.php" method="post">
            <input type="hidden" name="sold" value="<?php echo $account->sold()?>">
            <input type="hidden" name="id" value="<?php echo $account->id()?>">
            <div class="row">
              <div class="option col-md-4 col-sm-12">
                <h4 class="">Add money</h4>
                <input class="w-75" type="text" name="amountAdd" placeholder="€">
                <input type="submit" name="addMoney" value="Ok">
              </div>

              <div class="option col-md-4 col-sm-12">
                <h4 class="">Output money</h4>
                <input class="w-75" type="text" name="amountOutput" placeholder="€">
                <input type="submit" name="outputMoney" value="Ok">
              </div>

              <div class="option col-md-4 col-sm-12">
                <h4 class="">Transfert money</h4>
                <input class="w-75" type="text" name="amountTransfert" placeholder="€"><br>
                <label for="">Transfert to ID:</label>
                <select class="" name="idAddMoneyAccount">
                  <option value="">--</option>
                  <?php for ($i=0; $i < count($listIdAccounts); $i++) {
                    ?>
                    <option value="<?php echo $listIdAccounts[$i] ?>"><?php echo $listIdAccounts[$i] ?></option>
                    <?php
                  } ?>
                </select>
                <input type="submit" name="transfertMoney" value="Ok">
              </div>
              <br>
              <button class="btn btn-danger" type="submit" name="suppAccount">Delete account</button>

            </div>
          </form>
        </div>
        <?php
      }
      ?>
  </div>
</main>



<?php include_once("view/template/footer.php") ?>

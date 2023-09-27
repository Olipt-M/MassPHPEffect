<?php
  require ("classes/Character.php");
  $data = array("headerTitle" => "Mass PHP Effect - Fight !");
  $characters = json_decode(file_get_contents("characters.json"));
  // echo '<pre style="color: white;">', var_dump($characters), '<pre>';
  
  if (isset($_GET["player"])) {
    $idPlayer = $_GET["player"];
    foreach ($characters as $character) {
      if ($character->id == $idPlayer) {
        $player = new Character($character->id, $character->name, $character->puissance, $character->attacks, $character->type);
      }
    }
  }
  // echo '<pre style="color: white;">', var_dump($player), '<pre>';
  
  if (isset($_GET["opponent"])) {
    $idOpponent = $_GET["opponent"];
    foreach ($characters as $character) {
      if ($character->id == $idOpponent) {
        $opponent = new Character($character->id, $character->name, $character->puissance, $character->attacks, $character->type);
      }
    }
  }
  // echo '<pre style="color: white;">', var_dump($opponent), '<pre>';

  include("templates/header.php");
?>

<main>
  <h1>Fight !</h1>
  <section class="fight-container">
    <div class="fighter-container">
      <img src="img/characters/<?= $player->getID() ?>.webp" alt="<?= $player->getName() ?>">

      <div class="fighter-details">
        <img src="
          <?php if ($player->getType() == "moissonneur") { ?>
            img/moissonneur.webp" alt=" <?= $player->getType() ?>
          <?php } else { ?>
            img/normandy.jpg" alt=" <?= $player->getType() ?>
          <?php } ?>
        ">
        <p><?= $player->getPuissance() ?></p>
        <progress max="100" value="100"></progress>
      </div>
    </div>

    <div class="fight-comments">
      <h2>vs</h2>

    </div>

    <div class="fighter-container">
      <img src="img/characters/<?= $opponent->getID() ?>.webp" alt="<?= $opponent->getName() ?>">

      <div class="fighter-details">
        <img src="
          <?php if ($opponent->getType() == "moissonneur") { ?>
            img/moissonneur.webp" alt=" <?= $opponent->getType() ?>
          <?php } else { ?>
            img/normandy.jpg" alt=" <?= $opponent->getType() ?>
          <?php } ?>
        ">
        <p><?= $opponent->getPuissance() ?></p>
        <progress max="100" value="100"></progress>
      </div>
    </div>
  </section>

  <section class="attacks-container">
    <h2>Attacks</h2>
    <ul>
      <?php foreach ($player->getAttacksList() as $attack) { ?>
        <li><?= $attack ?></li>
      <?php { ?>
    </ul>
  </section>
</main>

<?php include("templates/footer.php"); ?>
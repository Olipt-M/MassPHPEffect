<?php
  require ("classes/Character.php");
  $data = array("headerTitle" => "Mass PHP Effect - Combat !");

  session_start();

  $characters = json_decode(file_get_contents("characters.json"));
  // echo '<pre style="color: white;">', var_dump($characters), '<pre>';
  
  if (isset($_GET["player"])) {
    // First round of combat
    $displayComments = false;

    $idPlayer = $_GET["player"];
    foreach ($characters as $character) {
      if ($character->id == $idPlayer) {
        $player = new Character($character->id, $character->name, $character->puissance, $character->attacks, $character->type);
      }
    }

    $idOpponent = $characters[rand(0, count($characters) - 1)]->id;
    foreach ($characters as $character) {
      if ($character->id == $idOpponent) {
        $opponent = new Character($character->id, $character->name, $character->puissance, $character->attacks, $character->type);
      }
    }
    // echo '<pre style="color: white;">', var_dump($player), '<pre>';
    // echo '<pre style="color: white;">', var_dump($opponent), '<pre>';

    $_SESSION["fighters"] = ["player" => $player, "opponent" => $opponent];
    // echo '<pre style="color: white;">', var_dump($_SESSION["fighters"]), '<pre>';
  }
  else {
    // Rest of the rounds of combat
    if (isset($_SESSION["fighters"])) {
      $displayComments = true;
      
      // echo '<pre style="color: white;">', var_dump($_SESSION["fighters"]), '<pre>';
      $player = $_SESSION["fighters"]["player"];
      $opponent = $_SESSION["fighters"]["opponent"];

      // Inflicting attacks and damages
      $playerDealtAttackIndex = $_GET["attack"];
      $playerDealtAttackName = $player->getAttacksList()[$playerDealtAttackIndex]->name;
      $playerDealtAttackDamage = round($player->getAttacksList()[$playerDealtAttackIndex]->damage * $player->getPuissance() / 100);
      $opponent->setHealth($playerDealtAttackDamage);

      if ($opponent->getHealth() <= 0) {
        $playerWins = true;
        $_SESSION["endOfFight"] = ["playerWins" => $playerWins];
        header("Location: fightEnd.php");
      }

      $opponentDealtAttackIndex = rand(0, count($opponent->getAttacksList()) - 1);
      $opponentDealtAttackName = $opponent->getAttacksList()[$opponentDealtAttackIndex]->name;
      $opponentDealtAttackDamage = round($opponent->getAttacksList()[$opponentDealtAttackIndex]->damage * $opponent->getPuissance() / 100);

      $player->setHealth($opponentDealtAttackDamage);
      if ($player->getHealth() <= 0) {
        $playerWins = false;
        $_SESSION["endOfFight"] = ["playerWins" => $playerWins];
        header("Location: fightEnd.php");
      }

      $_SESSION["fighters"] = ["player" => $player, "opponent" => $opponent];
    }
  }

  include("templates/header.php");
?>

<main>
  <h1>Le combat a commencé !</h1>
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
        <progress max="100" value="<?= $player->getHealth(); ?>"></progress>
      </div>
    </div>

    <div class="fight-comments">
      <h2>vs</h2>

      <?php if ($displayComments) { ?>
        <p><?= $player->getName() ?> réalise l'attaque <?= $playerDealtAttackName ?>.</p>
        <p><?= $opponent->getName() ?> reçoit <?= $playerDealtAttackDamage ?> dégâts.</p>
        <p><?= $opponent->getName() ?> réalise l'attaque <?= $opponentDealtAttackName ?>.</p>
        <p><?= $player->getName() ?> reçoit <?= $opponentDealtAttackDamage ?> dégâts.</p>
      <?php } ?>
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
        <progress max="100" value="<?= $opponent->getHealth(); ?>"></progress>
      </div>
    </div>
  </section>

  <section class="attacks-container">
    <h2>Attaques :</h2>
    <ul id="player-attacks">
      <?php
      $attacks = $player->getAttacksList();
      $j = 0;
      foreach ($attacks as $attack) { ?>
        <li><a href="fight.php?attack=<?= $j ?>"><?= $attack->name; ?></a></li>
        <?php 
        $j++;
      }
      ?>
    </ul>
  </section>
</main>

<?php include("templates/footer.php"); ?>
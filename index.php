<?php
  $data = array("headerTitle" => "Mass PHP Effect");
  $characters = json_decode(file_get_contents("characters.json"));
  // echo '<pre style="color: white;">', var_dump($characters), '<pre>';
  include("templates/header.php");
?>

<!-- ATTENTION : remettre les id comm ils étainent, pour le gérer ensuite dans mon count / ids = 1, 3,... Il n'y a pas de 2 -->
<main>
  <h1>Select your character</h1>
  <section class="character-list">
    <?php foreach($characters as $character) { ?>
      <a class="character-selecter" href="fight.php?player=<?= $character->id ?>&opponent=<?= rand(1, count($characters)) ?>">
        <img src="img/characters/<?= $character->id ?>.webp" alt="<?= $character->name ?>">

        <div class="character-details">
          <img src="
            <?php if ($character->type == "moissonneur") { ?>
              img/moissonneur.webp" alt=" <?= $character->type ?>
            <?php } else { ?>
              img/normandy.jpg" alt=" <?= $character->type ?>
            <?php } ?>
          ">
          <p><?= $character->puissance ?></p>
        </div>
      </a>
    <?php } ?>
  </section>
</main>

<?php include("templates/footer.php"); ?>
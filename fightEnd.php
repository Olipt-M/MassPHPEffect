<?php
  $data = array("headerTitle" => "Mass PHP Effect - Fin du combat");

  session_start();

  if (isset($_SESSION["endOfFight"])) {
    $playerWins = $_SESSION["endOfFight"]["playerWins"];
  }

  include("templates/header.php");
?>

<!-- ATTENTION : remettre les id comm ils étainent, pour le gérer ensuite dans mon count / ids = 1, 3,... Il n'y a pas de 2 -->
<main>
  <?php if ($playerWins) { ?>
    <h1>Vous avez gagné !</h1>
  <?php } else { ?>
    <h1>Vous avez perdu !</h1>
  <?php } ?>

  <section class="game-end-container">
  <?php if ($playerWins) { ?>
    <p>Beau combat, mais il vous reste encore des défis à relever !</p>
  <?php } else { ?>
    <p>Dommage, mais vous pouvez retenter votre chance !</p>
  <?php } ?>
  <a href="index.php">Rejouer</a>
  </section>
</main>

<?php include("templates/footer.php"); ?>
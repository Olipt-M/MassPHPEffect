<?php
  $characters = json_decode(file_get_contents("characters.json"));
  // echo '<pre style="color: white;">', var_dump($characters), '<pre>';
  
  $data = array("headerTitle" => "Mass PHP Effect");
  include("templates/header.php");
?>

<main>
  <h1>Choix du personnage</h1>
  <section class="character-list">
    
  </section>
</main>

<?php include("templates/footer.php"); ?>
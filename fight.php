<?php
  $characters = json_decode(file_get_contents("characters.json"));
  // echo '<pre style="color: white;">', var_dump($characters), '<pre>';
  
  $data = array("headerTitle" => "Mass PHP Effect - Fight !");
  include("templates/header.php");
?>

<main>
  <h1>Fight !</h1>
  <section class="fight-container"></section>
</main>

<?php include("templates/footer.php"); ?>
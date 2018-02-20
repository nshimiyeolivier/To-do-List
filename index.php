<?php
/* Récupération du contenu du fichier .json */
$file = file_get_contents("todo2.json");
$myObj = json_decode($file, true);

// AJOUT TACHE
if ( (isset($_POST["tache"])) && (isset($_POST["submit-ajout"])) && (!empty($_POST["tache"])) ){
  $tacheAjout = htmlspecialchars($_POST["tache"]);
$myObj['aFaire'][] = $tacheAjout;
  $finalAjout = json_encode($myObj);
  file_put_contents('todo2.json', $finalAjout);
}


//TACHE EFFECTUE
if (isset($_POST["submit-modif"])){
  $i = 0;
  foreach ($myObj["aFaire"] as $value) {
   if (isset($_POST[$i])){
     $myObj["archive"][] = $myObj['aFaire'][$i];
     unset($myObj["aFaire"][$i]);
     // var_dump ($listTable);
   }
   $i++;
  }
  $myObj["aFaire"] = array_values($myObj["aFaire"]);
}

// exporte le tableau php en json
  $finalAjout = json_encode($myObj);
  file_put_contents('todo2.json', $finalAjout);

?>

<?php
/* Récupération du contenu du fichier .json */
$file = file_get_contents("todo2.json");
$myObj = json_decode($file, true);

// UNE FONCTION POUR VIDER LE TABLEAU
if (isset($_POST["reinitialiser"])){
  $myObj['archive'] =array();
}

$finalAjout = json_encode($myObj);
file_put_contents('todo2.json', $finalAjout);

// CACHER LE BOUTON ENREGISTRER QUAND IL N Y A PLUS DE TACHE
if(count($myObj['aFaire']) > 0){
  $bouton_submit = "bouton_submit";
} else {
  $bouton_submit= "bouton_submit1";
}

// print_r($myObj['archive']);
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">

    <script
      src="http://code.jquery.com/jquery-2.2.4.js"
      integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
      crossorigin="anonymous"></script>
    <title>PHP / To-do list</title>
  </head>
  <body>
    <header>
      <h2>Liste des taches, youpeee ;-)</h2>
    </header>

    <!-- LECTURE JSON DES TACHES A FAIRE -->
    <div class="row">
      <div class="col_75">
        <form name="form-modif" method="post" action="">

            <h5> A FAIRE:</h5>
             <div class="afaire">
               <?php
                    $i = 0;
                    foreach ($myObj["aFaire"] as $value) {
                    ?>
                     <label> <input name=<?php echo $i; ?> type="checkbox" class="checkboxes"> <?php echo $value ?> <br /> </label>
                    <?php
                    $i++;
                    }
                ?>
              </div>


          <input type="submit" name="submit-modif" class="<?php echo $bouton_submit?>" value="Enregistre"/>

          <!--AFFICHE ARCHIVE  -->
          <h5> ARCHIVE:</h5>
        <div class="done">
          <span class="archived">
           <?php
                foreach ($myObj["archive"] as $value) {
            ?>
              <input type="checkbox" checked="checked" disabled="disabled" class="archived"> <?php echo $value ?> <br>
            <?php
                }
            ?>
          </span>
          <br />

          <input type="submit" name="reinitialiser" class="reinitialiser" value="! REINITIALISER"/>
      </div>
        </form>
      </div>
    </div>
    <!-- FORMULAIRE D'AJOUT DE TACHE -->
    <div class="row">
      <div class="col_75">
        <form name="form-ajout" method="post" action="">
          Ajouter une tache: <br/>
          <input type="text" name="tache" class="fillcase" size="30"/>
          <input type="submit" name="submit-ajout" class="bouton_submit" value="Ajouter"/>
        </form>
        <br />
        <br />

      </div>
    </div>
    <!-- LECTURE JSON DES TACHES ARCHIVEES -->
    <div class="row">
      <div class="col_75">
        <p></p>
      </div>
    </div>
    <div class="row">
      <div class="col_75">
        <div>
          <p><a href="https://github.com/becodeorg/Swartz-promo-3/tree/master/Projects/Todolist" target="_blank">Consigne</a>
          </p>
          <p><a href="https://github.com/becodeorg/Swartz-promo-3/blob/master/Parcours/06-PHP/php-formulaires.md" target="_blank">Formulaire: Sanitisation et Validation</a>
          </p>
          <p><a href="https://github.com/becodeorg/Swartz-promo-3/blob/master/Parcours/06-PHP/Manipulation_fichier_php.md" target="_blank">Manipulation de fichiers</a>
          </p>
        </div>
      </div>
    </div>
    <div class="row">
    </div>

<!-- TEST -->
    <div class="item">
      <a href="https://tutorialzine.com/?p=<?php echo $t['id']?>">
          <img src="https://tutorialzine.com/misc/featured/<?php echo $t['id']?>.jpg" title="<?php echo $t['title']?>" alt="<?php echo $t['title']?>" width="620" height="340" />
        </a>
        <div class="delete"></div>
    </div>

<!--TEST  -->
    <footer>
      <h2>Olivier & Jean Luc :D, BeCode.org</h2>
    </footer>


  <script>
        $('input[type=checkbox]').change(function(){
      if($(this).prop('checked')){
      $(this).parent().css('color', '#575859');
      }else{
      $(this).parent().css('color', 'black');
      }
      });
</script>
<script src="js/script.js"></script>
  </body>
</html>

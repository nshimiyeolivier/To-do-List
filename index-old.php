<?php
// LECTURE JSON DES TACHES A FAIRE
function lectureAfaireJSON(){ 
  $file = file_get_contents("todo-old.json");
  $arrayAFairePHP = json_decode($file, true);
  $i = 0;
  foreach ($arrayAFairePHP as $aFaire){
    $aFaireExplode = explode("AFAIRE:", $aFaire);
    if (stripos($aFaire, 'AFAIRE:') !== false){
      echo '<input id="'.$i.'" name="'.$i.'" type="checkbox" />'.$aFaireExplode[1]."<br>";
    }
    $i++;
  }
}
// LECTURE JSON DES TACHES ARCHIVEES
function lectureArchiveJSON(){ 
  $file = file_get_contents("todo-old.json");
  $arrayArchivePHP = json_decode($file, true);
  $i = 0;
  echo "<p>";
  foreach ($arrayArchivePHP as $archive){
    $archiveExplode = explode("ARCHIVE:", $archive);
    if (stripos($archive, 'ARCHIVE:') !== false){
      echo '<input id="'.$i.'" type="checkbox" checked="checked"  disabled="disabled" /><span class="texte-archive">'.$archiveExplode[1]."</span><br>";
    }
    $i++;
  }
  echo "</p>";
}
// AJOUT DANS JSON
if( (isset($_POST["submit-ajout"])) && (isset($_POST["tache"])) && (!empty($_POST["tache"])) ) {
  $tacheAjout = htmlspecialchars($_POST["tache"]);
  $file = file_get_contents('todo-old.json');  
  $arrayAjoutPHP = json_decode($file, true); 
  $arrayAjoutPHP[] = "AFAIRE:".$tacheAjout;  
  $finalAjout = json_encode($arrayAjoutPHP);  
  file_put_contents('todo-old.json', $finalAjout);
}
// MODIFICATION DANS JSON
if( (isset($_POST["submit-modif"])) ) {
  $file = file_get_contents('todo-old.json');  
  $arrayModifPHP = json_decode($file, true); 
  $i = 0;
  foreach ($arrayModifPHP as $modif){
    if (stripos($modif, 'AFAIRE:') !== false){
      $modifExplode = explode("AFAIRE:", $modif);
      if (isset($_POST[$i])) {
        $arrayModifPHP[$i] = "ARCHIVE:".$modifExplode[1];  
      }
    }
    $i++;
  }  
  $finalModif = json_encode($arrayModifPHP);  
  file_put_contents('todo-old.json', $finalModif);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>PHP / To-do list, Ancienne version</title>
  </head>
  <body>
    <header>
      <h2>Liste des tâches, youpeee ;-)</h2>
    </header>
    <!-- LECTURE JSON DES TACHES A FAIRE -->
    <div class="row">
      <div class="col_75">
        <form name="form-modif" method="post" action="">
          <p><?php lectureAfaireJSON(); ?></p>
          <input type="submit" name="submit-modif" value="Enregistrer"/>
        </form>
      </div>
    </div>
    <!-- FORMULAIRE D'AJOUT DE TACHE -->
    <div class="row">
      <div class="col_75">
        <form name="form-ajout" method="post" action="">
          Ajouter une tache: <br/>
          <input type="text" name="tache" size="50"/> <br/>
          <input type="submit" name="submit-ajout" value="Ajouter"/>
        </form>
      </div>
    </div>
    <!-- LECTURE JSON DES TACHES ARCHIVEES -->
    <div class="row">
      <div class="col_75">
        <p><?php lectureArchiveJSON(); ?></p>
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
    <footer>
      <h2>Olivier & Jean Luc :D, BeCode.org</h2>
    </footer>
  </body>
</html>

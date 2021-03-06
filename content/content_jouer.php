<?php

function afficher_video($video) {
    echo <<<CHAINE_DE_FIN
        <div class="container-fluid row col-md-8 col-md-offset-2">
            <video src="videos/$video->nom" controls ></video>   
        </div>
CHAINE_DE_FIN;
}

function afficher_questions($id,$question, $rep) {
    //print_r($rep);
    shuffle($rep);
    //print_r($rep);
    echo <<<CHAINE_DE_FIN
        <div class="container-fluid row col-md-8 col-md-offset-2">
        <form class="form-group row cadre" action="?page=jouer" method="post">
          <legend class="col-form-legend col-md-offset-1 col-sm-6">$question</legend>
          <div class="col-sm-8 col-md-offset-2">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="choix" value="$rep[0]" checked>
                $rep[0]
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="choix" value="$rep[1]" >
                $rep[1]
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="choix" value="$rep[2]" >
                $rep[2]
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="choix" value="$rep[3]" >
                $rep[3]
              </label>
            </div>
            <input type="hidden" name="id" value="$id">
            <button type="submit" class="btn btn-default">Valider</button>
          </div>
        </form>
        </div>
CHAINE_DE_FIN;
}

$form_values_valid = false;
$id = Video::idAleatoire($dbh);
$video = Video::getVideoWithID($dbh, $id);
$reponses = array($video->right_answer, $video->wrong_answer1, $video->wrong_answer2, $video->wrong_answer3);

//On ne peut accéder au jeu que si on est logé
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
    if ($_SESSION['user']->admin) {
        echo <<<FIN
        <div class='col-md-8 col-md-offset-2 cadre_transparent'>
            <h2>Vous êtes Administrateur</h2>
            <p>donc pas là pour jouer</p>
        </div>
FIN;
    } else {
        if (isset($_POST["choix"])) {

            // code de traitement

            if (($video != NULL) && (Video::testerReponse($dbh, $_POST["id"], $_POST["choix"]))) {
                $form_values_valid = true;
                Utilisateur::incrementTickets($dbh, $_SESSION["user"]->login);
                Cagnotte::updateMontant($dbh, 1);
            } else {
                echo <<<FIN
        <div class="row col-md-8 col-md-offset-2 cadre_transparent">
                <p>Mauvaise réponse</p>
        </div>
FIN;
            }
        }

        if (!$form_values_valid) {
            afficher_video($video);
            afficher_questions($id,$video->question, $reponses);
        } else {
            echo <<<FIN
        <div class="row col-md-8 col-md-offset-2 cadre_transparent">
                <p>Bravo! Vous avez gagné un ticket!!</p>
        </div>
FIN;
        }
    }
} else {
    echo <<<FIN
    <div class='col-md-8 col-md-offset-2 cadre_transparent'>
        <p>Il faut être connecté pour accéder au jeu</p>
FIN;
    printLoginForm("jouer");
    echo "</div>";
}   
<div class="container-fluid">
    <div class="jumbotron cadre_transparent">
        <h1>Bienvenue sur Lotopub</h1>
        <p>Ici, vous pouvez jouer gratuitement pour gagner de l'argent.
            Le principe est très simple, vous regardez une pub et 
            repondez à une question. Si vous trouvez la bonne réponse,
            vous gagnez un billet de loterie, dont la cagnotte grossit à 
            chaque fois qu'un utilisateur regarde une pub. Génial, non ?</p>

        <p><a class="btn btn-primary btn-lg" href="index.php?page=jouer" role="button">Jouer !</a></p>
    </div>


    <div class="row col-md-12">         
        <div class="col-md-7 cadre_transparent count">
            <h2>Prochain tirage dans</h2>

            <div class="cell">
                <div id="holder">
                    <div class="digits"></div>
                </div>
            </div>  
            <div class="row">
                <span id="jours">Jours</span>
                <span id="heures">Heures</span>
                <span id="minutes">Minutes</span>
                <span id="secondes">Secondes</span>
            </div>

        </div> 
        <div class="col-md-4 col-md-offset-1 cadre_transparent ">
            <h2>Cagnotte</h2>
            
            <div id="cagnotte" class="cagnotte center-block label  label-primary"></div>      
            <div class="row">
                <div id="euro" class="center">Euros</div></div>
        </div>           
    </div>

</div>

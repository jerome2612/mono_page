<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil des Générations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');
body {
    font-family: 'Roboto', sans-serif;
}
.banner-image{
    background: linear-gradient(rgba(29, 38, 113, 0.1), rgba(195, 55, 100, 0.1)), url(assets/images/bando.jpg);
    background-size: cover;
    background-position: center;
}
.btn {
    padding: 14px 26px;
    font-weight: 700;
    font-size: 13px;
    letter-spacing: 1px;
    text-transform: uppercase;
}
</style>



<div class="banner-image">
  <div class="container pt-5">
        <div class="row pt-5">
                 <div class="col-lg-12 pt-5 text-white">
                    <h1 class="display-3 font-weight-bold mb-5"><span class="text-danger">Générez </span> publiez  <br>  votre page <span class="text-danger">en quelques clics</span></h1>
                            <p class="lead col-lg-6 mb-5 pb-5 font-weight-normal">Un outil est conçu pour être incroyablement intuitif, permettant à quiconque, même sans expérience en développement web, de créer une page professionnelle et attrayante en quelques minutes.</p>
                                
                     </div>
            </div>
        </div>
</div>






    <div class="container mt-5">
        <h1 class="text-center mb-4">Sélectionnez un type de page à générer</h1>
        <div class="row g-4">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="assets/images/mock1.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h3 class="card-title">Mono article full header</h3>
                                <p class="card-text">Générez et publiez votre page en quelques clics, sans aucune compétence technique requise.</p>
                                <ul><li>Téléchargez votre propre image </li><li>une page sobre avec une image en header style bandeau</li><li>Structurez votre contenu facilement avec des sections bien définies </li></ul>
                                <a href="full_header\formulaire_header.php" class="btn btn-primary">Générer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="assets/images/vignette2.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Génération Full Page V1</h5>
                                <p class="card-text">Créer une variante de la page complète.</p>
                                <a href="formulaire_left_picture.php" class="btn btn-primary">Générer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img3.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Génération Full Page V2</h5>
                                <p class="card-text">Créer une deuxième variante de la page complète.</p>
                                <a href="generationfullpagev2.php" class="btn btn-primary">Générer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img4.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h3 class="card-title">Header full avec content include 2 images</h3>
                                <p class="card-text">Créer une page avec une bande de réseaux sociaux.</p>
                                <a href="header_2_images_inside\formulaire_header_2pictures.php" class="btn btn-primary">Générer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img5.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h3 class="card-title">Page avec image frame droite</h3>
                                <p class="card-text"></p>
                                <a href="formulaire_right_picture.php" class="btn btn-primary">Générer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img6.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Page Sans Images</h5>
                                <p class="card-text">Créer une page sans images, uniquement du texte.</p>
                                <a href="pagesansimages.php" class="btn btn-primary">Générer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img7.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Article avec 2 Images</h5>
                                <p class="card-text">Créer une page d'article intégrant deux images.</p>
                                <a href="articleavec2images.php" class="btn btn-primary">Générer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img8.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Page avec Footer Complet</h5>
                                <p class="card-text">Créer une page avec un pied de page complet.</p>
                                <a href="pageavecfootercomplet.php" class="btn btn-primary">Générer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

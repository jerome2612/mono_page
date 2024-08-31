<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $urlRoot = rtrim($_POST['urlRoot'], '/');
    $title = $_POST['title'];
    $metaDescription = $_POST['metaDescription'];
    $siteName = $_POST['siteName'];
    $titreContenu = $_POST['titreContenu'];
    $contenu = $_POST['contenu'];

    // Créer un dossier temporaire
    $tempDir = sys_get_temp_dir() . '/' . uniqid('page_', true);
    mkdir($tempDir);

    // Gérer l'upload de l'image
    if (isset($_FILES['jumbotronImage']) && $_FILES['jumbotronImage']['error'] == 0) {
        $imageFileName = basename($_FILES['jumbotronImage']['name']);
        $uploadFile = $tempDir . '/' . $imageFileName;
        if (move_uploaded_file($_FILES['jumbotronImage']['tmp_name'], $uploadFile)) {
            $jumbotronImage = $imageFileName;
        } else {
            echo "Erreur lors du téléchargement de l'image.";
            exit;
        }
    } else {
        echo "Aucune image téléchargée.";
        exit;
    }

    // Génération du contenu HTML
    $generatedPage = "<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>" . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . "</title>
    <meta name='description' content='" . htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8') . "'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <style>
    .min-vh-70 {
        min-height: 70vh !important;
    }
    .bg-cover {
        
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: scroll!important;
        position: absolute;
        right: 0;
    }
    .min-vh-50 {
        min-height: 50vh!important;
    }
    @media(max-width: 991.98px) {
        .bg-cover {
            position: relative;    
        }
    }
    </style>

<style>
.shape.rellax {
    z-index: 1;
}
 
.shape.rellax {
    position: absolute;
}
.bg-soft-primary {
    background-color: #f1f5fd!important;    
}
.bg-dot.primary {
    background-image: radial-gradient(#3f78e0 2px,transparent 2.5px);
}
 
.shape.rellax {
    position: absolute;
}
.bg-dot {
    background-size: 0.75rem 0.75rem;
}
.bg-dot, .bg-line {
    opacity: .4;
}
.h-19 {
    height: 9rem!important;
}
.w-17 {
    width: 7rem!important;
}
</style>
</head>
<body>
 
<section class="py-5 bg-white">
  <div class="container">
    <div class="row gx-5 mb-5 mb-md-3 mb-lg-5 align-items-center">
      <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-1 position-relative order-lg-2">
        <div class="shape bg-dot primary rellax w-17 h-19" style="top: -1.7rem; left: -1.5rem;"></div>
        <div class="shape rounded bg-soft-primary rellax d-md-block" style="bottom: -1.8rem; right:1.7rem; width: 85%; height: 90%;"></div>
        <figure class="position-relative" style="z-index:2;"><img src="https://bootstraplily.com/wp-content/uploads/2021/11/about8.jpg" class="rounded" alt="" /></figure>
      </div>
      <!--/column -->
      <div class="col-lg-5 text-center text-lg-start">
        <h1 class="display-5 mb-4 mt-5 mt-lg-0">We bring solutions to make life easier for our customers.</h1>
        <p class="lead px-md-5 px-lg-0 mb-5">We have considered our solutions to support every stage of your growth.</p>
        <div class="d-flex justify-content-center justify-content-lg-start">
          <span><a href="#" class="btn btn-primary rounded-pill px-5 py-2 me-3">Explore Now</a></span>
          <span><a href="#" class="btn btn-outline-primary rounded-pill px-5 py-2">Free Trial</a></span>
        </div>
      </div>
      <!--/column -->
    </div>
    <!-- /.row -->
</section>
<!-- /section -->

<body>
    <section class='bg-light position-relative min-vh-70 d-lg-flex align-items-center'>
        <div class='rounded col-lg-6 order-lg-2 bg-cover h-100 min-vh-50' style='background-image:url({$jumbotronImage})'></div>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-6'>
                    <div class='mt-5 px-5 text-center text-lg-start'>
                        <h1 class='display-4 mb-4'>" . htmlspecialchars($titreContenu, ENT_QUOTES, 'UTF-8') . "</h1>
                        <p class='lead mb-5'>" . htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') . "</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class='container my-5'>
        <div class='row'>
            <div class='col-lg-8 mx-auto'>
                " . $contenu . "
            </div>
        </div>
    </div>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js'></script>
</body>
</html>";

    // Sauvegarder le fichier HTML dans le dossier temporaire
    $htmlFileName = 'index.html';
    file_put_contents($tempDir . '/' . $htmlFileName, $generatedPage);

    // Créer l'archive ZIP
    $zipFileName = 'page_' . uniqid() . '.zip';
    $zipFilePath = sys_get_temp_dir() . '/' . $zipFileName;

    $zip = new ZipArchive();
    if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
        $zip->addFile($tempDir . '/' . $htmlFileName, $htmlFileName);
        $zip->addFile($uploadFile, $jumbotronImage);
        $zip->close();

        // Envoyer le fichier ZIP au navigateur pour téléchargement
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
        header('Content-Length: ' . filesize($zipFilePath));
        readfile($zipFilePath);

        // Nettoyer les fichiers temporaires
        unlink($tempDir . '/' . $htmlFileName);
        unlink($uploadFile);
        rmdir($tempDir);
        unlink($zipFilePath);

        exit;
    } else {
        echo "Erreur lors de la création de l'archive ZIP.";
    }
} else {
    // Afficher le formulaire si la méthode n'est pas POST
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création mono page image droite</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

<style>
.shape.rellax {
    z-index: 1;
}
 
.shape.rellax {
    position: absolute;
}
.bg-soft-primary {
    background-color: #f1f5fd!important;    
}
.bg-dot.primary {
    background-image: radial-gradient(#3f78e0 2px,transparent 2.5px);
}
 
.shape.rellax {
    position: absolute;
}
.bg-dot {
    background-size: 0.75rem 0.75rem;
}
.bg-dot, .bg-line {
    opacity: .4;
}
.h-19 {
    height: 9rem!important;
}
.w-17 {
    width: 7rem!important;
}
</style>
</head>
<body>
 
<section class="py-5 bg-white">
  <div class="container">
    <div class="row gx-5 mb-5 mb-md-3 mb-lg-5 align-items-center">
      <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-1 position-relative order-lg-2">
        <div class="shape bg-dot primary rellax w-17 h-19" style="top: -1.7rem; left: -1.5rem;"></div>
        <div class="shape rounded bg-soft-primary rellax d-md-block" style="bottom: -1.8rem; right:1.7rem; width: 85%; height: 90%;"></div>
        <figure class="position-relative" style="z-index:2;"><img src="https://bootstraplily.com/wp-content/uploads/2021/11/about8.jpg" class="rounded" alt="" /></figure>
      </div>
      <!--/column -->
      <div class="col-lg-5 text-center text-lg-start">
        <h1 class="display-5 mb-4 mt-5 mt-lg-0">We bring solutions to make life easier for our customers.</h1>
        <p class="lead px-md-5 px-lg-0 mb-5">We have considered our solutions to support every stage of your growth.</p>
        
      </div>
      <!--/column -->
    </div>
    <!-- /.row -->
</section>
<!-- /section -->

<body>
<div class="container mt-5">
    <h2>Création mono page image droite</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="urlRoot">URL root du domaine :</label>
            <input type="text" class="form-control" id="urlRoot" name="urlRoot" placeholder="https://www.ndd.fr" required>
        </div>
        <div class="form-group">
            <label for="title">Balise title :</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Titre de la page" required>
        </div>
        <div class="form-group">
            <label for="metaDescription">Balise meta description :</label>
            <input type="text" class="form-control" id="metaDescription" name="metaDescription" placeholder="Description de la page" required>
        </div>
        <div class="form-group">
            <label for="siteName">Nom du site :</label>
            <input type="text" class="form-control" id="siteName" name="siteName" placeholder="Nom de votre site" required>
        </div>
        <div class="form-group">
            <label for="titreContenu">Titre contenu :</label>
            <input type="text" class="form-control" id="titreContenu" name="titreContenu" placeholder="Titre principal du contenu" required>
        </div>
        <div class="form-group">
            <label for="contenu">Contenu :</label>
            <textarea id="contenu" name="contenu" class="form-control" rows="10" required></textarea>
        </div>
        <div class="form-group">
            <label for="jumbotronImage">Image de fond pour le Jumbotron :</label>
            <input type="file" class="form-control" id="jumbotronImage" name="jumbotronImage" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Générer la page</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/lang/summernote-fr-FR.min.js"></script>

<script>
    $(document).ready(function() {
        $('#contenu').summernote({
            height: 300,
            minHeight: null,
            maxHeight: null,
            focus: true,
            lang: 'fr-FR',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
</body>
</html>
<?php
}
?>
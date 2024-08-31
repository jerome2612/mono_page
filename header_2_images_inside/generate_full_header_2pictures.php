<?php
// Activer le rapport d'erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function generate_full_header($filename, $title, $metaDescription, $siteName, $titreContenu, $contenu, $headerImagePath, $image1Path, $image2Path) {
    $relativeHeaderImagePath = basename($headerImagePath);
    $relativeImage1Path = basename($image1Path);
    $relativeImage2Path = basename($image2Path);

    // Vérifier si le contenu a au moins deux balises </h2>
    $contentParts = explode('</h2>', $contenu, 3);
    if (count($contentParts) < 3) {
        error_log("Le contenu n'a pas assez de balises </h2>. Utilisation du contenu original.");
        $modifiedContenu = $contenu;
    } else {
        $modifiedContenu = $contentParts[0] . '</h2>' . $contentParts[1] . '</h2>' . 
            "<div class='row'>
                <div class='col-md-6'>
                    <img src=\"$relativeImage1Path\" class='img-fluid mt-3' alt='Image 1'>
                </div>
                <div class='col-md-6'>
                    <img src=\"$relativeImage2Path\" class='img-fluid mt-3' alt='Image 2'>
                </div>
            </div>" . $contentParts[2];
    }

    $content = "<!DOCTYPE html>
    <html lang='fr'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>$title</title>
        <meta name='description' content='$metaDescription'>
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body>
    <div class='jumbotron' style='background-image: url(\"$relativeHeaderImagePath\"); background-size: cover; background-position: center; height: 75vh;'>
        <div class='container'>
            <h1 class='display-4'>$titreContenu</h1>
        </div>
    </div>
    <div class='container mt-5'>
        <div class='row'>
            <div class='col-md-12'>
                $modifiedContenu
            </div>
        </div>
    </div>
    <footer class='pt-4 my-md-5 pt-md-5 border-top'>
        <div class='row'>
            <div class='col-12 col-md'>
                <small class='d-block mb-3 text-muted'>&copy; $siteName</small>
            </div>
        </div>
    </footer>
    <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
    </body>
    </html>";

    $fullPath = $filename . '.html';
    if (file_put_contents($fullPath, $content) === false) {
        error_log("Erreur lors de la génération du fichier HTML: $fullPath");
        return false;
    }
    return true;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "Formulaire soumis ! Traitement des fichiers...<br>";

    $titreContenu = $_POST['titreContenu'];  // Utilisé comme nom de fichier
    $filename = preg_replace('/[^A-Za-z0-9_-]/', '_', $titreContenu);  // Nettoyage du nom de fichier
    $title = $_POST['title'];
    $metaDescription = $_POST['metaDescription'];
    $siteName = $_POST['siteName'];
    $contenu = $_POST['contenu'];

    // Vérifier que le répertoire headers existe
    $headersDir = __DIR__ . '/headers/';
    if (!file_exists($headersDir)) {
        if (!mkdir($headersDir, 0777, true)) {
            die("Erreur lors de la création du répertoire headers.<br>");
        }
        echo "Répertoire headers créé.<br>";
    }

    // Gestion des uploads de fichiers
    $headerImagePath = $headersDir . basename($_FILES['headerImage']['name']);
    $image1Path = $headersDir . basename($_FILES['image1']['name']);
    $image2Path = $headersDir . basename($_FILES['image2']['name']);

    if (!move_uploaded_file($_FILES['headerImage']['tmp_name'], $headerImagePath)) {
        die("Échec du téléchargement de l'image d'en-tête.<br>");
    }
    echo "Image d'en-tête téléchargée avec succès.<br>";

    if (!move_uploaded_file($_FILES['image1']['tmp_name'], $image1Path)) {
        die("Échec du téléchargement de l'image 1.<br>");
    }
    echo "Image 1 téléchargée avec succès.<br>";

    if (!move_uploaded_file($_FILES['image2']['tmp_name'], $image2Path)) {
        die("Échec du téléchargement de l'image 2.<br>");
    }
    echo "Image 2 téléchargée avec succès.<br>";

    // Générer le fichier HTML
    if (generate_full_header($filename, $title, $metaDescription, $siteName, $titreContenu, $contenu, $headerImagePath, $image1Path, $image2Path)) {
        echo "Fichier HTML généré avec succès.<br>";
    } else {
        die("Erreur lors de la génération du fichier HTML. Vérifiez les logs pour plus de détails.<br>");
    }

    // Créer un fichier ZIP
    $zip = new ZipArchive();
    $zipFilename = $filename . '.zip';

    if ($zip->open($zipFilename, ZipArchive::CREATE) === TRUE) {
        // Ajouter le fichier HTML et les images au ZIP
        $zip->addFile($filename . '.html', $filename . '.html');
        $zip->addFile($headerImagePath, basename($headerImagePath));
        $zip->addFile($image1Path, basename($image1Path));
        $zip->addFile($image2Path, basename($image2Path));
        $zip->close();
        echo "Fichier ZIP généré avec succès : <a href='$zipFilename' download>Télécharger</a><br>";
    } else {
        die("Erreur lors de la création du fichier ZIP.<br>");
    }
}
?>
<?php
function generate_jumbotron_page($filename, $urlRoot, $title, $metaDescription, $siteName, $titreContenu, $contenu, $imagePath) {
    // HTML content generation
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
<div class='jumbotron' style='background-image: url($imagePath); background-size: cover; background-position: center;'>
    <div class='container'>
        <h1 class='display-4'>$titreContenu</h1>
    </div>
</div>
<div class='container mt-5'>
    <div class='row'>
        <div class='col-md-12'>
            <p>$contenu</p>
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

    $htmlFilePath = $filename . '.html';

    // Save the HTML file
    if (file_put_contents($htmlFilePath, $content) === false) {
        die("Error generating HTML file.");
    }

    // Create a ZIP file
    $zip = new ZipArchive();
    $zipFilePath = $filename . '.zip';

    if ($zip->open($zipFilePath, ZipArchive::CREATE) !== TRUE) {
        die("Cannot open <$zipFilePath>\n");
    }

    // Add the HTML file to the ZIP archive
    $zip->addFile($htmlFilePath, basename($htmlFilePath));

    // Add the image to the ZIP archive, if it exists
    if ($imagePath && file_exists($imagePath)) {
        $zip->addFile($imagePath, basename($imagePath));
    }

    // Close the ZIP archive
    $zip->close();

    // Cleanup: remove the individual files
    unlink($htmlFilePath);
    if ($imagePath && file_exists($imagePath)) {
        unlink($imagePath);
    }

    // Return the path to the ZIP file
    return $zipFilePath;
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $filename = isset($_POST['filename']) ? $_POST['filename'] : 'jumbotron_page';
    $urlRoot = isset($_POST['urlRoot']) ? $_POST['urlRoot'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $metaDescription = isset($_POST['metaDescription']) ? $_POST['metaDescription'] : '';
    $siteName = isset($_POST['siteName']) ? $_POST['siteName'] : '';
    $titreContenu = isset($_POST['titreContenu']) ? $_POST['titreContenu'] : '';
    $contenu = isset($_POST['contenu']) ? $_POST['contenu'] : '';

    $imagePath = '';
    if (isset($_FILES['jumbotronImage']) && $_FILES['jumbotronImage']['error'] === UPLOAD_ERR_OK) {
        $imagePath = basename($_FILES['jumbotronImage']['name']);
        if (!move_uploaded_file($_FILES['jumbotronImage']['tmp_name'], $imagePath)) {
            die("Failed to upload image.");
        }
    }

    // Generate the ZIP file
    $zipFilePath = generate_jumbotron_page($filename, $urlRoot, $title, $metaDescription, $siteName, $titreContenu, $contenu, $imagePath);

    // Provide a link to download the ZIP file
    echo "File successfully created: <a href='$zipFilePath' download>Download ZIP</a>";
}
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Script started.<br>";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "Form has been submitted successfully!<br>";

    $filename = 'header_2pictures_page';
    $title = $_POST['title'];
    $metaDescription = $_POST['metaDescription'];
    $siteName = $_POST['siteName'];
    $titreContenu = $_POST['titreContenu'];
    $contenu = $_POST['contenu'];

    $headersDir = __DIR__ . '/headers/';
    if (!file_exists($headersDir)) {
        mkdir($headersDir, 0777, true);
        echo "Created headers directory.<br>";
    }

    $headerImagePath = $headersDir . basename($_FILES['headerImage']['name']);
    $image1Path = $headersDir . basename($_FILES['image1']['name']);
    $image2Path = $headersDir . basename($_FILES['image2']['name']);

    if (move_uploaded_file($_FILES['headerImage']['tmp_name'], $headerImagePath)) {
        echo "Header image uploaded successfully.<br>";
    } else {
        echo "Failed to upload header image.<br>";
    }

    if (move_uploaded_file($_FILES['image1']['tmp_name'], $image1Path)) {
        echo "Image 1 uploaded successfully.<br>";
    } else {
        echo "Failed to upload image 1.<br>";
    }

    if (move_uploaded_file($_FILES['image2']['tmp_name'], $image2Path)) {
        echo "Image 2 uploaded successfully.<br>";
    } else {
        echo "Failed to upload image 2.<br>";
    }

    // HTML generation code here
    $relativeHeaderImagePath = basename($headerImagePath);
    $relativeImage1Path = basename($image1Path);
    $relativeImage2Path = basename($image2Path);

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
        <div class='col-md-6'>
            <div class='card'>
                <img src=\"$relativeImage1Path\" class='card-img-top img-fluid' alt='Image 1'>
            </div>
        </div>
        <div class='col-md-6'>
            <div class='card'>
                <img src=\"$relativeImage2Path\" class='card-img-top img-fluid' alt='Image 2'>
            </div>
        </div>
    </div>
    <div class='row mt-5'>
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
<script src='https://stackpath.amazonaws.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
</body>
</html>";

    file_put_contents($filename . '.html', $content);
    echo "HTML file generated.<br>";

    // Create ZIP
    $zip = new ZipArchive();
    $zipFilename = $filename . '.zip';

    if ($zip->open($zipFilename, ZipArchive::CREATE) === TRUE) {
        $zip->addFile($filename . '.html', $filename . '.html');
        $zip->addFile($headerImagePath, basename($headerImagePath));
        $zip->addFile($image1Path, basename($image1Path));
        $zip->addFile($image2Path, basename($image2Path));
        $zip->close();
        echo "ZIP file generated successfully: <a href='$zipFilename' download>Download</a><br>";
    } else {
        echo "Error creating ZIP file.<br>";
    }
}
?>

<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $filename = 'header_2pictures_page';
    $title = $_POST['title'];

    // Directory for uploads (relative path)
    $headersDir = 'headers/';
    if (!file_exists(__DIR__ . '/' . $headersDir)) {
        mkdir(__DIR__ . '/' . $headersDir, 0777, true);
    }

    // Handle file uploads
    $headerImagePath = $headersDir . basename($_FILES['headerImage']['name']);
    $image1Path = $headersDir . basename($_FILES['image1']['name']);
    $image2Path = $headersDir . basename($_FILES['image2']['name']);

    if (!move_uploaded_file($_FILES['headerImage']['tmp_name'], __DIR__ . '/' . $headerImagePath) ||
        !move_uploaded_file($_FILES['image1']['tmp_name'], __DIR__ . '/' . $image1Path) ||
        !move_uploaded_file($_FILES['image2']['tmp_name'], __DIR__ . '/' . $image2Path)) {
        die("File upload error.");
    }

    // Generate the HTML content with relative paths
    $content = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>$title</title>
</head>
<body>
    <img src='$headerImagePath' alt='Header Image'>
    <img src='$image1Path' alt='Image 1'>
    <img src='$image2Path' alt='Image 2'>
</body>
</html>";

    // Save the HTML file
    file_put_contents($filename . '.html', $content);

    // Create a ZIP file
    $zip = new ZipArchive();
    $zipFilename = $filename . '.zip';

    if ($zip->open($zipFilename, ZipArchive::CREATE) === TRUE) {
        $zip->addFile($filename . '.html', $filename . '.html');
        $zip->addFile(__DIR__ . '/' . $headerImagePath, $headerImagePath);
        $zip->addFile(__DIR__ . '/' . $image1Path, $image1Path);
        $zip->addFile(__DIR__ . '/' . $image2Path, $image2Path);
        $zip->close();

        echo "ZIP file created: <a href='$zipFilename' download>Download</a>";
    } else {
        echo "ZIP creation failed.";
    }
}
?>

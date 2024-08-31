<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Page</title>
</head>
<body>
    <form action="your_script.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" required>
        <input type="file" name="headerImage" required>
        <input type="file" name="image1" required>
        <input type="file" name="image2" required>
        <button type="submit">Generate</button>
    </form>
</body>
</html>

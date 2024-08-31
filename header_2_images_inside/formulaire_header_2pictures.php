<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'une page avec deux images dans le contenu</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Création d'une page avec un Header et deux Images</h2>
    <form action="generate_full_header_2pictures.php" method="post" enctype="multipart/form-data">
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
            <label for="headerImage">Image pour le header :</label>
            <input type="file" class="form-control-file" id="headerImage" name="headerImage" required>
        </div>
        <div class="form-group">
            <label for="image1">Image 1 :</label>
            <input type="file" class="form-control-file" id="image1" name="image1" required>
        </div>
        <div class="form-group">
            <label for="image2">Image 2 :</label>
            <input type="file" class="form-control-file" id="image2" name="image2" required>
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
            lang: 'fr-FR'
        });
    });
</script>
</body>
</html>

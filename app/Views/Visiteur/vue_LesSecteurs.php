<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Compagnie Atlantik</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <nav class="navbar bg-light">
        <h1 class="text-center">Compagnie Atlantik</h1>
        <div class="container-fluid">
            <ul class="navbar-nav">
                <?php
                foreach ($secteurs as $secteur) :
                    echo '<li class="nav-item">';
                    echo '<h3>' . anchor('voirsecteurs/' . $secteur->NOSECTEUR, $secteur->NOM) . '</h3>';
                    echo '</li>';
                endforeach; ?>
            </ul>
        </div>
    </nav>

    <div class="container-fluid mt-3">
        <h3>Vertical Navbar Example</h3>
        <p>A navigation bar is a navigation header that is placed at the top of the page.</p>
    </div>
</body>

</html>
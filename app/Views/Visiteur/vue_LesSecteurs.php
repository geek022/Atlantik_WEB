<!DOCTYPE html>
<html lang="fr">

<head>
    
</head>

<body>
    <nav class="navbar bg-light">
        <h1 class="text-center">Compagnie Atlantik</h1>
        <div class="container-fluid">
            <ul class="navbar-nav">
                <?php
                foreach ($secteurs as $secteur) :
                    echo '<li class="nav-item">';
                    echo '<h3>' . anchor('voirsecteurs/' . $secteur->NOSECTEUR, $secteur->NOM,['class'=>'btn btn-secondary']) . '</h3>';
                    echo '</li>';
                endforeach; ?>
            </ul>
        </div>
    </nav>
        
</body>

</html>
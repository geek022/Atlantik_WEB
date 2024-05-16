<table class="table table-bordered">

    <body>
        <h2 class="text-center"><em> Compagnie Atlantik Tarifs en euros</em></h2>
    </body>
    <thead>
        <tr>
            <th rowspan="2">Secteur</th>
            <th rowspan="1" colspan="4" class="text-center">Liaison</th>
        </tr>
        <tr>
            <th rowsapn="1" colspan="1">Code Liaison</th>
            <th rowspan="1" colspan="1">Distance en milles marin</th>
            <th rowspan="1" colspan="1">Port de départ</th>
            <th rowspan="1" colspan="1">Port d'arrivée</th>
        </tr>
        <?php
        $secteur_courante = ""; // initialisation de la variable de rupture
        foreach ($lesLiaisons as $uneLiaison) :
            if ($uneLiaison->nom != $secteur_courante) {
                echo '<tr><td>' . $uneLiaison->nom . '</td>';
                echo '<td>'.anchor('voirliaison/'.$uneLiaison->noliaison,$uneLiaison->noliaison).'</td>';
                echo '<td>' . $uneLiaison->distance . '</td>';
                echo '<td>' . $uneLiaison->portdepart . '</td>';
                echo '<td>' . $uneLiaison->nomport . '</td>';
            } else {
                //Si le secteur est le même que le précédent, on laisse la première cellule vide et on ajoute juste les autres.
                echo '<tr>';
                echo '<td></td>';
                echo '<td>' .anchor('voirliaison/'.$uneLiaison->noliaison,$uneLiaison->noliaison) . '</td>';
                echo '<td>' . $uneLiaison->distance . '</td>';
                echo '<td>' . $uneLiaison->portdepart . '</td>';
                echo '<td>' . $uneLiaison->nomport . '</td>';
                echo '</tr>';
            }
            $secteur_courante = $uneLiaison->nom; //on met à jour le secteur courant
        endforeach ?>
    </thead>
    </body>
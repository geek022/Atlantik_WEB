<?php
//echo '<h3>Liaison ' . $liaison->NOLIAISON . ' : ' . $depart[0]->nom . ' - ' . $arrivee[0]->nom . '</h3>';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire généré dynamiquement</title>
</head>

<body>
    <?php
    foreach ($liaisons as $liaison) :
        echo '<p>Liaison : ' . $liaison->portdepart . '-' . $liaison->portarrivee . '</p>';
    endforeach;
    echo '<p>Traversée n°' . $traversee->NOTRAVERSEE . ' le ' . date('Y/m/d', strtotime($traversee->DATEHEUREARRIVEE)) . '  à ' . date('H:i', strtotime($traversee->DATEHEUREARRIVEE)) . '</p>';
    echo '<p>Saisir les informations relatives à la réservation</p>';
    echo '<p>Nom : '  . $utilisateur->NOM . '</p>';
    echo '<p>Adresse : ' . $utilisateur->ADRESSE . '</p>';
    echo '<p>Code Postal : '  . $utilisateur->CODEPOSTAL . ' Ville : ' . $utilisateur->VILLE . '</p>';
    ?>
    <form action="" method="">
        <table border="1">
            <tr>
                <th></th>
                <th>Tarif en €</th>
                <th>Quantité</th>
            </tr>
            <?php foreach ($tarifs as $tarif) :
                echo '<tr>';
                echo '<td>' . $tarif->libelletype . '</td>';
                echo '<td>' . $tarif->tarif . '</td>';
                echo '<td><input type="number" name="quantite[' . $tarif->notype . ']" min="0" value="0"></td>';
                echo '</tr>';
            endforeach; ?>
        </table>
        <button type="submit">Réserver</button>
    </form>
</body>

</html>
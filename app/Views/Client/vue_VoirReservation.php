
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
    echo '<p>Traversée n°' . $traversee[0]->NOTRAVERSEE . ' le ' . date('Y/m/d \à H:i' , strtotime($traversee[0]->DATEHEUREARRIVEE)). '</p>';
    echo '<p>Saisir les informations relatives à la réservation</p>';
    echo '<p>Nom : '  . $utilisateur->NOM . '</p>';
    echo '<p>Adresse : ' . $utilisateur->ADRESSE . '</p>';
    echo '<p>Code Postal : '  . $utilisateur->CODEPOSTAL . ' Ville : ' . $utilisateur->VILLE . '</p>';
    ?>
    <?php echo form_open('reserver/'.$traversee[0]->NOTRAVERSEE)?>
    <?php echo csrf_field();?>
        <table border="1" style="width:50%">
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
        <?php
        foreach($tarifs as $tarif):
            echo'<input type="hidden" name="lettrecategorie['.$tarif->lettrecategorie.']>';
        endforeach;
        ?>
        <input type="hidden" name="notraversee" value="<?php $traversee[0]->NOTRAVERSEE ?>">
        <button type="submit" name="submit">Valider-Acheter</button>
        <?php echo form_close();?>
        
    </form>
</body>

</html>
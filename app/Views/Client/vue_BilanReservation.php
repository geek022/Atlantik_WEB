<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilan de la Réservation</title>
</head>

<body>
    <hp><?php anchor('voirreservation/'. $liaison->portdepart . '-' . $liaison->portarrivee ) ?></hp>

    <p>Réservation n°<?= $reservation->NORESERVATION ?></p>
    <p>Client : <?= $reservation->NOCLIENT ?></p>
    <p>Date et Heure : <?= $reservation->DATEHEURE ?></p>
    <p>Montant Total : <?= $reservation->MONTANTTOTAL ?> €</p>

    <h2>Détails</h2>
    <table border="1">
        <tr>
            <th>Type</th>
            <th>Quantité Réservée</th>
        </tr>
        <?php foreach ($enregistrements as $enregistrement) : ?>
            <tr>
                <td><?= $enregistrement->NOTYPE ?></td>
                <td><?= $enregistrement->QUANTITERESERVEE ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>



<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<h2><?php echo $TitreDeLaPage ?></h2>
<table border="1" style="width: 100%">
<thead>
    <tr>
        <th>n°réservation</th>
        <th>Date réservation</th>
        <th>Départ</th>
        <th>Arrivée</th>
        <th>Date départ</th>
        <th>Total</th>
        <th>Payé</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($reservations as $reservation) :
        echo'<tr>';
            echo'<td>'.$reservation->noreservation.'</td>';
            echo'<td>'.date('d/m/Y',strtotime($reservation->dateheure)).'</td>';
            echo'<td>'.$reservation->portdepart.'</td>';
            echo'<td>'.$reservation->portarrivee.'</td>';
            echo'<td>'.date('d/m/Y',strtotime($reservation->dateheuredepart)).'</td>';
            echo'<td>'.$reservation->montanttotal.'</td>';
            echo'<td>'.($reservation->paye ? 'Oui' : 'Non').'</td>';
        echo'</td>';
    endforeach; ?>
</table>
<div>
    <?php echo $pager->links() ?>
</div>
</body>
</html>
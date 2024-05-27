<!DOCTYPE html>
<html>

<head>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .title-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .title-left {
            text-align: left;
            flex: 1;
        }

        .title-right {
            text-align: right;
            flex: 1;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="title-left">Traversée</h2>
            <h2 class="title-right">Places disponibles par catégorie</h2>
        </div>
        <div>
            <?php
            foreach ($liaisons as $liaison) :
                echo '<p>' . $liaison->depart . '-' . $liaison->arrivee . '.' . ' Traversées pour le ' . date('Y/m/d', strtotime($date)) . '.' . ' Sélectionner la traversée souhaitée</p>';
            endforeach;
            ?>
        </div>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>N°</th>
                    <th>Heure</th>
                    <th>Bateau</th>
                    <?php foreach ($categories as $categorie) : ?>
                        <th><?php echo $categorie->LETTRECATEGORIE . ' ' . $categorie->LIBELLE; ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bateaux as $bateau) : 
                    echo'<tr>';
                        echo'<td>' .anchor('voirreservation/' . $bateau->traversee, $bateau->traversee).'</td>';
                        echo'<td>' .date('H:i', strtotime($bateau->arrivee)).'</td>';
                        echo'<td>' .$bateau->nom.'</td>';
                        foreach ($categories as $categorie) :
                            echo'<td>' .$capacites[$bateau->traversee][$categorie->LETTRECATEGORIE].'</td>';
                        endforeach; 
                    echo'</tr>';
                endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 5px;
        text-align: center;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
<h2 class="text-center">Compagnie Atlantik <em>Tarif en euros</em></h2>
<?php


echo '<h3>Liaison ' . $uneLiaison->NOLIAISON . ' : ' . $depart[0]->nom . ' - ' . $arrivee[0]->nom . '</h3>';
echo '<p>' . anchor('voirlestarifs/', 'Afficher les tarifs pour une liaison') . '</p>';
?>
<table style="width:100%">
    <tr>
        <th>Catégorie</th>
        <th>Type</th>
        <th colspan="3" class="text-center">Période</th>
    </tr>
    <tr>
        <?php
        foreach($lesTarifs as $tarif) :
            echo'<tr>';
            echo'<td>' .$tarif->lettrecategorie.' '.$tarif->libellecategorie.'</td>';
            echo'<td>'.$tarif->lettretype.''.$tarif->notype.'-'.$tarif->libelletype.'</td>';
            echo'<td>'.$tarif->datedebut.'</td>';
            echo'<td>'.$tarif->datefin.'</td>';
            echo'<td>'.$tarif->tarif.'</td>';
            echo'</tr>';
            
         endforeach?>
    </tr>
</table>
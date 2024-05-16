<?php
foreach($lesSecteurs as $unSecteur) :
    echo '<tr>';
    echo '<td>' . $unSecteur->NOM . '</td>';
    //echo '<td>' . $unSecteur->SECTEUR . '</td>';
    echo'</tr>';
endforeach; ?>


<?php
foreach ($lesTraversees as $uneTraversee) :
    echo '<tr>';
    echo '<td>' . $uneTraversee->NOLIAISON . '</td>';
    echo '<td>' . $uneTraversee->dateheuredepart . '</td>';
    echo '<td>' . $uneTraversee->dateheurearrivee . '</td>';
    echo '<td>' . $uneTraversee->nom . '</td>';
    echo '</tr>';
endforeach;

<?php
echo'<h2>'.$TitreDeLaPage.'</h2>';
echo'<table border=1>';
echo'<tr><td>Numéro : '.$unSecteur->NOSECTEUR.'</td></tr>';
echo'<tr><td>Nom : '.$unSecteur->NOM.'</td></tr>';
echo'</table>';
echo'<p>'.anchor('voirsecteurs','Retour à la liste des secteurs').'</p>';
?>
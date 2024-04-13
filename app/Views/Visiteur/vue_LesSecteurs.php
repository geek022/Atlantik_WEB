<h2><?php echo $TitreDeLaPage?></h2>
<?php
foreach($lesSecteurs as $unSecteur):
    echo'<h3>'.anchor('voirsecteurs/'.$unSecteur->NOSECTEUR,$unSecteur->NOM).'</h3>';
    echo'<h3>'.anchor('voirliaison/'.$unSecteur->NOSECTEUR,$unSecteur->NOM).'</h3>';
endforeach;?>
<p>Pour affichuer la liaison d'un secteur, cliquer sur son numéro</p>
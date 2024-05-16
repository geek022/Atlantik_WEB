<?php
//echo '<h3>Liaison ' . $uneLiaison->NOLIAISON . ' : ' . $depart[0]->nom . ' - ' . $arrivee[0]->nom . '</h3>';
echo '<p>' . anchor('modifiercompte/', 'Modifier vos informations personnelles') . '</p>';
echo '<p>Nom : ' . $utilisateur->NOM . '</p>';
echo '<p>Adresse : ' . $utilisateur->ADRESSE . '</p>';
echo '<p>CP : ' . $utilisateur->CODEPOSTAL . ' Ville : ' . $utilisateur->VILLE . '</p>';

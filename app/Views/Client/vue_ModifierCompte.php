<!DOCTYPE html>
<html>
<head>
    <title>Modifier Compte</title>
</head>
<body>

<?php
helper('form');
echo form_open('modifiercompte');
echo csrf_field();
echo form_hidden('noclient', $utilisateur->NOCLIENT);
echo form_label('Nom', 'lblNom');
echo form_input('txtNom', $utilisateur->NOM);
echo'<br>';
echo form_label('Prénom', 'lblPrenom');
echo form_input('txtPrenom', $utilisateur->PRENOM);
echo'<br>';
echo form_label('Adresse', 'lblAdresse');
echo form_input('txtAdresse', $utilisateur->ADRESSE);
echo'<br>';
echo form_label('Code postal', 'lblCodePostal');
echo form_input('txtCodePostal', $utilisateur->CODEPOSTAL);
echo'<br>';
echo form_label('Ville', 'lblVille');
echo form_input('txtVille', $utilisateur->VILLE);
echo'<br>';
echo form_label('Téléphone fixe', 'lblTelephoneFixe');
echo form_input('txtTelephoneFixe', $utilisateur->TELEPHONEFIXE);
echo'<br>';
echo form_label('Téléphone mobile', 'lblTelephoneMobile');
echo form_input('txtTelephoneMobile', $utilisateur->TELEPHONEMOBILE);
echo'<br>';
echo form_label('Email', 'lblMel');
echo form_input('txtMel', $utilisateur->MEL);
echo'<br>';
echo form_submit('submit', 'Modifier');
echo form_close();

?>
</body>
</html>

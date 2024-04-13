<h2><?php echo $TitreDeLaPage ?></h2>
<?php
if ($TitreDeLaPage == 'Saisie incorrecte')
    echo service('validation')->listErrors();
echo form_open('connexion');
echo csrf_field();
echo form_label('Email', 'lblmel');
echo form_input('txtMel', set_value('txtMel'));
echo form_label('mot de passe', 'txtMDP');
echo form_password('txtMDP', set_value('txtMDP'));
echo form_submit('submit', 'Se connecter');
echo form_close();
?>
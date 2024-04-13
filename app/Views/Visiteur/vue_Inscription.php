<h2><?php echo $TitreDeLaPage ?></h2>
<?php
if ($TitreDeLaPage == 'Saisie incorrecte')
    echo service('validation')->listErrors();
echo form_open('inscription')
?>
<?php echo csrf_field(); ?>
<div class="form-group">
    <label for="txtNom">Nom</label>
    <input type="input" name="txtNom" value="<?php echo set_value('txtNom') ?>" class="form-control" /><br />
    <label for="txtPrenom">Prénom</label>
    <input type="input" name="txtPrenom" value="<?php echo set_value('txtPrenom') ?>" class="form-control" /><br />
    <label for="txtAdresse">Adresse</label>
    <input type="input" name="txtAdresse" value="<?php echo set_value('txtAdresse') ?>" class="form-control" /><br />
    <label for="txtCP">Code postal</label>
    <input type="input" name="txtCP" value="<?php echo set_value('txtCP') ?>" class="form-control" /><br />
    <label for="txtVille">Ville</label>
    <input type="input" name="txtVille" value="<?php echo set_value('txtVille') ?>" class="form-control" /><br />
    <label for="txtTel">Téléphone</label>
    <input type="input" name="txtTel" value="<?php echo set_value('txtTel') ?>" class="form-control" /><br />
    <label for="txtMobil">Mobile</label>
    <input type="input" name="txtMobil" value="<?php echo set_value('txtMobil') ?>" class="form-control" /><br />
    <label for="txtMel">Email</label>
    <input type="input" name="txtMel" value="<?php echo set_value('txtMel') ?>" class="form-control" /><br />
    <label for="txtMDP">Mot de passe</label>
    <input type="password" name="txtMDP" value="<?php echo set_value('txtMDP') ?>" class="form-control" /><br />
    <label for="txtMDPConfirmation">Confirmation du mot de passe</label>
    <input type="password" name="txtMDPConfirmation" value="<?php echo set_value('txtMDPConfirmation') ?>" class="form-control" /><br />
    <input type="submit" name="submit" value="S'inscrire" class="btn btn-primary" />
    <?php echo form_close() ?>
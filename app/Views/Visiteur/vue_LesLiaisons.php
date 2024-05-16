<?php
foreach($lesSecteurs as $unSecteur):
{
    echo $unSecteur->NOSECTEUR,$unSecteur->NOM;
}
endforeach;?>
<p>Pour afficher la liaison d'un secteur, cliquer sur son numéro
    A SUPPRIMER
</p>
<?php

?>
<!-- Dans vue_LesLiaisons.php -->
<form method="post" action="">
    <div class="form-group">
        <label for="liaisons">Sélectionnez une liaison :</label>
        <select name="liaisons" id="liaisons" class="form-control">
            <?php foreach ($lesLiaisons as $liaison): ?>
                <option value="<?= $liaison->portdepart ?>"><?= $liaison->portarrivee ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="date">Sélectionnez une date :</label>
        <input type="date" name="date" id="date" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Afficher les traversées</button>
</form>

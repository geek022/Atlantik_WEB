<!DOCTYPE html>
<html>

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
</head>

<body>
    <?php
    echo form_open('voirunetraversee');
    echo csrf_field();
    echo '<div class="container-fluid">';
    echo '<p>Sélectionner la liaison, et la date souhaitée</p>';
    echo '<div class="row justify-content-start">';
    echo '<div class="col-md-4">';
    echo '<select name="lstLiaisons" class="form-select" aria-label="Default select example">';
    foreach ($liaisons as $liaison) :
        echo '<option value="'.$liaison->noliaison.'">' . $liaison->portdepart . '-' . $liaison->portarrivee . '</option>';
    endforeach;
    echo '</select>';
    echo '</div>';
    echo '<div class="col-md-4">';
    echo '<input type="date" value="datepicker" id="datepicker" name="datepicker">';
    echo '</div>';
    echo '<div class="col md-4">';
    echo form_submit('submit', 'Afficher les traversées');
    echo form_close();
    echo '</div>';
    echo '</div>';
    echo '</div>';

    ?>

</body>

</html>
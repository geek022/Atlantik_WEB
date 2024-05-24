<?php
foreach($lesLiaisons as $liaison) :
    echo '<li><a class="dropdown-item" href="#">' . $liaison->portdepart . '-' . $liaison->portarrivee . '</a></li>';

endforeach;?>

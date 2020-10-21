<div class="user-info">
    <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo ''. $firstname . ' ' . $lastname . '' ; ?></div>
        <div class="email"><?php echo $email; ?></div>
        <div class="email">Openstaand bedrag: &euro;<?php echo $finance; ?></div>
        <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
            <ul class="dropdown-menu pull-right">
                <li><a href="/account/edit_profile"><i class="material-icons">person</i>Profiel wijzigen</a></li>
                <li><a href="/account/logout"><i class="material-icons">input</i>Uitloggen</a></li>
            </ul>
        </div>
    </div>
</div>
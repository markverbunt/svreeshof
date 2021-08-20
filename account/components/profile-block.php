<div class="user-info">
    <div class="image">
        <?php if (isset($profile_photo)) echo"
            <img src='$profile_photo_url' alt='$firstname $lastname' width='48' height='48'>
        "; ?>
    </div>
    <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo ''. $firstname . ' ' . $lastname . '' ; ?></div>
        <div class="email"><a style="color: #fff;" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></div>
        <div class="email">Openstaand bedrag: &euro;<?php echo $finance; ?></div>
        <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
            <ul class="dropdown-menu pull-right">
                <li><a href="/account/edit_profile.php"><i class="material-icons">person</i>Profiel wijzigen</a></li>
                <li><a href="/account/logout.php"><i class="material-icons">input</i>Uitloggen</a></li>
            </ul>
        </div>
    </div>
</div>
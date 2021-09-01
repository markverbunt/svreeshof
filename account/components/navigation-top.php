<?php 
foreach($mysqli->query("SELECT COUNT(*) FROM messages_logs WHERE user_id='$id' AND message_read='0'") as $messagecounts) {
    $messagecount  = "". $messagecounts['COUNT(*)'] ."";
}
$sql4 = "SELECT messages_logs.email_id, messages_logs.hashed_email_id, messages_logs.subject, messages_logs.message_read, messages_logs.created_at FROM messages_logs INNER JOIN users ON messages_logs.user_id=users.id WHERE messages_logs.user_id='$id' LIMIT 4";

    $result4 = $mysqli->query($sql4);
?>
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar HIDDEN">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="/account/dashboard.php"><img class="" style="background: #fff; display: inline-block; margin-right: 15px;" src="/images/logo-svreeshof.png" height="30" alt="Sv Reeshof - Bierteam">Sv Reeshof - Bierteam</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li class="hidden"><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li><a href="/account/edit_profile.php" class=" waves-effect waves-block"><i class="material-icons">person</i></a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">email</i>
                            <span class="label-count"><?php echo $messagecount; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">BERICHTEN</li>
                            <li class="body">
                                <ul class="menu">
                                    <?php
                                        if ($result4->num_rows > 0) {
                                            while ($row4 = $result4->fetch_assoc()) {
                                                $email_id = $row4['email_id'];
                                                $hashed_email_id = $row4['hashed_email_id'];
                                                $subject = $row4['subject'];
                                                $message_read = $row4['message_read'];
                                                $orgDateTime = $row4['created_at'];
                                                $send_at = date("d-m-Y H:i:s", strtotime($orgDateTime));
                                                if($message_read=="0") echo "<li class='new'>";
                                                else if($message_read=="1") echo "<li>";
                                                    echo "<a href='/account/message.php?hashed_email_id=$hashed_email_id'>";
                                                        echo "<div class='icon-circle bg-blue-grey'>";
                                                           echo "<i class='material-icons'>email</i>";
                                                        echo "</div>";
                                                        echo "<div class='menu-info'>";
                                                            if($message_read=="0") echo "<h4>$subject <span class='badge bg-yellow'>Nieuw</span></h4>";
                                                            else if($message_read=="1") echo "<h4>$subject</h4>";
                                                            echo "<p>";
                                                                echo "<i class='material-icons'>access_time</i> $send_at";
                                                            echo "</p>";
                                                        echo "</div>";
                                                        echo "</a>";
                                                echo "</li>";
                                            }
                                        } else {}                                   
                                    ?>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="/account/messages.php">Bekijk alle berichten</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->
                    <!-- Tasks -->
                    <li class="dropdown hidden">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">flag</i>
                            <span class="label-count">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">TASKS</li>
                            <li class="body">
                                <ul class="menu tasks">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Footer display issue
                                                <small>32%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Make new buttons
                                                <small>45%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Create new dashboard
                                                <small>54%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Solve transition issue
                                                <small>65%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Answer GitHub questions
                                                <small>92%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 92%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Tasks -->
                    <li class="pull-right hidden"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
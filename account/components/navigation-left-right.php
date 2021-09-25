    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <?php include 'components/profile-block.php'; ?>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU</li>
                    <li class="active">
                        <a href="/account/dashboard.php">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                     <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">sports_soccer</i>
                            <span>Wedstrijd / Training</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/account/events_training.php">Training</a>
                            </li>
                            <li>
                                <a href="/account/events_wedstrijd.php">Wedstrijd</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/account/messages.php">
                            <i class="material-icons">email</i>
                            <span>Berichtenbox</span>
                            <span class="badge bg-yellow"><?php echo $messagecount; ?></span>
                        </a>
                    </li>
                    <?php if($is_admin) echo'
                    <li class="header">ADMINISTRATOR</li>
                    <li>
                        <a href="/account/users.php">
                            <i class="material-icons">person</i>
                            <span>Alle gebruikers</span>
                        </a>
                    </li>
                     <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person</i>
                            <span>Gebruikers overzicht</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/account/users_play.php">Spelers</a>
                            </li>
                            <li>
                                <a href="/account/users_rest.php">Rustende leden</a>
                            </li>
                        </ul>
                    </li>
                     <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">sports_soccer</i>
                            <span>Wedstrijd / Training</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/account/add_event.php">Voeg wedstrijd / training toe</a>
                            </li>
                            <li>
                                <a href="/account/list_events.php">Wijzig wedstrijd / training</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/account/finance_overview.php">
                            <i class="material-icons">euro</i>
                            <span>Financieel</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">email</i>
                            <span>Berichten</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/account/new_message.php">Nieuw bericht</a>
                            </li>
                            <li>
                                <a href="/account/list_messages.php">Verzonden berichten</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/account/settings.php">
                            <i class="material-icons">settings</i>
                            <span>Instellingen</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">update</i>
                            <span>Logs</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/account/afmeldingen-logs.php">Afmeldingen logs</a>
                            </li>
                            <li>
                                <a href="/account/email-logs.php">Email logs</a>
                            </li>
                        </ul>
                    </li>
                '; ?>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2021 Sv reeshof 7.
                </div>
                <div class="version">
                    <b>Version: </b> 2.6 - Laatste update 25-09-21
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar hidden">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>
<?php

use MVC\core\session;

?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-info">
            <div class="image">
                <img src="<?= \MVC\core\helpers::showUserImage() ?>" alt="">
            </div>
            <span class="username"><?php
              if (isset(session::get('user_data')['user']->username))
                  echo session::get('user_data')['user']->username; ?>
            </span>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="<?= ROOT_LINK . 'user' ?>" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Users

                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= ROOT_LINK . 'userGroups' ?>" class="nav-link">
                        <i class="nav-icon fas fa-object-group"></i>
                        <p>
                            Groups

                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= ROOT_LINK . 'privileges' ?>" class="nav-link">
                        <i class="nav-icon fas fa-user-lock"></i>
                        <p>
                            Group Privileges
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= ROOT_LINK . 'category' ?>" class="nav-link">
                        <i class="nav-icon fas fa-procedures"></i>
                        <p>
                            Categories

                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= ROOT_LINK . "supplier" ?>" class="nav-link">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>
                            Suppliers

                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= ROOT_LINK . "client" ?>" class="nav-link">
                        <i class="nav-icon fas fa-child"></i>
                        <p>
                            Clients

                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= ROOT_LINK . 'product' ?> " class="nav-link">
                        <i class="nav-icon fas fa-desktop"></i>
                        <p>
                            Products

                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= ROOT_LINK . 'authentication/logout' ?> " class="nav-link">
                        <i class="nav-icon fas fa-arrow-alt-circle-left"></i>
                        <p>
                            Logout

                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
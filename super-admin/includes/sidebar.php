<?php
require_once 'constant.php';

  $adimin_url = SITEURL.'super-admin/'
?>
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="<?= $adimin_url ?>index.php">
              <i class="ti-shield menu-icon"></i>
              <span class="menu-title">Control panel</span>
            </a>
          </li>
          
          <div>
            <hr>
            <p>User section</p>
            <hr>
          </div>
          <li class="nav-item">
            <a class="nav-link" href="<?= $adimin_url ?>all-users.php">
              <i class="ti-view-list-alt menu-icon"></i>
              <span class="menu-title">All users</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="verify-model-profile.php">
              <i class="ti-layout-list-post menu-icon"></i>
              <span class="menu-title">Accept Model Profile</span>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="add-testimonials.php">
              <i class="ti-layout-list-post menu-icon"></i>
              <span class="menu-title">Testimonial</span>
            </a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="<?= $adimin_url ?>new_broadcasters.php">
              <i class="ti-layout-list-post menu-icon"></i>
              <span class="menu-title">New Broadcaster's</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=ADMINURL?>withdrawal/">
              <i class="ti-layout-list-post menu-icon"></i>
              <span class="menu-title">Withdrawal Request's</span>
            </a>
          </li>
          <hr>
            <p>Contact us query</p>
          <hr>
          <li class="nav-item">
            <a class="nav-link" href="<?= $adimin_url ?>general-contact-query.php">
              <i class="ti-layout-list-post menu-icon"></i>
              <span class="menu-title">General query</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= $adimin_url ?>users-contact-query.php">
              <i class="ti-layout-list-post menu-icon"></i>
              <span class="menu-title">User's query</span>
            </a>
          </li>
          <hr>
            <p>Service section</p>
            <hr>
          <li class="nav-item">
            <a class="nav-link" href="<?= $adimin_url ?>group-show-service.php">
              <i class="ti-layout-list-post menu-icon"></i>
              <span class="menu-title">Group show</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= $adimin_url ?>international-tour-service.php">
              <i class="ti-layout-list-post menu-icon"></i>
              <span class="menu-title">International call</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= $adimin_url ?>dating-assignment-services.php">
              <i class="ti-layout-list-post menu-icon"></i>
              <span class="menu-title">Dating Assignment</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= $adimin_url ?>movie-modeling-service.php">
              <i class="ti-layout-list-post menu-icon"></i>
              <span class="menu-title">Movie & modeling</span>
            </a>
          </li>
          <hr><p>Sale/Purchase details</p><hr>
          <li class="nav-item">
            <a class="nav-link" href="<?= $adimin_url ?>purchase-details.php">
              <i class="ti-layout-list-post menu-icon"></i>
              <span class="menu-title">Purchase Details</span>
            </a>
          </li>

          <hr><p>Report Users</p><hr>
          <li class="nav-item">
            <a class="nav-link" href="<?= $adimin_url ?>report-users.php">
              <i class="ti-layout-list-post menu-icon"></i>
              <span class="menu-title">Reported Users List</span>
            </a>
          </li>


          <hr><p>Refund Coins</p><hr>
          <li class="nav-item">
            <a class="nav-link" href="<?= $adimin_url ?>refund-coins.php">
              <i class="ti-layout-list-post menu-icon"></i>
              <span class="menu-title">Refund Coins</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= $adimin_url ?>all-refunded-coins.php">
              <i class="ti-layout-list-post menu-icon"></i>
              <span class="menu-title">All Refunded Coins</span>
            </a>
          </li>

          <hr><p>Admin Settings</p><hr>

          <li class="nav-item">
            <a class="nav-link" href="<?= $adimin_url ?>admin_setting.php">
              <i class="ti-layout-list-post menu-icon"></i>
              <span class="menu-title">Settings</span>
            </a>
          </li>

        </ul>
      </nav>
      <!-- partial -->
      
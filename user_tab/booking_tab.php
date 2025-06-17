<style>
  @media (max-width: 768px) {
    .new-tabs>li {
      min-width: 173px;
    }
  }
</style>
<ul class="nav nav-tabs mb-3 new-tabs ">
  <li class="nav-item <?= isset($activeTab) && $activeTab == 'dating_booking' ? 'active' : '' ?>">
    <a class="nav-link " href="<?= SITEURL ?>dating_booking">Dating Booking</a>
  </li>
  <li class="nav-item <?= isset($activeTab) && $activeTab == 'group-show' ? 'active' : '' ?>">
    <a class="nav-link " href="<?= SITEURL ?>user/group-show">Group Show</a>
  </li>
  <li class="nav-item <?= isset($activeTab) && $activeTab == 'international-tours-booking' ? 'active' : '' ?>">
    <a class="nav-link " href="<?= SITEURL ?>user/international-tours-booking">International Tours</a>
  </li>
  <li class="nav-item <?= isset($activeTab) && $activeTab == 'movie-assignments-booking' ? 'active' : '' ?>">
    <a class="nav-link " href="<?= SITEURL ?>user/movie-assignments-booking">Movie/Modeling Assignments</a>
  </li>
  <!--  <li class="nav-item">
    <a class="nav-link active" href="user/bankdetails">Account</a>
  </li>-->
</ul>
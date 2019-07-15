<nav class="navbar navbar-expand-md" style="border-bottom: solid 1px #c5c5c563;">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center Button -primary" href="<?php echo base_url(); ?>" title="Home"><?php echo site_name(); ?></a>
    <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
      <span class="icon-menu Icon"></span>
    </button> -->

    <div class="collapse navbar-collapse" id="myNavbar" style="height: 0px;" aria-expanded="false">
      <ul class="navbar-nav ml-auto">
        <?php if ($this->session->userdata('logged_in')): ?>
        <li class="nav-item ">
          <a class="nav-link" href="<?php echo site_url('logout'); ?>">Logout</a>
        </li>
      <?php endif; ?>

      </ul>

    </div>
  </div>
</nav>

<div class="container pt-5 pb-5">
  <div class="col-md-5 mx-auto">
    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $this->session->flashdata('error'); ?>
        <button type="button" class="close button-close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $this->session->flashdata('success'); ?>
        <button type="button" class="close button-close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>
    <form action="<?php echo site_url('login'); ?>" method="post" accept-charset="utf-8">
      <div class="card fat">
        <div class="card-body">
          <h4 class="card-title">Log In</h4>
          <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username" autofocus="" required="">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="">
          </div>
          <button type="submit" class="btn btn-primary" style="float:right;">Log In</button>
        </div>

      </div>
    </form>
  </div>
</div>

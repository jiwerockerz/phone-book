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

  <form action="<?php echo site_url('contact/add-contact'); ?>" method="post" accept-charset="utf-8">
    <div class="card fat">
      <div class="card-body">
        <h4 class="card-title">Add New Contact</h4>
        <div class="form-group">
          <input type="text" class="form-control" name="name" placeholder="Name" autofocus="" required>
        </div>
        <div class="form-group">
          <input type="text" pattern="[0-9]*" class="form-control" name="phone-number" placeholder="Phone Number" required>
        </div>
        <div class="form-row">
          <div class="form-group col-md-7">
            <select name="group-name" class="form-control">
              <option value="0">None</option>
              <?php foreach ($groups as $group): ?>
                <option value="<?php echo $group['id']; ?>"><?php echo $group['group_name']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group col-md-3">
            <a href="#"class="btn btn-light" data-toggle="modal" data-target="#newgroupModal">Create new group</a>
          </div>
        </div>
        <button type="submit" class="btn btn-primary" style="float:right;">Submit</button>
      </div>

    </div>
  </form>
</div>

<!-- Modal -->
<div class="modal fade" id="newgroupModal" tabindex="-1" role="dialog" aria-labelledby="newgroupModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="<?php echo site_url('contact/add-group'); ?>" method="post" accept-charset="utf-8">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newgroupModalLabel">Create new group</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" name="group-name" placeholder="Group Name" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="container p-5">
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

  <form action="<?php echo site_url('contact/edit/').$contacts['id']; ?>" method="post" accept-charset="utf-8">
  <table class="table table-striped table-hover table-bordered dashboard-table">
    <tbody>
      <tr>
        <th>Avatar</th>
        <td>
          <img src="http://www.gravatar.com/avatar/64e1b8d34f425d19e1ee2ea7236d3028.jpg?s=80&amp;d=mm&amp;r=g" class="user-profile-image">
        </td>
      </tr>
      <tr>
        <th>Name</th>
        <td>
          <div class="form-group">
            <input type="text" class="form-control" name="name" value="<?php echo $contacts['name']; ?>" placeholder="Name" autofocus="" required>
          </div>
        </td>
      </tr>
      <tr>
        <th>Phone Number</th>
        <td>
          <div class="form-group">
            <input type="text" pattern="[0-9]*" class="form-control" name="phone-number" value="<?php echo $contacts['phone_num']; ?>" placeholder="Phone Number" required>
          </div>
        </td>
      </tr>
      <tr>
        <th>Group</th>
        <td>
          <div class="form-row">
            <div class="form-group col-md-7">
              <select name="group-name" class="form-control">
                <option value="0" selected>None</option>
                <?php foreach ($groups as $group): ?>
                  <option value="<?php echo $group['id']; ?>"><?php echo $group['group_name']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group col-md-3">
              <a href="#"class="btn btn-light" data-toggle="modal" data-target="#newgroupModal">Create new group</a>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <th>Actions</th>
        <td>
          <button type="submit" class="btn btn-primary btn-xs">Save</button>
        </td>
      </tr>
    </tbody>
  </table>
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

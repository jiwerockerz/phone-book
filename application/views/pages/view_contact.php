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
          <?php echo $contacts['name']; ?>
        </td>
      </tr>
      <tr>
        <th>Phone Number</th>
        <td>
          <?php echo $contacts['phone_num']; ?>
        </td>
      </tr>
      <tr>
        <th>Group</th>
        <td>
          <?php echo $groups; ?>
        </td>
      </tr>
      <tr>
        <th>Actions</th>
        <td>
          <a href="<?php echo site_url('contact/edit/').$contacts['id']; ?>" class="btn btn-primary btn-xs">Edit Information</a>
        </td>
      </tr>
    </tbody>
  </table>
</div>

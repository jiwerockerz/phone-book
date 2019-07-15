<style media="screen">
.my-custom-scrollbar {
  position: relative;
  height: 500px;
  overflow: auto;
}
.table-wrapper-scroll-y {
  display: block;
}
</style>

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

<div class="row p-3" style="float:right;">
  <a href="<?php echo site_url('contact/add-contact'); ?>" class="btn btn-light">Add New</a>

</div>
<div class="container p-5">
  <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
    <table class="table table-striped">
      <thead>
        <tr class="d-flex">
          <th class="col-2">#</th>
          <th class="col-5">Name</th>
          <th class="col-5">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $n = 1;
        foreach ($contacts as $contact): ?>
        <tr class="d-flex">
          <th class="col-sm-2"><?php echo $n++; ?></th>
          <td class="col-sm-5"><?php echo $contact['name']; ?></td>
          <td class="col-sm-5">
            <a href="<?php echo site_url('contact/view/').$contact['id']; ?>" class="btn" title="View"><i class="fa  fa-eye"></i></a>
            <a href="<?php echo site_url('contact/edit/').$contact['id']; ?>" class="btn" title="Edit"><i class="fa fa-edit"></i></a>
            <form action="<?php echo site_url('contact/delete-contact'); ?>" method="post" accept-charset="utf-8" style="display: inline-block;">
              <input type="hidden" name="user-id" value="<?php echo $contact['id']; ?>">
              <button class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>


</div>
</div>

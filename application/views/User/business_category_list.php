<!DOCTYPE html>
<html>

<style>
  td{
    padding:2px 10px !important;
  }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 mt-1">
            <h4>BUSINESS CATEGORY INFORMATION</h4>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-list"></i> List Business Category Information</h3>
              <div class="card-tools">
                <a href="<?php echo base_url() ?>User/business_category" class="btn btn-sm btn-block btn-primary">Add Business Category</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Business Category Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 0;
                  foreach ($bc_list as $b_list) {
                    $i++; ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $b_list->business_category_name ?></td>
                    <td>
                      <a href="<?php echo base_url(); ?>User/edit_business_category/<?php echo $b_list->business_category_id; ?>"> <i class="fa fa-edit"></i> </a>
                      <a href="<?php echo base_url(); ?>User/delete_business_category/<?php echo $b_list->business_category_id; ?>" onclick="return confirm('Delete this User');" class="ml-4"> <i class="fa fa-trash"></i> </a>
                    </td>
                  </tr>
                    <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>

</body>
</html>

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
            <h4>PRODUCT / SERVICE  CATEGORY INFORMATION</h4>
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
              <h3 class="card-title"><i class="fa fa-list"></i> List Product / Service Category Information</h3>
              <div class="card-tools">
                <a href="<?php echo base_url() ?>User/product_category" class="btn btn-sm btn-block btn-primary">Add Product category</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Product Category Name</th>
                  <th>Product Type</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 0;
                  foreach ($p_category_list as $p_category_list) {
                    $i++; ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $p_category_list->product_category_name ?></td>
                    <td><?php echo $p_category_list->product_category_type ?></td>
                    <td>
                      <a href="<?php echo base_url(); ?>User/edit_product_category/<?php echo $p_category_list->product_category_id; ?>"> <i class="fa fa-edit"></i> </a>
                      <a href="<?php echo base_url(); ?>User/delete_product_category/<?php echo $p_category_list->product_category_id; ?>" onclick="return confirm('Delete this User');" class="ml-4"> <i class="fa fa-trash"></i> </a>
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

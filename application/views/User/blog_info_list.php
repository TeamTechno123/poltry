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
            <h4>BLOG INFORMATION</h4>
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
              <h3 class="card-title"><i class="fa fa-list"></i> List Blog Information</h3>
              <div class="card-tools">
                <a href="<?php echo base_url() ?>User/blog_info" class="btn btn-sm btn-block btn-primary">Add Blog</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Blog Title</th>
                  <th>blog_status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 0;
                  foreach ($blog_list as $blog_list1) {
                    $i++; ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $blog_list1->blog_info_name ?></td>
                    <td><?php echo $blog_list1->blog_status ?></td>
                    <td>
                      <a href="<?php echo base_url(); ?>User/edit_blog_info/<?php echo $blog_list1->blog_id; ?>"> <i class="fa fa-edit"></i> </a>
                      <a href="<?php echo base_url(); ?>User/delete_blog_info/<?php echo $blog_list1->blog_id; ?>" onclick="return confirm('Delete this User');" class="ml-4"> <i class="fa fa-trash"></i> </a>
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

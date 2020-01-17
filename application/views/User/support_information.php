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
            <h4>SUPPORT INFORMATION</h4>
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
              <h3 class="card-title"><i class="fa fa-list"></i> List Support Information</h3>
              <!-- <div class="card-tools">
                <a href="<?php echo base_url() ?>User/advertise_information" class="btn btn-sm btn-block btn-primary">Add Advertisement</a>
              </div> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Name Of User</th>
                  <th>Mobile No.</th>
                  <th>City </th>
                  <th>Support Query</th>
                  <th>Reply</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Demo User</td>
                    <td>9876543210</td>
                    <td>Kolhapur</td>
                    <td>abcd</td>
                    <td><button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal">
                    Reply</button></td>
                    <td>Active</td>
                  </tr>
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

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reply</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group col-md-12">
          <textarea class="form-control" rows="3" name="" id="" placeholder="Reply"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

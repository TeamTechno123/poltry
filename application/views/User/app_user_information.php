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
            <h4>APP USER INFORMATION</h4>
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
              <h3 class="card-title"><i class="fa fa-list"></i> List App User Information</h3>
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
                  <th>DOB</th>
                  <th>Gender</th>
                  <th>Approve</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 0;
                   foreach ($app_user_list as $app_user_list) {
                     $i++; ?>
                   <tr>
                     <td><?php echo $i; ?></td>
                     <td><?php echo $app_user_list->app_user_name; ?></td>
                     <td><?php echo $app_user_list->app_user_mobile; ?></td>
                     <td><?php echo $app_user_list->app_user_city; ?></td>
                     <td><?php echo $app_user_list->app_user_dob; ?></td>
                     <td><?php echo $app_user_list->app_user_gender; ?></td>
                     <td><button class="btn btn-outline-info btn_open_modal" app_user_id="<?php echo $app_user_list->app_user_id; ?>" app_user_status="<?php echo $app_user_list->app_user_status; ?>"  data-toggle="modal" data-target="#exampleModal">
                     Approve</button></td>
                      <td><?php echo $app_user_list->app_user_status; ?></td>
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
            <form class="" action="" method="post">
                <input type="hidden"  id="app_user_id" name="app_user_id">
                  <input type="hidden"  id="app_user_status" name="app_user_status">

                  <div class="row">
                  <div class="form-group col-md-2  col-4 mb-0">
                    <label for="">Status : </label>
                  </div>
                  <div class="form-group col-md-2 col-4 mb-0">
                    <div class="form-check">
                      <input class="form-check-input" id="active"  value="active"  type="radio" name="app_user_status">
                      Active
                    </div>
                  </div>
                  <div class="form-group col-md-2 col-4 mb-0">
                    <div class="form-check">
                      <input class="form-check-input" id="inactive" value="inactive"  type="radio" name="app_user_status">
                      Inactive
                    </div>
                  </div>
                </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" id="btn_msg_send" data-dismiss="modal" class="btn btn-primary">Send</button>
          </div>
        </div>
      </div>
    </div>

    <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
    <script type="text/javascript">
      $('.btn_open_modal').on('click',function(){
        var app_user_id = $(this).attr('app_user_id');
        var app_user_status = $(this).attr('app_user_status');
        var app_user_reply = $(this).attr('app_user_reply');
          $('#reply').val(app_user_reply);
        $('#app_user_id').val(app_user_id);
        if(app_user_status=='active'){
          $("#active").prop("checked", true);
        } else{
            $("#inactive").prop("checked", true);
        }

      });

      $('#btn_msg_send').on('click',function(){
        var app_user_id = $('#app_user_id').val();
        var app_user_status=  $("input[name='app_user_status']:checked"). val();
          $.ajax({
            url:'<?php echo base_url(); ?>Transactional/change_app_user_status',
            method:'post',
            data:{
                  'app_user_id':app_user_id,
                  'app_user_status':app_user_status
                },
            success:function(result){
                toastr.success('Message Sent successfully');
                window.location.replace("<?php echo base_url(); ?>Transactional/app_user_information");
            }
          });

      });
    </script>

</body>
</html>

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
            <h4>POST INFORMATION</h4>
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
              <h3 class="card-title"><i class="fa fa-list"></i> List Post Information</h3>
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
                  <th>Category Of Post</th>
                  <th>Post Name</th>
                  <th>Comments</th>
                  <th>Approve</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 0;
                   foreach ($post_list as $post_list) {
                     $i++; ?>
                   <tr>
                     <td><?php echo $i; ?></td>
                     <td><?php echo $post_list->app_user_name; ?></td>
                     <td><?php echo $post_list->app_user_mobile; ?></td>
                     <td><?php echo $post_list->app_user_city; ?></td>
                     <td><?php echo $post_list->post_category; ?></td>
                     <td><?php echo $post_list->post_name; ?></td>
                      <td><?php echo $post_list->post_comments; ?></td>
                      <td><button class="btn btn-outline-info btn_open_modal" post_id="<?php echo $post_list->post_id; ?>" post_status="<?php echo $post_list->post_status; ?>"  data-toggle="modal" data-target="#exampleModal">
                      Approve</button></td>
                      <td><?php echo $post_list->post_status; ?></td>
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
              <input type="hidden"  id="post_id" name="post_id">
                <input type="hidden"  id="post_status" name="post_status">

                <div class="row">
                <div class="form-group col-md-2  col-4 mb-0">
                  <label for="">Status : </label>
                </div>
                <div class="form-group col-md-2 col-4 mb-0">
                  <div class="form-check">
                    <input class="form-check-input" id="active"  value="active"  type="radio" name="post_status">
                    Active
                  </div>
                </div>
                <div class="form-group col-md-2 col-4 mb-0">
                  <div class="form-check">
                    <input class="form-check-input" id="inactive" value="inactive"  type="radio" name="post_status">
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
      var post_id = $(this).attr('post_id');
      var post_status = $(this).attr('post_status');
      var post_reply = $(this).attr('post_reply');
        $('#reply').val(post_reply);
      $('#post_id').val(post_id);
      if(post_status=='active'){
        $("#active").prop("checked", true);
      } else{
          $("#inactive").prop("checked", true);
      }

    });

    $('#btn_msg_send').on('click',function(){
      var post_id = $('#post_id').val();
      var post_status=  $("input[name='post_status']:checked"). val();
        $.ajax({
          url:'<?php echo base_url(); ?>Transactional/change_post_status',
          method:'post',
          data:{
                'post_id':post_id,
                'post_status':post_status
              },
          success:function(result){
              toastr.success('Message Sent successfully');
              window.location.replace("<?php echo base_url(); ?>Transactional/post_information");
          }
        });

    });
  </script>

</body>
</html>

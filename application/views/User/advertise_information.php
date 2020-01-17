<!DOCTYPE html>
<html>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-center mt-2">
            <h1>ADVERTISEMENT INFORMATION</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8 offset-md-2">
            <!-- general form elements -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Advertisement Information</h3>
              </div>


              <!-- /.card-header -->
              <!-- form start -->
              <form id="form_action" role="form" action="" method="post" enctype="multipart/form-data">
                <div class="card-body row">
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control required title-case text" name="advertisement_name" id="advertisement_name" value="<?php if(isset($advertisement_name)){ echo $advertisement_name; } ?>" placeholder="Enter Advertisement Name" required>
                  </div>
                  <div class="form-group col-md-12">
                    <textarea class="form-control" rows="3" name="advertisement_details" id="advertisement_details" placeholder="Advertisement Details"><?php if(isset($advertisement_details)){ echo $advertisement_details; } ?></textarea>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="file" name="package_img" id="package_img" class="form-control" id="exampleInputFile">
                  </div>
                  <?php if(isset($package_img)){ ?>
                  <div class="form-group col-md-6">
                    <img style="height:150px; width:150px;" src="<?php echo base_url(); ?>assets/images/product/<?php echo $package_img; ?>" alt="">
                  </div>
                  <input type="hidden" name="img_old" value="<?php echo $package_img; ?>">
                  <?php } ?>
                  <div class="col-md-6">

                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control date" name="advertisement_sdate" id="date1" value="<?php if(isset($advertisement_sdate)){ echo $advertisement_sdate; } ?>" data-target="#date1" data-toggle="datetimepicker" placeholder="Start Date">
                  </div>
                  <div class="form-group col-md-6">
                  <input type="text" class="form-control date" name="advertisement_edate" id="date2" value="<?php if(isset($advertisement_edate)){ echo $advertisement_edate; } ?>" data-target="#date2" data-toggle="datetimepicker" placeholder="End Date">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <?php if(isset($update)){ ?>
                    <button id="btn_update" type="submit" class="btn btn-primary">Update </button>
                  <?php } else{ ?>
                    <button id="btn_save" type="submit" class="btn btn-success px-4">Add</button>
                  <?php } ?>
                  <a href="<?php echo base_url() ?>User/dashboard" class="btn btn-default ml-4">Cancel</a>
                </div>
              </form>
            </div>

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>

<?php if($this->session->flashdata('check_mobile')){
  $form_data = $this->session->flashdata('form_data');
?>
<script type="text/javascript">
  $(document).ready(function(){
    <?php foreach ($form_data as $key => $value) { ?>
      $('#<?php echo $key; ?>').val('<?php echo $value; ?>');
    <?php  } ?>
    toastr.error('Mobile Number Exist.');
  });
</script>
<?php } ?>

<script type="text/javascript">
// Update Click...
$('#btn_update, #btn_save').on('click',function(){
  $('.required').each(function(){
     var val = $(this).val();
     if(val == '' || val == '0'){
       $(this).addClass('required-input');
     }
     else{
       $(this).removeClass('required-input');
     }
  });
  if ($(".required-input")[0] || $(".invalide-input")[0]){
    // Dont Submit...
  } else {
      $('#form_action').submit();
  }
});
</script>


</body>
</html>

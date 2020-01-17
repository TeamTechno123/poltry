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
            <h1>PRODUCT / SERVICE INFORMATION</h1>
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
                <h3 class="card-title">Product / Service Information</h3>
              </div>


              <!-- /.card-header -->
              <!-- form start -->
              <form id="form_action" role="form" action="" method="post" enctype="multipart/form-data">
                <div class="card-body row">
                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" data-placeholder="Select Type" name="business_type">
                         <option selected="selected" value="" >Select Type</option>
                        <option  value="Product" <?php if(isset($business_type) && $business_type == 'Product' ){ echo 'selected'; } ?> >Product</option>
                        <option  value="Service" <?php if(isset($business_type) && $business_type == 'Service' ){ echo 'selected'; } ?> >Service</option>
                    </select>
                  </div>

                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" data-placeholder="Select Category" name="product_category_id">
                         <option selected="selected" value="" >Select Category</option>
                         <?php foreach ($p_category_list as $list) { ?>
                      <option value="<?php echo $list->product_category_id ?>" <?php if(isset($product_category_id) && $product_category_id == $list->product_category_id ){ echo 'selected'; } ?>><?php echo $list->product_category_name; ?></option>
                    <?php  } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control required" name="product_name" id="product_name" value="<?php if(isset($product_name)){ echo $product_name; } ?>" placeholder="Enter Name Of Product / Service" required>
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

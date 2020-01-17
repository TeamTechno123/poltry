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
            <h1>BUSINESS  INFORMATION</h1>
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
                <h3 class="card-title">Business Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <form id="form_action" role="form" action="" method="post" enctype="multipart/form-data">
                    <!-- <input type="text" name="business_id" value="<?php echo $business_id; ?>"> -->
                <div class="card-body row">
                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" name="business_category_id" title="Select Type Of Business Category" data-placeholder="Select Type Of Business Category" >
                         <option selected="selected" value="" >Select Type Of Business Category</option>
                         <?php foreach ($b_category_list as $list) { ?>
                      <option value="<?php echo $list->business_category_id ?>" <?php if(isset($business_category_id) && $business_category_id == $list->business_category_id ){ echo 'selected'; } ?>><?php echo $list->business_category_name; ?></option>
                    <?php  } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control text" name="business_name" id="business_name"  title="Enter Business Name" placeholder="Enter Business Name" value="<?php if(isset($business_name)){ echo $business_name; } ?>" required>
                  </div>
                  <div class="form-group col-md-12">
                    <textarea class="form-control" rows="3" name="business_address" id="business_address" title="Enter Business Address" placeholder="Enter Business Address"><?php if(isset($business_address)){ echo $business_address; } ?></textarea>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control required mobile" name="business_mobile1" id="business_mobile1"  title="Enter Mobile No. 1"  placeholder="Enter Mobile No. 1" value="<?php if(isset($business_mobile1)){ echo $business_mobile1; } ?>" required>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control required mobile" name="business_mobile2" id="business_mobile2"  title="Enter Mobile No. 2" placeholder="Enter Mobile No. 2" value="<?php if(isset($business_mobile2)){ echo $business_mobile2; } ?>" >
                  </div>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control required mobile" name="business_email" id="business_email"  title="Enter Email" placeholder="Enter Email" value="<?php if(isset($business_email)){ echo $business_email; } ?>" required>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control required mobile" name="business_website" id="business_website"  title="Enter Website" placeholder="Enter Website" value="<?php if(isset($business_website)){ echo $business_website; } ?>" >
                  </div>
                  <div class="form-group col-md-6">
                      </div>
                  <div class="form-group text-right col-md-6">
                      <button type="button"  id="add_row" class="btn btn-sm btn-primary px-4">Add More </button>
                  </div>
                  <table id="myTable" class="table table-bordered mb-4 tbl_cust1">
                    <?php if(isset($business_trans_data)){
                  $i = 0;
                  $j = 0;
                  foreach ($business_trans_data as $trans_data) {
                  $j++;  ?>
                  <input type="hidden" name="input[<?php echo $i; ?>][business_trans_id]" value="<?php echo $trans_data->business_trans_id; ?>">
                  <tr>
                    <td>
                      <select class="form-control form-control-sm" name="input[<?php echo $i; ?>][business_type]"   title="Select Type">
                        <option selected="selected" value="" >Select Type</option>
                       <option  value="Product" <?php if(isset($trans_data->business_type) && $trans_data->business_type == 'Product' ){ echo 'selected'; } ?> >Product</option>
                       <option  value="Service" <?php if(isset($trans_data->business_type) && $trans_data->business_type == 'Service' ){ echo 'selected'; } ?> >Service</option>
                      </select>
                    </td>
                    <td>
                      <select class="form-control form-control-sm" data-placeholder="Select Category Name" id="select_category" name="input[<?php echo $i; ?>][product_category_id]" title="Select Category Name">
                        <option selected="selected">Select Category Name </option>
                        <?php foreach ($p_category_list as $p_category_list1) { ?>
                        <option value="<?php echo $p_category_list1->product_category_id; ?>" <?php if ($trans_data->product_category_id == $p_category_list1->product_category_id){ echo 'selected'; } ?>><?php echo $p_category_list1->product_category_name; ?></option>
                      <?php } ?>
                      </select>
                    </td>
                    <td>
                      <select class="form-control form-control-sm" name="input[<?php echo $i; ?>][product_id]"  title="Select Product">
                        <option selected="selected">Select Product </option>
                        <?php foreach ($product_list as $product_list1) { ?>
                        <option value="<?php echo $product_list1->product_id; ?>" <?php if ($trans_data->product_id == $product_list1->product_id){ echo 'selected'; } ?>><?php echo $product_list1->product_name; ?></option>
                      <?php } ?>
                      </select>
                    </td>
                    <td> <?php if($i>0) { ?> <a> <i class="fa fa-trash text-danger"></i></a> <?php } ?></td>
                  </tr>
                <?php  $i++;  }  } else{ ?>
                    <tr>
                      <td>
                        <select class="form-control form-control-sm" name="input[0][business_type]"   title="Select Type">
                          <option selected="selected" value="" >Select Type</option>
                         <option  value="Product" <?php if(isset($business_type) && $business_type == 'Product' ){ echo 'selected'; } ?> >Product</option>
                         <option  value="Service" <?php if(isset($business_type) && $business_type == 'Service' ){ echo 'selected'; } ?> >Service</option>
                        </select>
                      </td>
                      <td>
                        <select class="form-control form-control-sm" data-placeholder="Select Category Name" id="select_category" name="input[0][product_category_id]" title="Select Category Name">
                          <option selected="selected">Select Category Name </option>
                          <?php foreach ($p_category_list as $p_category_list1) { ?>
                          <option value="<?php echo $p_category_list1->product_category_id; ?>"><?php echo $p_category_list1->product_category_name; ?></option>
                        <?php } ?>
                        </select>
                      </td>
                      <td>
                        <select class="form-control form-control-sm" name="input[0][product_id]"  title="Select Product">
                          <option selected="selected">Select Product </option>
                          <?php foreach ($product_list as $product_list1) { ?>
                          <option value="<?php echo $product_list1->product_id; ?>"><?php echo $product_list1->product_name; ?></option>
                        <?php } ?>
                        </select>
                      </td>
                      <td></td>
                    </tr>
                  <?php } ?>
                  </table>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control " name="working_hours" id="working_hours" value="<?php if(isset($working_hours)){ echo $working_hours; } ?>" title="Working Hours" placeholder="Working Hours" required>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control " name="working_days" id="working_days" value="<?php if(isset($working_days)){ echo $working_days; } ?>" title="Working Days" placeholder="Working Days" required>
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
                  <div class="form-check">
                    <input type="checkbox" name="business_status" <?php if(isset($business_status)&& $business_status=='deactivate') { echo 'checked'; } ?> value="deactivate" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label"  for="exampleCheck1">Deactivate This Listing</label>
                  </div>
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


  <script type="text/javascript">
   <?php if(isset($update)){ ?> var i=<?php echo $i-1; ?>;  <?php } else{ ?> var i=0; <?php } ?>
  $('#add_row').click(function(){
 i++;
 var row = '<tr>'+
           '<td>'+
             '<select class="form-control select2 form-control-sm" name="input['+i+'][business_type]"  title="Select Type">'+
               '<option selected="selected">Select Type </option>'+
               '<option  value="Product" <?php if(isset($business_type) && $business_type == 'Product' ){ echo 'selected'; } ?> >Product</option>'+
               '<option  value="Service" <?php if(isset($business_type) && $business_type == 'Service' ){ echo 'selected'; } ?> >Service</option>'+
             '</select>'+
           '</td>'+
           '<td>'+
             '<select class="form-control select2 form-control-sm" name="input['+i+'][product_category_id]" title="Select Category Name">'+
               '<option selected="selected">Select Category Name </option>'+
               <?php foreach ($p_category_list as $p_category_list1) { ?>
               '<option value="<?php echo $p_category_list1->product_category_id; ?>"><?php echo $p_category_list1->product_category_name; ?></option>'+
             <?php } ?>
             '</select>'+
           '</td>'+
           '<td>'+
             '<select class="form-control select2 form-control-sm" name="input['+i+'][product_id]" title="Select Name">'+
               '<option selected="selected">Select Name </option>'+
               <?php foreach ($product_list as $product_list1) { ?>
               '<option value="<?php echo $product_list1->product_id; ?>"><?php echo $product_list1->product_name; ?></option>'+
             <?php } ?>
             '</select>'+
           '</td>'+
            '<td><a><i class="fa fa-trash text-danger"></i></a></td>'+
         '</tr>';
 $('#myTable').append(row);
 });

 $('#myTable').on('click', 'a', function () {
    $(this).closest('tr').remove();
  });
  </script>

</body>
</html>

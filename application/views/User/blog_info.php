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
            <h1>BLOG INFORMATION</h1>
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
                <h3 class="card-title">Blog Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="form_action" role="form" action="" method="post" >
                <div class="card-body row">

                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" title="Select Category" data-placeholder="Select Category" name="blog_category_id">
                         <option selected="selected" value="" >Select Category</option>
                         <?php foreach ($blogc_list as $list) { ?>
                      <option value="<?php echo $list->blog_category_id ?>" <?php if(isset($blog_category_id) && $blog_category_id == $list->blog_category_id ){ echo 'selected'; } ?>><?php echo $list->blog_category_name; ?></option>
                    <?php  } ?>
                    </select>
                  </div>

                  <div class="form-group col-md-12">
                    <input type="text" class="form-control required title-case text" name="blog_info_name" id="blog_info_name" value="<?php if(isset($blog_info_name)){ echo $blog_info_name; } ?>"  title="Enter Title Of Blog"  placeholder="Enter Title Of Blog" required>
                  </div>

                  <div class="form-group col-md-12">
                    <section class="content">
                      <div class="row">
                        <div class="col-md-12">
                                <textarea class="textarea" name="blog_details" placeholder="Place some text here"
                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> <?php if(isset($blog_details)){ echo $blog_details; } ?> </textarea>

                          </div>
                        </div>

                    </section>
                  </div>

                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" title="Select public Status" data-placeholder="Select public Status" name="blog_status">
                         <option selected="selected" value="" >Select public Status</option>
                         <option  value="Public" <?php if(isset($blog_status) && $blog_status == 'Public' ){ echo 'selected'; } ?> >Public</option>
                         <option  value="Draft" <?php if(isset($blog_status) && $blog_status == 'Draft' ){ echo 'selected'; } ?> >Draft</option>
                    </select>
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

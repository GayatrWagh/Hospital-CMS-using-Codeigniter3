<?php $this->load->view('admin/header'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Appointment</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Appointment</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">

        <?php if($this->session->flashdata('success')!=""){?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success');?></div>
        <?php } ?>
        <?php if($this->session->flashdata('error')!=""){?>
        <div class="alert alert-danger"><?php echo $this->session->flashdata('error');?></div>
        <?php } ?>

        <div class="card">
          <div class="card-header">
            <div class="card-title">
              <form id="SearchFrm" name="SearchFrm" method="get" action="">
                <div class="input-group mb-0">
                  <input type="text" value="<?php echo $queryString;?>" class="form_control" placeholder="Search" name="q">
                  <div class="input-group-append">
                    <button class="input-group-text" id="basic-addon1">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Appointment Date</th>
                  <th>Department</th>
                  <th>Doctor</th>
                  <th>Message</th>
                  <th>Status</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($appointments)) {?>
                  <?php foreach($appointments as $appointmentRow) {?>
                    <tr>
                      <td><?php echo $appointmentRow['id'];?></td>
                      <td><?php echo $appointmentRow['name'];?></td>
                      <td><?php echo $appointmentRow['email'];?></td>
                      <td><?php echo $appointmentRow['phone'];?></td>
                      <td><?php echo $appointmentRow['app_date'];?></td>
                      <td><?php echo $appointmentRow['department'];?></td>
                      <td><?php echo $appointmentRow['doctor'];?></td>
                      <td><?php echo $appointmentRow['message'];?></td>
                      <td  class="text-center">
                      <a href="" class="btn btn-primary btn-sm btn-approve" data-appointment-id="<?php echo $appointmentRow['id']; ?>">
                      <i class="fa fa-check" style="color:white"></i>
                    </a>
                    <a href="" class="btn btn-danger btn-sm btn-cancel" data-appointment-id="<?php echo $appointmentRow['id']; ?>">
                    <i class="fa fa-close" style="color:white"></i>
                  </a>
                  </td>
                      
                    </tr>

                  <?php } ?>
                <?php } else { ?>
                  <tr>
                    <td colspan="9">Records not Found</td> 
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <?php echo isset($pagination_links) ? $pagination_links : ''; ?>
          </div>
          
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('admin/footer'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$.noConflict();
// Now you can use jQuery with the 'jQuery' keyword instead of '$'
jQuery(document).ready(function($){
    // $('.btn-approve').click(function() {
    //     var enquiry_id = $(this).data('enquiry-id');
    //     updateStatus(enquiry_id, 'Approved');
    // });
    $('.btn-approve').click(function() {
    var appointment_id = $(this).data('appointment-id');
    console.log('Appointment ID:', appointment_id);
    updateStatus(appointment_id, 'Approved');
});

$('.btn-cancel').click(function() {
    var appointment_id = $(this).data('appointment-id');
    updateStatus(appointment_id, 'Cancelled');
});

function updateStatus(appointment_id, new_status) {
    $.ajax({
        url: '<?php echo base_url("appointment/updateStatus"); ?>', // Correct controller URL
        type: 'POST',
        dataType: 'json',
        data: {
            appointment_id: appointment_id, // Correct data attribute name
            new_status: new_status
        },
        success: function(response) {
            if (response.success) {
                location.reload();
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
});
</script>

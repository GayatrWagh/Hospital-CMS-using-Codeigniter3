<?php $this->load->view('admin/header'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Appointment</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/appointment/index'?>">Categories</a></li>
                    <li class="breadcrumb-item active">Edit Appointment</li>
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
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">
                            Edit Appointment
                        </div>
                    </div>
                    <form name="appointmentform" id="appointmentform" method="post" action="<?php echo base_url().'admin/appointment/edit/'.$appointment['id']; ?>" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" id="title" value="<?php echo set_value('title',$appointment['title']);?>" class="form-control <?php echo (form_error('title') != '') ? 'is-invalid' : '';?>" >
                                <?php echo form_error('title');?>
                            </div>
                            <div class="form-group">
                                <label>Heading</label>
                                <input type="text" name="heading" id="heading" value="<?php echo set_value('heading',$appointment['heading']);?>" class="form-control <?php echo (form_error('heading') != '') ? 'is-invalid' : '';?>" >
                                <?php echo form_error('heading');?>
                            </div>
                            <div class="form-group">
                                <label>Heading Description</label>
                                <input type="text" name="h_description" id="h_description" value="<?php echo set_value('h_description',$appointment['h_description']);?>" class="form-control <?php echo (form_error('h_description') != '') ? 'is-invalid' : '';?>" >
                                <?php echo form_error('h_description');?>
                            </div>
                            
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" id="address" value="<?php echo set_value('address',$appointment['address']);?>" class="form-control <?php echo (form_error('address') != '') ? 'is-invalid' : '';?>" >
                                <?php echo form_error('address');?>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" id="email" value="<?php echo set_value('email',$appointment['email']);?>" class="form-control <?php echo (form_error('email') != '') ? 'is-invalid' : '';?>" >
                                <?php echo form_error('email');?>
                            </div>
                            <div class="form-group">
                                <label>Call Us</label>
                                <input type="text" name="call_us" id="call_us" value="<?php echo set_value('call_us',$appointment['call_us']);?>" class="form-control <?php echo (form_error('call_us') != '') ? 'is-invalid' : '';?>" >
                                <?php echo form_error('call_us');?>
                            </div>             
                        </div>
                        <div class="card-footer">
                            <button name="submit" type="submit" class="btn btn-primary">Save</button>
                            <a href="<?php echo base_url().'admin/appointment/index'?>" class="btn btn-secondary"> Back</a>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('admin/footer');?>


<?php $this->load->view('admin/header'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Services</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/service/index'?>">Categories</a></li>
                    <li class="breadcrumb-item active">Create New Service</li>
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
                            Create New Service
                        </div>
                    </div>
                    <form name="servicetform" id="serviceform" method="post" action="<?php echo base_url().'admin/service/create'?>" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Service Name</label>
                                <input type="text" name="service_name" id="service_name" value="" class="form-control <?php echo (form_error('service_name') != '') ? 'is-invalid' : '';?>" >
                                <?php echo form_error('service_name');?>
                            </div>
                            <div class="form-group">
                                <label>Service Description</label>
                                <input type="text" name="service_description" id="service_description" value="" class="form-control <?php echo (form_error('service_description') != '') ? 'is-invalid' : '';?>" >
                                <?php echo form_error('service_description');?>
                            </div>
                            
                            <div class="form-group">
                                <label>Image</label> <br>
                                <input type="file" name="image" id="image" class="form-control-file <?php echo (form_error('image') != '') ? 'is-invalid' : ''; ?>">
                                <?php echo form_error('image', '<div class="invalid-feedback">', '</div>'); ?>
                                <?php echo (!empty($errorImageUpload)) ? '<div class="invalid-feedback">' . $errorImageUpload . '</div>' : ''; ?>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?php echo base_url().'admin/service/index'?>" class="btn btn-secondary"> Back</a>
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
<?php $this->load->view('admin/header'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Doctors</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/doctor/index'?>">Doctors</a></li>
                    <li class="breadcrumb-item active">Add New Doctors</li>
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
                            Add New Doctor
                        </div>
                    </div>
                    <form name="departmentform" id="departmentform" method="post" action="<?php echo base_url().'admin/doctor/create'?>" enctype="multipart/form-data">
                        <div class="card-body">
                        <div class="form-group">
                                <label>Department</label>
                                <select name="department_id" id="department_id" class="form-control <?php echo(form_error('department_id')!="") ? 'is-invalid' : '' ;?>">
                                    <option value="">Select a Department</option>
                                    <?php 
                                    if(!empty($departments)) 
                                    {
                                        foreach($departments as $department)
                                        { ?>
                                            <option <?php echo set_select('department_id', $department->id, false); ?> value="<?php echo $department->id; ?>"><?php echo $department->name; ?></option>

                                        <?php }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('department_id');?>
                            
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control <?php echo(form_error('name')!="") ? 'is-invalid' : '' ?>" type="text" name="name" id="name" value="<?php echo set_value('name');?>">                                                                                                                                                                                                                                                                                                                                                                                            
                                <?php echo form_error('name');?>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" id="description" class="textarea"><?php echo set_value('description');?></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label>Image</label> <br>
                                <input type="file" name="image" id="image" class="<?php echo(!empty($imageError)) ? 'is-invalid' : '' ;?>">
                                <?php 
                                if(!empty($imageError)) echo $imageError;
                                ?>
                                
                            </div>
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" name="designation" id="designation" value="<?php echo set_value('designation');?>" class="form-control <?php echo(form_error('designation')!="") ? 'is-invalid' : '' ?>">
                                <?php echo form_error('designation');?>
                            </div>

                            <div class="custom-control custom-radio float-left">
                                <input class="custom-control-input" value="1" type="radio" id="statusActive" name="status" checked="">
                                <label for="statusActive" class="custom-control-label">Active</label>                  
                            </div>
                            <div class="custom-control custom-radio float-left ml-3">
                                <input class="custom-control-input" value="0" type="radio" id="statusBlock" name="status">
                                <label for="statusBlock" class="custom-control-label">Block</label>                  
                            </div>                  
                        </div>
                        <div class="card-footer">
                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?php echo base_url().'admin/doctor/index'?>" class="btn btn-secondary"> Back</a>
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
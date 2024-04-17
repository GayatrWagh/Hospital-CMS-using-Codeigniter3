<?php $this->load->view('admin/header'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Departments</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/department/index'?>">Categories</a></li>
                    <li class="breadcrumb-item active">Edit Department</li>
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
                            Edit Department "<?php echo $department['name'];?>"
                        </div>
                    </div>
                    <form name="departmentform" id="departmentform" method="post" action="<?php echo base_url().'admin/department/edit/'.$department['id']; ?>" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" id="name" value="<?php echo set_value('name',$department['name']);?>" class="form-control <?php echo (form_error('name') != '') ? 'is-invalid' : '';?>" >
                                <?php echo form_error('name');?>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" id="description" value="<?php echo set_value('description',$department['description']);?>" class="form-control <?php echo (form_error('description') != '') ? 'is-invalid' : '';?>" >
                                <?php echo form_error('description');?>
                            </div>
                            
                            <div class="form-group">
                                <label>Image</label> <br>
                                <input type="file" name="image" id="image" class="form-control-file <?php echo (form_error('image') != '') ? 'is-invalid' : ''; ?>">
                                <?php echo form_error('image', '<div class="invalid-feedback">', '</div>'); ?>
                                <?php echo (!empty($errorImageUpload)) ? '<div class="invalid-feedback">' . $errorImageUpload . '</div>' : ''; ?>

                                <br>
                                <?php if($department['image']!="" && file_exists('./public/uploads/department/'.$department['image'])){?>
                                    <img class="mt-3" width="400" height="300" src="<?php echo base_url().'public/uploads/department/'.$department['image'];?>"> 
                                    
                                    <?php } else {?>
                                        <img width="300" height="300" src="<?php echo base_url().'public/uploads/department/No-Image.png';?>">

                                    <?php } ?>
                            </div>

                            <div class="custom-control custom-radio float-left">
                                <input class="custom-control-input" value="1" type="radio" id="statusActive" name="status" <?php echo($department['status']==1) ? 'checked' :''; ?>>
                                <label for="statusActive" class="custom-control-label">Active</label>                  
                            </div>
                            <div class="custom-control custom-radio float-left ml-3">
                                <input class="custom-control-input" value="0" type="radio" id="statusBlock" name="status" <?php echo($department['status']==0) ? 'checked' :''; ?>>
                                <label for="statusBlock" class="custom-control-label">Block</label>                  
                            </div>                  
                        </div>
                        <div class="card-footer">
                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?php echo base_url().'admin/department/index'?>" class="btn btn-secondary"> Back</a>
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
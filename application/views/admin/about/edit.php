<?php $this->load->view('admin/header'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit About</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/about/index'?>">Categories</a></li>
                    <li class="breadcrumb-item active">Edit About</li>
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
                            Edit About 
                        </div>
                    </div>
                    <form name="aboutform" id="aboutform" method="post" action="<?php echo base_url().'admin/about/edit/'.$about['id']; ?>" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" id="title" value="<?php echo set_value('title',$about['title']);?>" class="form-control <?php echo (form_error('title') != '') ? 'is-invalid' : '';?>" >
                                <?php echo form_error('title');?>
                            </div>
                            <div class="form-group">
                                <label>Heading</label>
                                <input type="text" name="heading" id="heading" value="<?php echo set_value('heading',$about['heading']);?>" class="form-control <?php echo (form_error('heading') != '') ? 'is-invalid' : '';?>" >
                                <?php echo form_error('heading');?>
                            </div>
                            <div class="form-group">
                                <label>Heading Description</label>
                                <input type="text" name="h_description" id="h_description" value="<?php echo set_value('h_description',$about['h_description']);?>" class="form-control <?php echo (form_error('h_description') != '') ? 'is-invalid' : '';?>" >
                                <?php echo form_error('h_description');?>
                            </div>
                            
                            <div class="form-group">
                                <label>Image</label> <br>
                                <input type="file" name="image" id="image" class="form-control-file <?php echo (form_error('image') != '') ? 'is-invalid' : ''; ?>">
                                <?php echo form_error('image', '<div class="invalid-feedback">', '</div>'); ?>
                                <?php echo (!empty($errorImageUpload)) ? '<div class="invalid-feedback">' . $errorImageUpload . '</div>' : ''; ?>

                                <br>
                                <?php if($about['image']!="" && file_exists('./public/uploads/about/'.$about['image'])){?>
                                    <img class="mt-3" width="100" height="100" src="<?php echo base_url().'public/uploads/about/'.$about['image'];?>"> 
                                    
                                    <?php } else {?>
                                        <img width="100" height="100" src="<?php echo base_url().'public/uploads/department/No-Image.png';?>">

                                    <?php } ?>
                            </div>
                            <div class="form-group">
                                <label>Small Description</label>
                                <textarea name="small_description" id="small_description" class="textarea"><?php echo set_value('small_description',$about['small_description']);?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Large Description</label>
                                <textarea name="large_description" id="large_description" class="textarea"><?php echo set_value('large_description',$about['large_description']);?></textarea>
                            </div>
                            
                                            
                        </div>
                        <div class="card-footer">
                            <button name="submit" type="submit" class="btn btn-primary">Save</button>
                            <a href="<?php echo base_url().'admin/about/index'?>" class="btn btn-secondary"> Back</a>
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
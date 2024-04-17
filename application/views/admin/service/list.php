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
                    <li class="breadcrumb-item active">Services</li>
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
                                    <th>Title</th>
                                    <th>Heading</th>
                                    <th>Heading Description</th>
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <tbody>
                            
                                <?php if(!empty($service_titles)) {?>
                                    <?php foreach($service_titles as $Row) {?>
                                        <tr>
                                            <td><?php echo $Row['title'];?></td>
                                            <td><?php echo $Row['heading'];?></td>
                                            <td><?php echo $Row['h_description'];?></td>
                                            <td>
                                                <a href="<?php echo base_url().'admin/service/edit_title/'.$Row['id'];?>" class="btn btn-primary btn-sm">
                                                    <i class="far fa-edit"></i>Edit
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="4">Records not Found</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="<?php echo base_url().'admin/service/create'?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th width="50">#</th>
                                <th>Image</th>
                                <th>Service Name</th>
                                <th>Service Description</th>
                                <th width="160" class="text-center">Action</th>
                            </tr>
                           
                            <?php if(!empty($services)) {?>
                                <?php foreach($services as $serviceRow) {?>
                                    <tr>
                                        <td><?php echo $serviceRow['id'];?></td>
                                        <td width="100" height="150">
                                            <?php 
                                            $path='./public/uploads/service/'.$serviceRow['image'];
                                            if($serviceRow['image'] != ""  && file_exists($path)) { ?>
                                                <img class="w-100" src="<?php echo base_url('public/uploads/service/'.$serviceRow['image']) ?>" alt="">
                                            <?php } else{ ?>
                                                <img class="w-100" src="<?php echo base_url('public/uploads/doctors/no_img.jpg'); ?>" alt="">
                                            <?php } ?>
                                        </td> 
                                        <td><?php echo $serviceRow['service_name'];?></td>
                                        <td><?php echo $serviceRow['service_description'];?></td>
                                        <td  class="text-center">
                                            <a href="<?php echo base_url().'admin/service/edit_service/'.$serviceRow['id'];?>" class="btn btn-primary btn-sm">
                                                <i class="far fa-edit"></i>Edit
                                            </a>
                                            <a href="javascript:void(0);" onclick="deleteService(<?php echo $serviceRow['id'];?>)" class="btn btn-danger btn-sm">
                                                <i class="far fa-trash-alt"></i>Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="4">Records not Found</td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('admin/footer');?>
<script type="text/javascript">
function deleteService(id)
{
    if(confirm("Are you sure You want to delete this service ?"))
    {
        window.location.href='<?php echo base_url().'admin/service/delete/';?>'+id;
    }
}
</script>

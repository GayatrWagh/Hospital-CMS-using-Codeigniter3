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
              <li class="breadcrumb-item active">Doctors</li>
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
                            <input type="text" value="<?php echo $q;?>" class="form_control" placeholder="Search" name="q">
                            <div class="input-group-append">
                                <button class="input-group-text" id="basic-addon1">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        </form> 
                </div>
                <div class="card-tools">
                    <a href="<?php echo base_url().'admin/doctor/create';?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create</a>
                </div>
            </div>
            <div class="card-body">
              <table class="table">
                <tr>
                  <th width="50">#</th>
                  <th width="100">Image</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Designation</th>
                  <th class="text-center">Created_at</th>
                  <th>Status</th>
                  <th width="120" class="text-center">Action</th>
                </tr>
                <?php if(!empty($doctors)){
                    foreach($doctors as $doctor){
                    ?>
                    <tr>
                        <td><?php echo $doctor['id'];?></td>    
                        <td width="100" height="150">
                            <?php 
                            $path='./public/uploads/doctors/'.$doctor['image'];
                            if($doctor['image'] != ""  && file_exists($path)) { ?>
                                <img class="w-100" src="<?php echo base_url('public/uploads/doctors/'.$doctor['image']) ?>" alt="">
                                <?php
                            } else{
                                ?>
                                <img class="w-100" src="<?php echo base_url('public/uploads/doctors/no_img.jpg'); ?>" alt="">


                            <?php
                            }
                        
                        ?>
                        </td>                                                                                                                                                                                                              
                        <td><?php echo $doctor['name'];?></td>
                        <td><?php echo $doctor['description'];?></td>
                        <td><?php echo $doctor['designation'];?></td>
                        <td><?php echo date('Y-m-d',strtotime($doctor['created_at'])) ?></td>
                        <td><?php if($doctor['status']==1){
                            ?>
                            <p class="badge badge-success">Active</p>
                            <?php
                        } else { 
                            ?>
                            <p class="badge badge-danger">Block</p>
                            <?php } ?>
                        
                        
                        
                        </td>
                        <td class="text-center">
                            <a href="<?php echo base_url('admin/doctor/edit/'.$doctor['id']);?>" class="btn btn-sm btn-primary">
                                <i class="far fa-edit"></i>
                            </a>
                            <a href="javascript:void(0);" onclick="deleteDoctor(<?php echo $doctor['id']?>)" class="btn btn-sm btn-danger">
                                <i class="far fa-trash-alt"></i>
                            </a>


                        </td>
                    </tr>
                    <?php } 
                    } else {?>
                        <tr>
                            <td colspan="8">Records Not Found</td>
                        </tr>
                        <?php }?>
            </table>
            <div>
                <?php echo $pagination_links; ?>
            </div>


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
<script type="text/javascript">
function deleteDoctor(id)
{
   
  if(confirm("Are you sure You want to delete this Doctor ?"))
  {
    window.location.href='<?php echo base_url().'admin/doctor/delete/';?>'+id;
   
  }
}
</script>
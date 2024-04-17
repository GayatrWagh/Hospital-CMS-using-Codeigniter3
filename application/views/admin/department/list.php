<?php $this->load->view('admin/header'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Department</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Department</li>
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
                <div class="card-tools">
                    <a href="<?php echo base_url().'admin/department/create'?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create</a>
                </div>
            </div>
            <div class="card-body">
              <table class="table">
                <tr>
                  <th width="50">#</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th width="100">Status</th>
                  <th width="160" class="text-center">Action</th>
                </tr>
        
                <?php if(!empty($departments)) {?>
                  <?php foreach($departments as $departmentRow) {?>
                <tr>
                <td><?php echo $departmentRow->id;?></td>
            <td><?php echo $departmentRow->name;?></td>
            <td><?php echo $departmentRow->description;?></td>
            <td>
                <?php if($departmentRow->status==1) {?>
                    <span class="badge badge-success">Active</span>
                    <?php } else { ?>
                      <span class="badge badge-danger">Block</span>
                      <?php }?>
                  </td>
                  <td  class="text-center">
                    <a href="<?php echo base_url().'admin/department/edit/'.$departmentRow->id;?>" class="btn btn-primary btn-sm">
                      <i class="far fa-edit"></i>Edit
                    </a>
                    <a href="javascript:void(0);" onclick="deleteDepartment(<?php echo $departmentRow->id;?>)" class="btn btn-danger btn-sm">
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
function deleteDepartment(id)
{
  if(confirm("Are you sure You want to delete this department ?"))
  {
    window.location.href='<?php echo base_url().'admin/department/delete/';?>'+id;
   
  }
}
</script>
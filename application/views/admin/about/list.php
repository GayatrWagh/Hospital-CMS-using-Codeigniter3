<?php $this->load->view('admin/header'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">About</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">About</li>
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
                <!-- <div class="card-tools">
                    <a href="<?php echo base_url().'admin/about/create'?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create</a>
                </div> -->
            </div>
            <div class="card-body">
              <table class="table">
                <tr>
                  <th width="50">#</th>
                  <th width="80">Image</th>
                  <th width="80">Title</th>
                  <th width="80">Heading</th>
                  <th width="80">Heading_Description</th>
                  
                  <th width="80">Small Description</th>
                  <th width="80">Large Description</th>
                  <th>Action</th>

                </tr>
        
                <?php if(!empty($abouts)) {?>
                  <?php foreach($abouts as $aboutRow) {?>
                <tr>
                  <td width="80"><?php echo $aboutRow['id'];?></td>
                  <td>
                  <?php 
                            $path='./public/uploads/about/'.$aboutRow['image'];
                            if($aboutRow['image'] != ""  && file_exists($path)) { ?>
                                <img class="w-100" src="<?php echo base_url('public/uploads/about/'.$aboutRow['image']) ?>" alt="">
                                <?php
                            } else{
                                ?>
                                <img class="w-100" src="<?php echo base_url('public/uploads/doctors/no_img.jpg'); ?>" alt="">


                            <?php
                            }
                        
                        ?>
                  </td>
                  <td width="80"><?php echo $aboutRow['title'];?></td>
                  <td width="80"><?php echo $aboutRow['heading'];?></td>
                  <td width="80"><?php echo $aboutRow['h_description'];?></td>
                  
                  <td width="80"><?php echo $aboutRow['small_description'];?></td>
                  <td width="80"><?php echo $aboutRow['large_description'];?></td>

                  
                  <td width="80" class="text-center">
                    <a href="<?php echo base_url().'admin/about/edit/'.$aboutRow['id'];?>" class="btn btn-primary btn-sm">
                      <i class="far fa-edit"></i>
                    </a>
                   
                  </td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                  <tr>
                    <td colspan="7">Records not Found</td>
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

  <?php $this->load->view('admin/footer'); ?>
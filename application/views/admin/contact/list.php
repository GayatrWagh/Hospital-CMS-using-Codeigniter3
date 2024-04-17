<?php $this->load->view('admin/header'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Contact</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Contact</li>
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
                    <a href="<?php echo base_url().'admin/contact/create'?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create</a>
                </div> -->
            </div>
            <div class="card-body">
              <table class="table">
                <tr>
                  <!-- <th width="50">#</th> -->
                  <th>Title</th>
                  <th>Heading</th>
                  <th>Heading_Description</th>
                 
                  <th>Address</th>
                  <th>Email</th>
                  <th>Call Us</th>
                  <th>Action</th>

                </tr>
        
                <?php if(!empty($contacts)) {?>
                  <?php foreach($contacts as $contactRow) {?>
                <tr>
                  <!-- <td width="80"></td> -->
                  <td><?php echo $contactRow['title'];?></td>
                  <td><?php echo $contactRow['heading'];?></td>
                  <td><?php echo $contactRow['h_description'];?></td>
                  <td><?php echo $contactRow['address'];?></td>
                  <td><?php echo $contactRow['email'];?></td>
                  <td><?php echo $contactRow['call_us'];?></td>
                  <td class="text-center">
                    <a href="<?php echo base_url().'admin/contact/edit/'.$contactRow['id'];?>" class="btn btn-primary btn-sm">
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
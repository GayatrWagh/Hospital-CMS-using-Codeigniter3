<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <?php if(!empty($service_titles)) {?>
  <?php foreach($service_titles as $Row) {?>
  <title><?php echo $Row['title'];?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

<?php $this->load->view('includes/css');?>
</head>

<body>

<?php $this->load->view('includes/header');?>

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(<?php echo base_url();?>assets/img/slide/slide-1.jpg)">
          <div class="container">
            <h2>Welcome to <span>Medicio</span></h2>
            <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel.</p>
            <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url(<?php echo base_url();?>assets/img/slide/slide-2.jpg)">
          <div class="container">
            <h2>Lorem Ipsum Dolor</h2>
            <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel.</p>
            <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url(<?php echo base_url();?>assets/img/slide/slide-3.jpg)">
          <div class="container">
            <h2>Sequi ea ut et est quaerat</h2>
            <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel.</p>
            <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div>
        </div>

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section><!-- End Hero -->

  <main id="main">


    <!-- ======= Services Section ======= -->
    <section id="services" class="services services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2><?php echo $Row['heading'];?></h2>
          <p><?php echo $Row['h_description'];?></p>
        </div>
        <?php }} ?>
       
        <div class="row">
        <?php if(!empty($services)) {?>
        <?php foreach($services as $serviceRow) {?>
          <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
            
            <div> 
              <?php 
              $path='./public/uploads/service/'.$serviceRow['image'];
              if($serviceRow['image'] != ""  && file_exists($path)) { ?>
            <img height="150" width="150" src="<?php echo base_url('public/uploads/service/'.$serviceRow['image']) ?>" alt="">
            <?php } else{ ?>
            <img height="150" width="150" src="<?php echo base_url('public/uploads/doctors/no_img.jpg'); ?>" alt="">
            <?php } ?></div>
            <h4 class="title"><a href=""><?php echo $serviceRow['service_name'];?></a></h4>
            <p class="description"><?php echo $serviceRow['service_description'];?></p>
          </div>
          
          <?php } } ?>
        </div>
       
      </div>
    </section><!-- End Services Section -->

    <!-- ======= Appointment Section ======= -->
    <?php $this->load->view('appointment_view'); ?>
    <!-- End Appointment Section -->

   
  </main><!-- End #main -->


  <?php $this->load->view('includes/footer');?>
  <?php $this->load->view('includes/scripts');?>
  



 

</body>

</html>

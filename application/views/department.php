<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Medicio</title>
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


       <!-- ======= Departments Section ======= -->
<section id="departments" class="departments">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>Departments</h2>
      <!-- <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p> -->
    </div>

    <div class="row" data-aos="fade-up" data-aos-delay="100">
      <div class="col-lg-4 mb-5 mb-lg-0">
        <ul class="nav nav-tabs flex-column">
          <?php foreach($departments as $index => $department): ?>
            <li class="nav-item">
              <a class="nav-link <?php echo ($index === 0) ? 'active show' : ''; ?>" data-bs-toggle="tab" data-bs-target="#tab-<?php echo $index + 1; ?>">
                <h4><?php echo $department['name']; ?></h4>
                <p><?php echo $department['description']; ?></p>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="col-lg-8">
        <div class="tab-content">
          <?php foreach($departments as $index => $department): ?>
            <div class="tab-pane <?php echo ($index === 0) ? 'active show' : ''; ?>" id="tab-<?php echo $index + 1; ?>">
              <h3><?php echo $department['name']; ?></h3>
              <p class="fst-italic"><?php echo $department['description']; ?></p>
              <?php if(file_exists('./public/uploads/department/'.$department['image'])){?>
                <img src="<?php echo base_url('public/uploads/department/'.$department['image'])?>" alt="" class="img-fluid">

                  <?php } ?>
              <p><?php echo $department['description']; ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

  </div>
</section><!-- End Departments Section -->

    <!-- ======= Appointment Section ======= -->
    <?php $this->load->view('appointment_view'); ?>
  <!-- End Appointment Section -->


  </main><!-- End #main -->

  <?php $this->load->view('includes/footer');?>
  <?php $this->load->view('includes/scripts');?>

</body>

</html>

<div class="col-lg-6">
  <form id="email-form" class="email-form" action="" method="POST">
    <div class="row">
      <div class="col-md-6 form-group">
        <input type="text" name="name" class="form-control" id="name" value="" placeholder="Your Name">
      </div>
      <div class="col-md-6 form-group mt-3 mt-md-0">
        <input type="email" class="form-control" name="email" id="email" value="" placeholder="Your Email">
      </div>
     
    </div>
    <div class="form-group mt-3">
      <input type="text" class="form-control" name="subject" id="subject" value="" placeholder="Subject">
    </div>
    <div class="form-group mt-3">
      <textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea>
    </div>
    <div class="text-center"><button id="enquiryBtn" type="submit" name="submit">Send Message</button></div>
  </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  $(document).ready(function() {
    $('#enquiryBtn').click(function(e) {
      e.preventDefault(); // Prevent the default form submission behavior

      // Serialize the form data
      var formData = $('#email-form').serialize();

      // Send an AJAX request
      $.ajax({
        type: 'POST',
        url: '<?php echo site_url("enquiry/store"); ?>', // Use site_url() to generate the correct URL
        data: formData,
        dataType: 'json',
        success: function(response) {
          if (response.status === 'success') {
            // Show SweetAlert on success
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: response.message
            }).then((result) => {
              if (result.isConfirmed) {
                location.reload(); // Reload the page after success
              }
            });
          } else {
            // Show error message
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: response.message
            });
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          // Show error message
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while processing your request.'
          });
        }
      });
    });
  });
</script>

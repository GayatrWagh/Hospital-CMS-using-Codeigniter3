<!-- ======= Appointment Section ======= -->
<section id="appointment" class="appointment section-bg">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Make an Appointment</h2>
            <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>
        <form name="myForm" id="myForm" action="<?php echo base_url('appointment/store');?>" method="post">
            <div class="row">
                <div class="col-md-4 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-4 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
                <div class="col-md-4 form-group mt-3 mt-md-0">
                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="Your Phone" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group mt-3">
                    <input type="datetime" name="date" class="form-control datepicker" id="date" placeholder="Appointment Date" required>
                </div>
                <div class="col-md-4 form-group mt-3">
                <select name="department" id="department"class="form-select">
                <option value="">Select Department</option>
                
                <?php foreach ($departments as $department) { ?>
        <option value="<?php echo $department->id; ?>"><?php echo $department->name; ?></option>
    <?php } ?>
                </select>
                </div>
                <div class="col-md-4 form-group mt-3">
                    <select name="doctor" id="doctor" class="form-select">
                   
<option>Select Doctors</option>


                    </select>
                </div>
            </div>
            <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
            </div>
            <div class="text-center"><button id="makeAppointmentBtn" type="submit" class="btn btn-primary">Make an Appointment</button></div>
        </form>
    </div>
</section>
<!-- End Appointment Section -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
$(document).ready(function() {
    $('.btn-approve').click(function() {
        var appointment_id = $(this).data('appointment-id');
        updateStatus(appointment_id, 'Approved');
    });

    $('.btn-cancel').click(function() {
        var appointment_id = $(this).data('appointment-id');
        updateStatus(appointment_id, 'Cancelled');
    });

    function updateStatus(appointment_id, new_status) {
        $.ajax({
            url: '<?php echo base_url("appointment/updateStatus"); ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                appointment_id: appointment_id,
                new_status: new_status
            },
            success: function(response) {
                if (response.success) {
                    // Show SweetAlert message
                    if (new_status === 'Approved') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Appointment Approved',
                            text: 'The appointment has been approved.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else if (new_status === 'Cancelled') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Appointment Cancelled',
                            text: 'The appointment has been cancelled.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                    // Refresh the page
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
});
</script>
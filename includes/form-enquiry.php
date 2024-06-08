

<div id="success-message" class="alert alert-success">

</div>
<form id="enquiry">
    <h2>
        Send And Enquiry About <?php the_title() ?>
    </h2>
    <input type="hidden" name="registration" value="<?php echo get_post_meta($post->ID,'registration',true); ?>" />
    <div class="row form-group my-3">
        <div class="col-lg-5">
            <input type="text" name="fname" placeholder="First Name" class="form-control my-3">
        </div>
        <div class="col-lg-5">
            <input type="text" name="lname" placeholder="Last Name" class="form-control my-3">
        </div>
    </div>
    <div class="row form-group my-3">
        <div class="col-lg-5">
            <input type="email" name="email" placeholder="Email" class="form-control my-3" />
        </div>
        <div class="col-lg-5">
            <input type="text" name="subject" placeholder="Subject" class="form-control my-3" />
        </div>
    </div>
    <div class="form-group my-3">
        <div class="col-lg-10">
            <textarea name="message" placeholder="Your message here" class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group my-3">
        <div class="col-lg-10">
            <div class="d-grid gap-2">
                <input type="submit" name="submit" value="Send" class="btn btn-warning">
            </div>
        </div>
    </div>
</form>


<script>
    var endpoint    = '<?php echo admin_url('admin-ajax.php'); ?>'
    var ajax_nonce  = '<?php echo wp_create_nonce('ajax-nonce'); ?>';
</script>
<?php require "header.php" ?>
<!-- Image Header Start -->
<section>
  <div class="bg text-center" style="background: linear-gradient(to right, rgba(0, 0, 0, 0.442), rgba(0, 0, 0, 0.442)),url('images/cloth.jpg') no-repeat center;background-attachment:fixed;">
    <div class="img-bg-text">
      <h3>Contact Us</h3>
    </div>
  </div>
</section>
<!-- Image Header End -->
<!-- Send Message Section Start -->
<div class="container mt-5" id="contact">
  <h1>Send Message</h1>

  <form class="row g-4" method="" id="contact-form">
    <div class="col-md-6 p-3">
      <label for="name">Name</label>
      <input type="text" placeholder="Your Name" class="form-control">
    </div>
    <div class="col-md-6 p-3">
      <label for="Email">Email</label>
      <input type="email" placeholder="Your Email" class="form-control">
    </div>
    <div class="col-12">
      <label for="address">Message</label>
      <textarea name="" id="" cols="30" rows="10" class="form-control" placeholder="Your Message"></textarea>
    </div>
    <div class="col-12 p-3 text-center">
      <button class="btn-btn-primary" type="submit">Send Message</button>
    </div>
  </form>
</div>
<!-- Send Message Section End -->
<!-- map  -->
<div class="mapouter">
  <div class="gmap_canvas">
    <iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
  </div>
</div>
<!-- Contact Section Start -->
<!-- Banner Section Start -->
<div class="container">
  <div class="banner">
    <!-- <div class="featured-products">
                            <div class="featured-products-title">
                                <h2>OUR SERVICES</h2>
                            </div>
                        </div> -->
    <div class="row">
      <div class="col-lg-3 text-center">
        <i class="bi bi-telephone-fill"></i>
        <h3>Phone</h3>
        <p>+123456789</p>
      </div>

      <div class="col-lg-3 text-center">
        <i class="bi bi-geo-alt-fill"></i>
        <h3>Address</h3>
        <p>No.(123) Kabaraye, Yangon</p>
      </div>

      <div class="col-lg-3 text-center">
        <i class="bi bi-clock-fill"></i>
        <h3>Open Time</h3>
        <p>24 Hours</p>
      </div>

      <div class="col-lg-3 text-center">
        <i class="bi bi-envelope-fill"></i>
        <h3>Email</h3>
        <p>team4@gmail.com</p>
      </div>
    </div>
  </div>
</div>
<!-- Banner Section End -->

<!-- Image Section Start -->

<!-- Image Section End -->


<!-- Contact Section End -->

<?php require "footer.php" ?>
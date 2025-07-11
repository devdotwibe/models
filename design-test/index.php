<?php
  session_start();
  include('../includes/config.php');
?>
<!DOCTYPE html>

<html lang="en">



<head>

  <meta charset="utf-8">

  <meta content="width=device-width, initial-scale=1.0" name="viewport">



  <title>Bootstrap Template - Index</title>

  <meta content="" name="description">

  <meta content="" name="keywords">



  <!-- Favicons -->

  <link href="assets/img/favicon.png" rel="icon">

  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">



  <!-- Google Fonts -->

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">



  <!-- Vendor CSS Files -->

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">

  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">

  <link href="assets/vendor/aos/aos.css" rel="stylesheet">



  <!-- Template Main CSS File -->

  <link href="assets/css/style.css" rel="stylesheet">


</head>



<body>



  <!-- ======= Top Bar ======= -->

  <?php include('includes/header.php'); ?>

  <!-- ======= Hero Section ======= -->

  <section id="hero" class="d-flex align-items-center">

    <div class="container" data-aos="zoom-out" data-aos-delay="100">

      <h1>Welcome to <span>The Live Models</spa>

      </h1>

      <h2>We have something special for you.</h2>

      <div class="d-flex">

        <a href="#" class="btn-get-started scrollto">Get Started</a>

        <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="venobox btn-watch-video" data-vbtype="video" data-autoplay="true"> Watch Video <i class="icofont-play-alt-2"></i></a>

      </div>

    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Portfolio Section ======= -->

    <section id="portfolio" class="portfolio">

      <div class="container-fluid" data-aos="fade-up">



        <div class="section-title">
          <h3>Check our <span>New Model</span></h3>
        </div>

        <?php include('../sliders/new-model-slider.php'); ?>

        <div class="section-title" style="padding-top: 50px;">
          <h3>Check <span>Featured Models</span></h3>
        </div>

        <?php include('includes/sliders.php'); ?>

        <div class="section-title" style="padding-top: 50px;">
          <h3>From Different <span>Countries </span></h3>
        </div>
        <?php //include('../sliders/contries-model.php'); ?>

        <div class="row" data-aos="fade-up" data-aos-delay="100">

          <div class="col-lg-12 d-flex justify-content-center">

            <ul id="portfolio-flters">

              <li data-filter="*" class="filter-active">India</li>

              <li data-filter=".filter-app">Africa</li>

              <li data-filter=".filter-card">Japan</li>

              <li data-filter=".filter-web">Sri lanka</li>

            </ul>

          </div>

        </div>



        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">



          <div class="col-lg-4 col-md-6 portfolio-item filter-app">

            <img src="assets/img/portfolio/portfolio-1.jpg" class="img-fluid" alt="">

            <div class="portfolio-info">

              <h4>App 1</h4>

              <p>App</p>

              <a href="assets/img/portfolio/portfolio-1.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"><i class="bx bx-plus"></i></a>

              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>

            </div>

          </div>



          <div class="col-lg-4 col-md-6 portfolio-item filter-web">

            <img src="assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt="">

            <div class="portfolio-info">

              <h4>Web 3</h4>

              <p>Web</p>

              <a href="assets/img/portfolio/portfolio-2.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>

              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>

            </div>

          </div>



          <div class="col-lg-4 col-md-6 portfolio-item filter-app">

            <img src="assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt="">

            <div class="portfolio-info">

              <h4>App 2</h4>

              <p>App</p>

              <a href="assets/img/portfolio/portfolio-3.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="App 2"><i class="bx bx-plus"></i></a>

              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>

            </div>

          </div>



          <div class="col-lg-4 col-md-6 portfolio-item filter-card">

            <img src="assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt="">

            <div class="portfolio-info">

              <h4>Card 2</h4>

              <p>Card</p>

              <a href="assets/img/portfolio/portfolio-4.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Card 2"><i class="bx bx-plus"></i></a>

              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>

            </div>

          </div>



          <div class="col-lg-4 col-md-6 portfolio-item filter-web">

            <img src="assets/img/portfolio/portfolio-5.jpg" class="img-fluid" alt="">

            <div class="portfolio-info">

              <h4>Web 2</h4>

              <p>Web</p>

              <a href="assets/img/portfolio/portfolio-5.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>

              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>

            </div>

          </div>



          <div class="col-lg-4 col-md-6 portfolio-item filter-app">

            <img src="assets/img/portfolio/portfolio-6.jpg" class="img-fluid" alt="">

            <div class="portfolio-info">

              <h4>App 3</h4>

              <p>App</p>

              <a href="assets/img/portfolio/portfolio-6.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="App 3"><i class="bx bx-plus"></i></a>

              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>

            </div>

          </div>



          <div class="col-lg-4 col-md-6 portfolio-item filter-card">

            <img src="assets/img/portfolio/portfolio-7.jpg" class="img-fluid" alt="">

            <div class="portfolio-info">

              <h4>Card 1</h4>

              <p>Card</p>

              <a href="assets/img/portfolio/portfolio-7.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Card 1"><i class="bx bx-plus"></i></a>

              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>

            </div>

          </div>



          <div class="col-lg-4 col-md-6 portfolio-item filter-card">

            <img src="assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt="">

            <div class="portfolio-info">

              <h4>Card 3</h4>

              <p>Card</p>

              <a href="assets/img/portfolio/portfolio-8.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>

              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>

            </div>

          </div>



          <div class="col-lg-4 col-md-6 portfolio-item filter-web">

            <img src="assets/img/portfolio/portfolio-9.jpg" class="img-fluid" alt="">

            <div class="portfolio-info">

              <h4>Web 3</h4>

              <p>Web</p>

              <a href="assets/img/portfolio/portfolio-9.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>

              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>

            </div>

          </div>



        </div>



      </div>

    </section><!-- End Portfolio Section -->



    <!-- ======= Team Section ======= -->

    <section id="team" class="team section-bg">

      <div class="container" data-aos="fade-up">



        <div class="section-title">

          <!-- <h2>Team</h2> -->

          <h3>All Time <span>Favourites</span></h3>

          <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>

        </div>



        <div class="row">



          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">

            <div class="member">

              <div class="member-img">

                <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">

                <div class="social">

                  <a href=""><i class="icofont-twitter"></i></a>

                  <a href=""><i class="icofont-facebook"></i></a>

                  <a href=""><i class="icofont-instagram"></i></a>

                  <a href=""><i class="icofont-linkedin"></i></a>

                </div>

              </div>

              <div class="member-info">

                <h4>Walter White</h4>

                <span>Chief Executive Officer</span>

              </div>

            </div>

          </div>



          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">

            <div class="member">

              <div class="member-img">

                <img src="assets/img/team/team-2.jpg" class="img-fluid" alt="">

                <div class="social">

                  <a href=""><i class="icofont-twitter"></i></a>

                  <a href=""><i class="icofont-facebook"></i></a>

                  <a href=""><i class="icofont-instagram"></i></a>

                  <a href=""><i class="icofont-linkedin"></i></a>

                </div>

              </div>

              <div class="member-info">

                <h4>Sarah Jhonson</h4>

                <span>Product Manager</span>

              </div>

            </div>

          </div>



          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">

            <div class="member">

              <div class="member-img">

                <img src="assets/img/team/team-3.jpg" class="img-fluid" alt="">

                <div class="social">

                  <a href=""><i class="icofont-twitter"></i></a>

                  <a href=""><i class="icofont-facebook"></i></a>

                  <a href=""><i class="icofont-instagram"></i></a>

                  <a href=""><i class="icofont-linkedin"></i></a>

                </div>

              </div>

              <div class="member-info">

                <h4>William Anderson</h4>

                <span>CTO</span>

              </div>

            </div>

          </div>



          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">

            <div class="member">

              <div class="member-img">

                <img src="assets/img/team/team-4.jpg" class="img-fluid" alt="">

                <div class="social">

                  <a href=""><i class="icofont-twitter"></i></a>

                  <a href=""><i class="icofont-facebook"></i></a>

                  <a href=""><i class="icofont-instagram"></i></a>

                  <a href=""><i class="icofont-linkedin"></i></a>

                </div>

              </div>

              <div class="member-info">

                <h4>Amanda Jepson</h4>

                <span>Accountant</span>

              </div>

            </div>

          </div>



        </div>



      </div>

    </section><!-- End Team Section -->






    <!-- ======= Contact Section ======= -->

    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">



        <div class="section-title">

          <h2>Contact</h2>

          <h3><span>Contact Us</span></h3>

          <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>

        </div>



        <div class="row" data-aos="fade-up" data-aos-delay="100">

          <div class="col-lg-6">

            <div class="info-box mb-4">

              <i class="bx bx-map"></i>

              <h3>Our Address</h3>

              <p>A108 Adam Street, New York, NY 535022</p>

            </div>

          </div>



          <div class="col-lg-3 col-md-6">

            <div class="info-box  mb-4">

              <i class="bx bx-envelope"></i>

              <h3>Email Us</h3>

              <p>contact@example.com</p>

            </div>

          </div>



          <div class="col-lg-3 col-md-6">

            <div class="info-box  mb-4">

              <i class="bx bx-phone-call"></i>

              <h3>Call Us</h3>

              <p>+1 5589 55488 55</p>

            </div>

          </div>



        </div>



        <div class="row" data-aos="fade-up" data-aos-delay="100">



          <div class="col-lg-6 ">

            <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>

          </div>



          <div class="col-lg-6">

            <form action="forms/contact.php" method="post" role="form" class="php-email-form">

              <div class="form-row">

                <div class="col form-group">

                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />

                  <div class="validate"></div>

                </div>

                <div class="col form-group">

                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />

                  <div class="validate"></div>

                </div>

              </div>

              <div class="form-group">

                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />

                <div class="validate"></div>

              </div>

              <div class="form-group">

                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>

                <div class="validate"></div>

              </div>

              <div class="mb-3">

                <div class="loading">Loading</div>

                <div class="error-message"></div>

                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
<?php include('includes/footer.php'); ?>

  <div id="preloader"></div>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>



  <!-- Vendor JS Files -->

  <script src="assets/vendor/jquery/jquery.min.js"></script>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>

  <script src="assets/vendor/php-email-form/validate.js"></script>

  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>

  <script src="assets/vendor/counterup/counterup.min.js"></script>

  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>

  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <script src="assets/vendor/venobox/venobox.min.js"></script>

  <script src="assets/vendor/aos/aos.js"></script>



  <!-- Template Main JS File -->

  <script src="assets/js/main.js"></script>



</body>



</html>
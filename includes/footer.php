<link rel="stylesheet" type="text/css" href="<?=SITEURL?>includes/foot-style.css">
<?php
if(isset($footer_hide_script)){
}
else{
?>
<script src="<?='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'?>"></script>
<?php
}

			$model_array = []; 
			
			$sqls_model = "SELECT * FROM model_user WHERE as_a_model = 'Yes' Order by id DESC LIMIT 4";

              $resultd_model = mysqli_query($con, $sqls_model);

                if (mysqli_num_rows($resultd_model) > 0) { 
					
					while($rowesdw = mysqli_fetch_assoc($resultd_model)) {  
			
						$unique_id = $rowesdw['unique_id'];
					
					$sql = "SELECT count(*) FROM model_images WHERE unique_model_id = '".$unique_id."' AND file_type = 'Image'";

                      $result = mysqli_query($con, $sql);

                      if (mysqli_num_rows($result) > 0) {

                        while($rowe = mysqli_fetch_assoc($result)) {

                           $image_c = $rowe["count(*)"];

                        }

                      }

                      $sql1 = "SELECT count(*) FROM model_images WHERE unique_model_id = '".$unique_id."' AND file_type = 'Image'";

                      $result1 = mysqli_query($con, $sql1);
						
					  $vdo_c = 0;
					  
                      if (mysqli_num_rows($result1) > 0) {

                        while($rowe1 = mysqli_fetch_assoc($result1)) {

                          if(isset($rowe["count(*)"])) $vdo_c = $rowe["count(*)"];

                        }

                      }
					  
							if(empty($rowesdw['name'])){
								$modelname = ucfirst($rowesdw['username']);
							}else{
								$modelname = ucfirst($rowesdw['name']);
							}
					$services = '';
						if(!empty($rowesdw['services'])){
							if($rowesdw['services'] == 'Chat Only') $services = '💬 '.$rowesdw['services'];
							else if($rowesdw['services'] == 'Chat & Watch') $services = '💬📹 '.$rowesdw['services'];
							else if($rowesdw['services'] == 'Chat, Watch & Meet') $services = '💬📹🤝 '.$rowesdw['services'];
							else if($rowesdw['services'] == 'Premium Experience') $services = '👑 '.$rowesdw['services'];
						}
					
					$model_array[$rowesdw['unique_id']] = array('name'=>$modelname,
																'age'=>$rowesdw['age'],
																'image'=>SITEURL . 'ajax/noimage.php?image=' . $rowesdw['profile_pic'],
																'status'=>'online',
																'services'=>$services,
																'bio'=>$rowesdw['user_bio'],
																'likes'=>0,
																'rating'=>0);
																
																
																
					}
				}
				

?>
<style type="text/css">
  @media screen and (max-width: 600px) {
    .mobile_foot {
      display: block !important;
      height: 50px;
      background: #d83b1b;
      width: 100%;
      margin: auto;
      position: fixed;
      bottom: 0;
      z-index: 999;
    }
    .icon_form{
      height: 25px;
      width: 25px;
    }
    .main_f_div{
      text-align: center;
      padding: 10px;
    }
	#sub-floor{
		padding-bottom:30px
	}
  }

.prof_text{
  margin-bottom: unset;
  color: #4a4a4a;
  padding-left: 60px;
}
@media screen and (max-width: 600px) {
  .prof_text{
  margin-bottom: unset;
  color: #4a4a4a;
  padding-left: 65px;
  }

}
  @media screen and (min-width: 600px) {
	#menu{
	    margin-top: 0px !important;
	    top: 0px !important;
	}
  }
  
  .col-half-offset{
      margin-left:4.166666667%;
  }
  .prof_elink{
    padding-left: 16px;
    text-decoration-line: underline;
  }
  hr{
    margin: unset;
  }
</style>
<style type="text/css">
  .dark-mode-for-tag {
    color: white !important;
  }
  .dark-mode-for-model {
    border: 1px solid white !important;
    color: white !important;
    background-color: black !important;
  }
  /*.dark-mode {
    background-color: black !important;
    color: white !important;
  }*/

#menu {
    position: fixed;
    margin: 0px 35px 0px 0px;
}
@media screen and (max-width: 786px) {
  #menu {
    padding: 20px 10px;
  }
}
</style>
<?php 

$homeurl = '/index.php';                               
$homepage = "/";
$currentpage = $_SERVER['REQUEST_URI'];


//if($currentpage == $homepage or $currentpage == 'index.php') { ?>
  
 <!-- Ultra Premium Footer -->

    <div class="modal-overlay" id="payment_done" style="display:none;">

            <div class="modal" style="display:block; height:auto;">
                
                <div class="modal-header">
                <h2 class="modal-title text-green-600">Payment Successful 🎉</h2>
                <button class="close-modal" id="closeTipModal" type="button" onclick="paymentclose()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                        stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                </div>
                <div class="modal-body" id="">
                <p class="text-lg text-gray-700 mb-4">
                    Your payment was processed successfully. Thank you for your purchase!  
                </p>

                <button class="btn btn-primary" type="button" onclick="paymentclose()">Close</button>
                </div>
            </div>
    </div>

<footer class="bg-black text-white py-20 border-t border-white/10 footer-div">
    <div class="container mx-auto">
        <div class="grid md:grid-cols-4 gap-12 mb-16">
            <div>
                <h3 class="text-3xl font-bold gradient-text heading-font mb-6">The Live Models</h3>
                <p class="text-white/60 mb-6 text-lg leading-relaxed">The premier platform for authentic connections. Chat, Watch, and Meet with amazing verified models in a safe, secure environment.</p>
                <div class="flex space-x-4">
                    <!-- Social Media Icons -->
                    <!-- <a href="#" class="w-12 h-12 ultra-glass rounded-xl flex items-center justify-center hover:bg-indigo-600 transition duration-300 group hover-lift" onclick="openSocial('facebook')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white/70 group-hover:text-white">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg>
                    </a> -->
                    <a href="https://x.com/thelivemodels" class="w-12 h-12 ultra-glass rounded-xl flex items-center justify-center hover:bg-indigo-600 transition duration-300 group hover-lift" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white/70 group-hover:text-white">
                            <path d="M4 4l11.5 11.5M4 20l16-16"></path>
                        </svg>
                    </a>

                    <a href="https://www.instagram.com/the_livemodels" class="w-12 h-12 ultra-glass rounded-xl flex items-center justify-center hover:bg-indigo-600 transition duration-300 group hover-lift" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white/70 group-hover:text-white">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </a>

                    <!-- <a href="https://x.com/thelivemodels" class="w-12 h-12 ultra-glass rounded-xl flex items-center justify-center hover:bg-indigo-600 transition duration-300 group hover-lift" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white/70 group-hover:text-white">
                            <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"></path>
                        </svg>
                    </a> -->
                </div>
            </div>

            <div>
                <h4 class="font-bold mb-6 text-xl premium-text">Services</h4>
                <ul class="space-y-4 text-white/60 text-lg">
                    <li><a href="<?= SITEURL ?>all-members.php" class="hover:text-indigo-400 transition duration-300 read-more-btn" <?php /*?>onclick="navigateTo('models')" */ ?> >All Members</a></li>
                    <li><a href="<?= SITEURL ?>advertisements/" class="hover:text-indigo-400 transition duration-300 read-more-btn" <?php /*onclick="navigateTo('ads')" */ ?> >Advertisements</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-6 text-xl premium-text">Support</h4>
                <ul class="space-y-4 text-white/60 text-lg">
                    <li><a href="<?= SITEURL ?>contact-support.php" class="hover:text-indigo-400 transition duration-300 read-more-btn" <?php /* onclick="openSupport()" */ ?> >Contact Support</a></li>
                    <li><a href="<?= SITEURL ?>verification-help.php" class="hover:text-indigo-400 transition duration-300 read-more-btn" <?php /*onclick="openVerificationHelp()" */ ?> >Verification Help</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-6 text-xl premium-text">Legal</h4>
                <ul class="space-y-4 text-white/60 text-lg">
                    <li><a href="<?= SITEURL ?>tls-tom.php" class="hover:text-indigo-400 transition duration-300 read-more-btn" <?php /*onclick="openTerms()" */ ?> >Terms of Service</a></li>
                    <li><a href="<?= SITEURL ?>privacy-policy.php" class="hover:text-indigo-400 transition duration-300 read-more-btn" <?php /*onclick="openPrivacy()" */ ?> >Privacy Policy</a></li>
                    <li><a href="<?= SITEURL ?>verification-policy.php" class="hover:text-indigo-400 transition duration-300 read-more-btn" <?php /*onclick="openVerificationPolicy()" */ ?> >Verification Policy</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10 pt-8 text-center coppy">
            <p class="text-white/40 text-lg">&copy; <?php echo date('Y')?> Live Models. All rights reserved. Must be 18+ to use this service.</p>
        </div>
    </div>
</footer> 
  
  
<?php /* } else { ?>
    
<!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section col-1">
                    <div class="f-logo">
                        <div class="logo-icon">TLM</div>
                        <span>The Live Models</span>
                    </div>
                    <p>Premium model directory connecting verified talent with professional opportunities worldwide. Your gateway to the modeling industry.</p>


                </div>

                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="<?= SITEURL ?>all-models.php">All Models</a></li>
                        <li><a href="<?= SITEURL ?>advertisements/">Advertisements</a></li>
                        <li><a href="<?= SITEURL ?>dating_booking">Services</a></li>
                        <li><a href="<?= SITEURL ?>">About Us</a></li>
                        <li><a href="<?= SITEURL ?>">Careers</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Support</h3>
                    <ul>
                        <li><a href="/help">Help Center</a></li>
                        <li><a href="<?= SITEURL ?>contact-us.php">Contact Us</a></li>
                        <li><a href="/faq">FAQ</a></li>
                        <li><a href="/safety">Safety Guidelines</a></li>
                        <li><a href="/verification">Verification</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Legal</h3>
                    <ul>
                        <li><a href="/terms">Terms & Conditions</a></li>
                        <li><a href="/privacy">Privacy Policy</a></li>
                        <li><a href="/cookies">Cookie Policy</a></li>
                        <li><a href="/dmca">DMCA</a></li>
                        <li><a href="/age-verification">Age Verification</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="res-div">© 2024 The Live Models. All rights reserved.</div>


                <div class="footerb-links">
                    <a href="#">Terms & Conditions</a>
                    <a href="#">Privacy Policy</a>
                    <a href="<?= SITEURL ?>/contact-us.php">Contact Us</a>
                </div>


            </div>

            <div class="disclaimer">
                <strong>Important Disclaimer:</strong> We are an independent content sharing platform. All models are verified and must be 18+ years of age. We do not take responsibility for user-generated content. For copyright concerns or content removal requests, please contact us at <a href="mailto:abuse@thelivemodels.com" class="f-mail-link">abuse@thelivemodels.com</a>. Adult content is clearly marked and requires age verification.
            </div>
        </div>
    </footer>

    <script>
        // Enhanced JavaScript functionality
        let currentView = 'grid';
        let currentFilter = 'all';

        // Switch between grid and expanded views
        function switchView(view) {
            const gridView = document.getElementById('gridView');
            const expandedView = document.getElementById('expandedView');
            const viewButtons = document.querySelectorAll('.view-btn');

            // Update button states
            viewButtons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            if (view === 'grid') {
                gridView.style.display = 'grid';
                expandedView.classList.remove('active');
                currentView = 'grid';
            } else {
                gridView.style.display = 'none';
                expandedView.classList.add('active');
                currentView = 'expanded';
            }
        }

        // Filter content by type
        function filterContent(type) {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const cards = document.querySelectorAll('[data-category], [data-type]');

            // Update button states
            filterButtons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            // Age verification for adult content
            if (type === 'adult') {
                const confirmed = confirm('You must be 18 years or older to view adult content. Do you confirm you are of legal age?');
                if (!confirmed) {
                    // Reset to general content
                    filterContent('general');
                    return;
                }
            }

            // Filter cards
            cards.forEach(card => {
                const category = card.getAttribute('data-category');
                const cardType = card.getAttribute('data-type');

                let shouldShow = false;

                switch(type) {
                    case 'all':
                        shouldShow = true;
                        break;
                    case 'general':
                        shouldShow = category === 'general';
                        break;
                    case 'adult':
                        shouldShow = category === 'adult';
                        break;
                    case 'premium':
                        shouldShow = cardType === 'premium';
                        break;
                }

                card.style.display = shouldShow ? 'block' : 'none';
                if (card.classList.contains('ad-expanded')) {
                    card.style.display = shouldShow ? 'flex' : 'none';
                }
            });

            currentFilter = type;
        }

        // Search functionality
        function performSearch() {
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const locationFilter = document.getElementById('locationFilter');

            const searchTerm = searchInput.value.toLowerCase();
            const category = categoryFilter.value;
            const location = locationFilter.value;

            console.log('Searching for:', {
                term: searchTerm,
                category: category,
                location: location
            });

            // Show loading state
            const gridView = document.getElementById('gridView');
            const expandedView = document.getElementById('expandedView');

            // Add loading animation
            const loadingDiv = document.createElement('div');
            loadingDiv.className = 'loading';
            loadingDiv.innerHTML = '🔍 Searching for models...';

            if (currentView === 'grid') {
                gridView.appendChild(loadingDiv);
            } else {
                expandedView.appendChild(loadingDiv);
            }

            // Simulate search delay
            setTimeout(() => {
                loadingDiv.remove();
                alert(`Search completed for: "${searchTerm || 'all models'}"${category ? ` in ${category}` : ''}${location ? ` from ${location}` : ''}`);
            }, 1500);
        }

        // Model interaction functions
        function viewProfile(modelId) {
            alert(`Opening profile for model: ${modelId}`);
        }

        function contactModel(modelId) {
            alert(`Opening contact form for model: ${modelId}`);
        }

        function viewPortfolio(modelId) {
            alert(`Opening portfolio for model: ${modelId}`);
        }

        function viewSocials(modelId) {
            alert(`Opening social media links for model: ${modelId}`);
        }

        function viewServices(modelId) {
            alert(`Opening services page for model: ${modelId}`);
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Set default filter to general content
            filterContent('general');

            // Add smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Add fade-in animation to cards
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all cards
            document.querySelectorAll('.ad-card, .ad-expanded').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });

            // Add search on Enter key
            document.getElementById('searchInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });
        });

        // Responsive navigation toggle
        function toggleMobileNav() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('mobile-open');
        }

        // Add mobile navigation styles
        const mobileStyles = `
            @media (max-width: 768px) {
                .nav-links {
                    position: absolute;
                    top: 100%;
                    left: 0;
                    right: 0;
                    background: rgba(0, 0, 0, 0.95);
                    backdrop-filter: blur(20px);
                    flex-direction: column;
                    padding: 2rem;
                    transform: translateY(-100%);
                    opacity: 0;
                    visibility: hidden;
                    transition: all 0.3s ease;
                }

                .nav-links.mobile-open {
                    transform: translateY(0);
                    opacity: 1;
                    visibility: visible;
                }
            }
        `;

        // Add mobile styles to head
        const styleSheet = document.createElement('style');
        styleSheet.textContent = mobileStyles;
        document.head.appendChild(styleSheet);
    </script>	
	
	
<?php   } */ ?>


    <!-- Modal -->
	<?php /*?>  <div class="modal fade" id="myModalfoot" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Message alert!</h4>
	        </div>
	        <div class="modal-body p-3">
	          <p>You are not a model with us. Apply now to start earning money from your fans.</p>
	        </div>
	        <div class="modal-footer">
	          <button  data-dismiss="modal">Close</button>
	          <a type="button" class="btn btn-default" href="<?=SITEURL?>new-broadcaster.php">APPLY NOW</a>
	        </div>
	      </div>
	    </div>
	  </div>

	  <div class="modal fade" id="myModalfoot1" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Message alert!</h4>
	        </div>
	        <div class="modal-body p-3">
	          <p>Your application is being reviewed. Thanks for your patience</p>
	        </div>
	        <div class="modal-footer">
	          <button  data-dismiss="modal">Close</button>
	          <!-- <a type="button" class="btn btn-default" href="<?=SITEURL?>new-broadcaster.php">APPLY NOW</a> -->
	        </div>
	      </div>
	    </div>
	  </div>

    <div class="modal fade" id="myModalcratepost" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">New Post</h4>
          </div>
          <form method="post" action="post-up.php" enctype="multipart/form-data" style="padding: 20px;">
          <div class="modal-body">
              <div class="form-group row">
                <input type="hidden" name="m_uni_id" value="<?php echo $_SESSION["log_user_unique_id"]; ?>">
                <label for="staticEmail" class="col-sm-2 col-form-label">File Type</label>
                <div class="col-sm-10">
                  <select class="form-control" name="file_type" required="required">
                    <option value="Image">Image</option>
                    <option value="Video">Video</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">File</label>
                <div class="col-sm-10">
                  <input type="file"  id="inputPassword" name="filess" >
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control-plain text" id="Description" name="img_text" >
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">File type (Price)</label>
                <div class="col-sm-10">
                  <select class="form-control" name="file_type_price" required="required" id="my_id">
                    <option value="Free">Free</option>
                    <option value="Paid">Paid</option>
                  </select>
                </div>
              </div>
              <div class="form-group row" id="coin_field">
                <label for="staticEmail" class="col-sm-2 col-form-label">Coins</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control-plain text" name="coins" >
                </div>
              </div>
            
          </div>
          <div class="modal-footer">
            <button  data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary fancy_button" name="upload_image" value="Add New Post">
            <!-- <a type="button" class="btn btn-default" href="<?=SITEURL?>new-broadcaster.php">APPLY NOW</a> -->
          </div>
          </form>
        </div>
      </div>
    </div> <?php */ ?>
  <script>
    // $(document).ready(function(){
    //   $("#coin_field").hide();
    //   $("#my_id").change(function(){
    //     if(this.value == 'Paid'){
    //       $("#coin_field").show();
    //     }else{
    //       $("#coin_field").hide();
    //     }
    //   });
    //   $("#div2").hide();
    //   $("#btn222").click(function(){
    //     $("#div1").hide();
    //     $("#div2").show();
    //   });
    // });
  </script>
<?php
if(isset($footer_hide_script)){
}
else{
?>
<script type='text/javascript' src='<?=SITEURL?>assets/wp-content/plugins/wpgt-gallery/includes/js/gallery.js' id='wpgt-gallery-js'></script>
<script type='text/javascript' src='<?=SITEURL?>assets/wp-content/plugins/wpgt-gallery/includes/vendors/owlcarousel/owl.carousel.min.js' id='wpgt-gallery-owlcarousel-js'></script>
<?php
}
?>

<script>
/** TO DISABLE SCREEN CAPTURE **/
document.addEventListener('keyup', (e) => {
    if (e.key == 'PrintScreen') {
        navigator.clipboard.writeText('');
        //alert('Screenshots disabled!');
    }
});

<?php if(isset($_SESSION["payment_done"] )) { ?>

        document.addEventListener("DOMContentLoaded", function() {
            OpenPayment();
        });

    <?php unset($_SESSION["payment_done"]); ?>

<?php } ?>

function OpenPayment()
{
    $('#payment_done').show();

    $('#payment_done').addClass('active');
}

function paymentclose()
{
    $('#payment_done').hide();

      $('#payment_done').removeClass('active');
}

/** TO DISABLE PRINTS WHIT CTRL+P **/
document.addEventListener('keydown', (e) => {
    if (e.ctrlKey && e.key == 'p') {
       // alert('This section is not allowed to print or export to PDF');
        e.cancelBubble = true;
        e.preventDefault();
        e.stopImmediatePropagation();
    }
});
</script>
<?php
if(isset($_SESSION['log_user_id'])){
	DB::update('model_user', array('logged_update' => date('Y-m-d H:i:s')), "id=%s", $_SESSION['log_user_id']);
}
?>
<script>
    // Ultra Premium JavaScript with Full Functionality
    document.addEventListener('DOMContentLoaded', function() {
        initializePremiumFeatures();
    });

    function initializePremiumFeatures() {
        // Premium Particle System
        function createPremiumParticle() {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 12 + 's';
            particle.style.animationDuration = (Math.random() * 6 + 6) + 's';
            particle.style.opacity = Math.random() * 0.8 + 0.2;

            // Random particle colors
            const colors = [
                'rgba(139, 92, 246, 0.8)',
                'rgba(236, 72, 153, 0.6)',
                'rgba(6, 182, 212, 0.7)'
            ];
            const randomColor = colors[Math.floor(Math.random() * colors.length)];
            // particle.style.background = `radial-gradient(circle, ${randomColor} 0%, transparent 70%)`;

            // document.getElementById('particles').appendChild(particle);

            // setTimeout(() => {
            //     if (particle.parentNode) {
            //         particle.remove();
            //     }
            // }, 12000);
        }

        // Create particles with premium timing
        setInterval(createPremiumParticle, 150);

        // Premium Animated Counters
        function animatePremiumCounter(element, target) {
            let current = 0;
            const increment = target / 200;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current).toLocaleString();
            }, 10);
        }

        // Initialize all counters
        document.querySelectorAll('.stats-counter').forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            animatePremiumCounter(counter, target);
        });

        // Premium Scroll Reveal
        const premiumObserverOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const premiumObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    // Add micro-bounce animation
                    setTimeout(() => {
                        entry.target.classList.add('micro-bounce');
                    }, 300);
                }
            });
        }, premiumObserverOptions);

        document.querySelectorAll('.scroll-reveal, .scroll-reveal-left, .scroll-reveal-right').forEach(el => {
            premiumObserver.observe(el);
        });

        // Premium Search Functionality
        // const searchInput = document.getElementById('searchInput');
        // const searchSuggestions = document.getElementById('searchSuggestions');

        // searchInput.addEventListener('focus', () => {
        //     searchSuggestions.classList.add('show');
        // });

        // searchInput.addEventListener('blur', () => {
        //     setTimeout(() => {
        //         searchSuggestions.classList.remove('show');
        //     }, 300);
        // });

        // searchInput.addEventListener('input', (e) => {
        //     if (e.target.value.length > 0) {
        //         searchSuggestions.classList.add('show');
        //     } else {
        //         searchSuggestions.classList.remove('show');
        //     }
        // });

        // Initialize read more functionality
        initializeReadMore();

        // Premium responsive handling
        handlePremiumResponsive();
        window.addEventListener('resize', handlePremiumResponsive);

        // Add smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    // Premium Read More Functionality
    function initializeReadMore() {
        document.querySelectorAll('.description-text').forEach(text => {
            const fullText = text.getAttribute('data-full-text');
            const preview = text.querySelector('.description-preview');
            const readMoreBtn = text.querySelector('.read-more-btn');

            if (fullText && fullText.length > 80) {
                preview.textContent = fullText.substring(0, 80) + '...';
                readMoreBtn.classList.remove('hidden');
            } else if (fullText) {
                preview.textContent = fullText;
            }
        });
    }

    function toggleReadMore(button) {
        const descriptionText = button.closest('.description-text');
        const preview = descriptionText.querySelector('.description-preview');
        const fullText = descriptionText.getAttribute('data-full-text');
        const isExpanded = button.textContent === 'Read less';

        if (isExpanded) {
            preview.textContent = fullText.substring(0, 80) + '...';
            button.textContent = 'Read more';
        } else {
            preview.textContent = fullText;
            button.textContent = 'Read less';
        }
    }

    // Premium Tab Switching
    function switchTab(tabType) {
        const userTab = document.getElementById('userTab');
        const modelTab = document.getElementById('modelTab');
        const creatorFields = document.getElementById('creatorFields');

        if (tabType === 'user') {
            userTab.classList.add('bg-white', 'text-indigo-600');
            userTab.classList.remove('ultra-glass', 'text-white');
            modelTab.classList.add('ultra-glass', 'text-white');
            modelTab.classList.remove('bg-white', 'text-indigo-600');
            creatorFields.classList.add('hidden');
			
			jQuery('.user_type').val('user');
			
        } else {
            modelTab.classList.add('bg-white', 'text-indigo-600');
            modelTab.classList.remove('ultra-glass', 'text-white');
            userTab.classList.add('ultra-glass', 'text-white');
            userTab.classList.remove('bg-white', 'text-indigo-600');
            creatorFields.classList.remove('hidden');
			
			jQuery('.user_type').val('model');
			
        }
    }

    // Premium Password Toggle
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('passwordInput');
        const toggleButton = document.getElementById('togglePassword');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';

        passwordInput.setAttribute('type', type);
        toggleButton.innerHTML = type === 'password' ?
            '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>' :
            '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>';
    }

    // Premium Modal Functions
	var model_array_json = <?php echo json_encode($model_array); ?>;
	function openModelPreview_new(modelId) { //console.log(model_array_json); 
        const modal = document.getElementById('modelModal');
        const modalContent = document.getElementById('modalContent');
		
        const model = model_array_json[modelId];
        if (model) {
            modalContent.innerHTML = `
                <div class="flex flex-col lg:flex-row gap-8">
                    <div class="lg:w-1/2">
                        <img src="${model.image}" alt="${model.name}" class="w-full rounded-2xl object-cover shadow-2xl">
                    </div>
                    <div class="lg:w-1/2 space-y-6">
                        <div class="flex justify-between items-center">
                            <h4 class="text-3xl font-bold premium-text">${model.name}</h4>
                            <span class="text-xl text-white/60 font-medium">${model.age}</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="w-4 h-4 bg-green-500 rounded-full ${model.status === 'online' ? 'animate-pulse' : ''}"></span>
                            <span class="text-indigo-400 font-semibold text-lg">${model.status === 'online' ? 'Online Now' : model.status === 'away' ? 'Away' : 'In Private Show'}</span>
                        </div>
                        <p class="text-indigo-400 font-semibold text-xl">${model.services}</p>
                        <p class="text-white/80 text-lg leading-relaxed">${model.bio}</p>
                        <div class="flex justify-between text-lg text-white/60">
                            <span class="font-medium">❤️ ${model.likes} Likes</span>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#667eea" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                <span class="font-bold">${model.rating}</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <button class="w-full btn-primary text-white font-bold py-4 rounded-xl text-lg" onclick="connectWithModel('${modelId}')">
                                💕 Connect Now
                            </button>
                            <button class="w-full btn-secondary text-white font-semibold py-4 rounded-xl text-lg" onclick="sendMessage('${modelId}')">
                                💌 Send Message
                            </button>
                        </div>
                    </div>
                </div>
            `;
            modal.classList.add('show');
        }
    }
	
	
    function openModelPreview(modelId) {
        const modal = document.getElementById('modelModal');
        const modalContent = document.getElementById('modalContent');

        const modelData = {
            aria: {
                name: 'Aria M.',
                age: 24,
                image: 'https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=500&h=700&fit=crop',
                status: 'online',
                services: 'Chat, Watch & Meet',
                bio: 'Let me be your escape from reality. I promise an unforgettable experience that will leave you wanting more and more.',
                likes: '2.4K',
                rating: '4.9'
            },
            phoenix: {
                name: 'Phoenix R.',
                age: 26,
                image: 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=500&h=700&fit=crop',
                status: 'online',
                services: 'Chat & Watch',
                bio: 'Life\'s too short for boring conversations. Let\'s make memories together and create something truly special.',
                likes: '1.8K',
                rating: '4.8'
            },
            nova: {
                name: 'Nova S.',
                age: 23,
                image: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=500&h=700&fit=crop',
                status: 'away',
                services: 'Chat, Watch & Meet',
                bio: 'Your fantasy is my reality. Let me show you a world you\'ve never seen before, filled with passion and excitement.',
                likes: '3.1K',
                rating: '4.9'
            },
            zara: {
                name: 'Zara C.',
                age: 25,
                image: 'https://images.unsplash.com/photo-1488161628813-04466f872be2?w=500&h=700&fit=crop',
                status: 'busy',
                services: 'Chat & Watch',
                bio: 'They say I\'m addictive. Care to find out why? Your satisfaction is my priority and I\'ll make sure you have the time of your life.',
                likes: '1.5K',
                rating: '4.7'
            }
        };

        const model = modelData[modelId];
        if (model) {
            modalContent.innerHTML = `
                <div class="flex flex-col lg:flex-row gap-8">
                    <div class="lg:w-1/2">
                        <img src="${model.image}" alt="${model.name}" class="w-full rounded-2xl object-cover shadow-2xl">
                    </div>
                    <div class="lg:w-1/2 space-y-6">
                        <div class="flex justify-between items-center">
                            <h4 class="text-3xl font-bold premium-text">${model.name}</h4>
                            <span class="text-xl text-white/60 font-medium">${model.age}</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="w-4 h-4 bg-green-500 rounded-full ${model.status === 'online' ? 'animate-pulse' : ''}"></span>
                            <span class="text-indigo-400 font-semibold text-lg">${model.status === 'online' ? 'Online Now' : model.status === 'away' ? 'Away' : 'In Private Show'}</span>
                        </div>
                        <p class="text-indigo-400 font-semibold text-xl">${model.services}</p>
                        <p class="text-white/80 text-lg leading-relaxed">${model.bio}</p>
                        <div class="flex justify-between text-lg text-white/60">
                            <span class="font-medium">❤️ ${model.likes} Likes</span>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#667eea" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                <span class="font-bold">${model.rating}</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <button class="w-full btn-primary text-white font-bold py-4 rounded-xl text-lg" onclick="connectWithModel('${modelId}')">
                                💕 Connect Now
                            </button>
                            <button class="w-full btn-secondary text-white font-semibold py-4 rounded-xl text-lg" onclick="sendMessage('${modelId}')">
                                💌 Send Message
                            </button>
                        </div>
                    </div>
                </div>
            `;
            modal.classList.add('show');
        }
    }
	

    function closeModelPreview() {
        const modal = document.getElementById('modelModal');
        modal.classList.remove('show');
    }

    // Close modal when clicking outside
    // document.getElementById('modelModal').addEventListener('click', function(e) {
    //     if (e.target === this) {
    //         closeModelPreview();
    //     }
    // });

    // Premium Responsive Handling
    function handlePremiumResponsive() {
        const isMobile = window.innerWidth < 768;
        const isTablet = window.innerWidth < 1024;

        // Adjust container padding based on screen size
        document.querySelectorAll('.container').forEach(container => {
            if (isMobile) {
                container.style.paddingLeft = '1rem';
                container.style.paddingRight = '1rem';
            } else if (isTablet) {
                container.style.paddingLeft = '1.5rem';
                container.style.paddingRight = '1.5rem';
            } else {
                container.style.paddingLeft = '2rem';
                container.style.paddingRight = '2rem';
            }
        });
    }

    // Premium Button Functions
    function handleSignIn() {
        alert('🔐 Premium Sign In - Redirecting to secure login portal...');
    }

    function handleSearch() {
        const searchValue = document.getElementById('searchInput').value;
        alert(`🔍 Premium Search - Searching for: "${searchValue || 'all models'}"`);
    }

    function handleSignup(event) {
        event.preventDefault();
        const formData = new FormData(event.target);
        const isModel = !document.getElementById('creatorFields').classList.contains('hidden');

        const message = isModel ?
            '🌟 Welcome to Live Models! Your model profile is being reviewed for verification. You\'ll receive an email within 24 hours.' :
            '🎉 Welcome to Live Models! Your account has been created. Start exploring amazing models now!';

        alert(message);
    }

    function selectSuggestion(modelId) {
        document.getElementById('searchInput').value = '';
        document.getElementById('searchSuggestions').classList.remove('show');
        openModelPreview(modelId);
    }

    function connectWithModel(modelId) {
       // alert(`💕 Premium Connection - Connecting with ${modelId}...`);
	   window.location.href = '<?= SITEURL ?>single-profile.php/'+modelId;
        closeModelPreview();
    }

    function sendMessage(modelId) {
        alert(`💌 Premium Messaging - Opening chat with ${modelId}...`);
        closeModelPreview();
    }

    function upgradeToVIP() {
        alert('👑 Premium Features - Exploring advanced platform capabilities...');
    }

    function viewAllModels() {
        //alert('👥 Premium Browse - Loading all verified members...');
		window.location.href = '<?= SITEURL ?>all-members.php';
    }

    function becomeModel() {
        alert('⭐ Model Application - Redirecting to model registration...');
    }

    function joinAsMember() {
        alert('🎊 Member Registration - Creating your premium account...');
    }

    function openSocial(platform) {
        alert(`📱 Social Media - Opening ${platform} page...`);
    }

    function navigateTo(page) {
        //alert(`🔗 Navigation - Going to ${page} page...`);
		window.location.href = '<?= SITEURL ?>'+page;
		toggleSidebar(); 
    }

    function openSupport() {
        alert('🎧 Premium Support - Opening 24/7 support chat...');
    }

    function openVerificationHelp() {
        alert('✅ Verification Help - Opening verification guide...');
    }

    function openTerms() {
        alert('📋 Terms of Service - Opening legal documents...');
    }

    function openPrivacy() {
        alert('🔒 Privacy Policy - Opening privacy information...');
    }

    function openVerificationPolicy() {
        alert('🛡️ Verification Policy - Opening verification guidelines...');
    }
</script>

<script>

    function AddComment(element)
    { 
        $(`#${element}`).slideToggle();
    }

    function AddLike(comment_id)
    {
        var post_id = $(`#post_id_${comment_id}`).val();

        var user_id = $(`#user_id_${comment_id}`).val();

        $.ajax({

            url: 'addcomment.php', 
            type: 'POST',
            data:{
              post_id:post_id,
              user_id:user_id,
              action:"like",
            },
            success: function (response) {

               if (response.trim() === 'Liked')
              {
                 $(`#user_id_${comment_id}`)

                   var like_count = parseInt($(`#post_like_${comment_id}`).text()) || 0;

                    like_count++;

                  $(`#post_like_${comment_id}`).text(like_count);

                  $(`#add_like_${comment_id}`).addClass('liked_comment');
              }

              if (response.trim() === 'Unliked')
              {
                 $(`#user_id_${comment_id}`)

                   var like_count = parseInt($(`#post_like_${comment_id}`).text()) || 0;

                    like_count--;

                  $(`#post_like_${comment_id}`).text(like_count);

                  $(`#add_like_${comment_id}`).removeClass('liked_comment');

              }
              
            },

            error: function (xhr) {
               
            }
        });
    }

    function AddMessage(comment_id)
    {
        var post_id = $(`#post_id_${comment_id}`).val();

        var user_id = $(`#user_id_${comment_id}`).val();

        var comment = $(`#comment_content_${comment_id}`).val();

        var author_name = $(`#author_name_${comment_id}`).val();

        var author_email = $(`#author_email_${comment_id}`).val();

        var image_url = $(`#image_url${comment_id}`).val();

        $.ajax({

            url: 'addcomment.php', 
            type: 'POST',
            data:{

              post_id:post_id,
              user_id:user_id,
              comment:comment,
              author_name:author_name,
              author_email:author_email,
              action:"comment",
            },
            success: function (response) {

              $(`.no_comment_${comment_id}`).remove();

              var count_comment = parseInt($(`#count_comment_${comment_id}`).text()) || 0;

              count_comment++;

              $(`#count_comment_${comment_id}`).text(count_comment);


              var image_html = "";

              if(image_url !== "")
              {
                image_html += `<img src="${image_url}" alt="User" class="w-8 md:w-10 h-8 md:h-10 rounded-full">`;
              }

               $(`.comnt_user_${comment_id}`).before(`
                    <div class="flex items-start mb-4">
                        ${image_html}
                        <div class="ml-3 glass-effect rounded-lg p-3 flex-1">
                            <p class="font-medium text-xs md:text-sm">${author_name}</p>
                            <p class="text-xs md:text-sm text-white/80">${comment}</p>
                        </div>
                    </div>
                `);

              $(`#comment_content_${comment_id}`).val('');
              
            },

            error: function (xhr) {
               
            }
        });
    }

    const hamburger = document.getElementById('hamburgerMenu');
    const sidebar = document.getElementById('sidebarMenu');
    const overlay = document.getElementById('sidebarOverlay');

    hamburger.addEventListener('click', toggleSidebar);
    overlay.addEventListener('click', toggleSidebar);

    function toggleSidebar() {
      hamburger.classList.toggle('open');
      sidebar.classList.toggle('open');
      overlay.classList.toggle('open');

      // Prevent body scrolling when sidebar is open
      if (sidebar.classList.contains('open')) {
        document.body.style.overflow = 'hidden';
      } else {
        document.body.style.overflow = '';
      }
    }

    // Simple like function
    function toggleLike(button) {
      const span = button.querySelector('span');
      const currentCount = parseInt(span.textContent);

      if (button.classList.contains('liked')) {
        button.classList.remove('liked');
        span.textContent = currentCount - 1;
      } else {
        button.classList.add('liked');
        span.textContent = currentCount + 1;
      }
    }

    // Simple connect function
    function toggleConnect(button) {
      if (button.textContent === 'Connect') {
        button.textContent = 'Connected';
        button.style.background = 'linear-gradient(45deg, #10b981, #34d399)';
      } else {
        button.textContent = 'Connect';
        button.style.background = 'var(--primary-gradient)';
      }
    }

   

    // Profile functions
    function viewProfile() {
      alert('Opening your profile...');
    }

    function editProfile() {
      alert('Opening profile editor...');
    }

    function logout() {
      if (confirm('Are you sure you want to logout?')) {
        alert('Logging out...');
      }
    }

    document.querySelectorAll('.mobile-nav-item').forEach(item => {
      item.addEventListener('click', function() {
        document.querySelectorAll('.mobile-nav-item').forEach(i => i.classList.remove('active'));
        this.classList.add('active');
      });
    });
  </script>
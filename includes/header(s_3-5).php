<?php 
//session_start(); 
include('config.php');
?>
<!--<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<script src="<?='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'?>"></script>-->
<link rel="stylesheet" type="text/css" href="<?=SITEURL.'includes/foot-style.css'?>">
<style type="text/css">
  
  .bot_plus{
    transition: 0.3s !important;
  }
  .bot_plus:hover{
    transform: scale(1.1);
  }
  .navbar{
    padding-top: 20px;
    padding-bottom: 20px;
  }
  nav{
    border-bottom: 2px solid #d83b1b;
  }
  @media screen and (max-width: 600px) {
    .navbar-collapse .navbar-responsive-collapse .collapse .in{
      width: 100% !important;
    }
    .side-menu
    {
      display: none !important;
    }
    
  }
  @media screen and (min-width: 600px) {
    .navbar-collapse .navbar-responsive-collapse .collapse .in{
      width: 100% !important;
    }
    
    body{
      overflow-x: hidden !important;
    }
  }
  @media screen and (max-width: 767px) {
     .desktop-view{
      display: none!important;
     }
     .mobail-view img {
      display: block!important;
     }
    }
    .mobail-view img{
      height: 65px;
      width: 93%;
      margin-left: 10px;
      padding: 10px 0px 0px 0px;
      display: none;
    } 



</style>
<!-- <script>
$(document).ready(function(){
  $("#darkmode1").click(function(){
     //alert("ok");
    $("#darkmode_text1").text("Normal Mode");
    $("body").toggleClass("dark-mode");
    $("p").toggleClass("dark-mode-for-tag");
    $("h1").toggleClass("dark-mode-for-tag");
    $("h2").toggleClass("dark-mode-for-tag");
    $("h3").toggleClass("dark-mode-for-tag");
    $("h4").toggleClass("dark-mode-for-tag");
    $("h5").toggleClass("dark-mode-for-tag");
    $("h6").toggleClass("dark-mode-for-tag");
    $("span").toggleClass("dark-mode-for-tag");
    $("button").toggleClass("dark-mode-for-tag");
    $("#menu").toggleClass("dark-mode");
    $("#menu").toggleClass("dark-mode");
    $("#footer li").toggleClass("dark-mode");
    $("#menuToggle input:checked ~ span").toggleClass("dark-mode-for-tag");
    $(".btn-success").toggleClass("dark-mode-for-tag");
    $(".btn-info").toggleClass("dark-mode-for-tag");
    $("select").toggleClass("dark-mode");
    $("#sub-floor").toggleClass("dark-mode");
    $(".footer-tint").toggleClass("dark-mode");
    $(".navbar-inverse").toggleClass("dark-mode");
    $(".sml_tst").toggleClass("dark-mode");
    $("header").toggleClass("dark-mode");
    $("footer").toggleClass("dark-mode");
    $(".modal-content").toggleClass("dark-mode-for-model");
  });
});
</script> -->
<header class="header">
  <div class="container-fluid" style="margin:0px auto;padding:0px;">
  <nav role="navigation" > 
    <div class="navbar navbar-default navbar-inverse navbar-right" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <div class="logo" style="width: 410px;">
            <a href="<?=SITEURL?>"><img src="<?=SITEURL?>uploads/live-model-logo.png" style="    border-radius: 10px;" align="thelivemodel Logo"></a>
             <!-- <div class="desktop-view"><img src="assets/images/token.jpg" style="width: 80%;padding: 5px 0px 0px 15px; height: 65px; margin-top: -88px;  margin-left: 120px;" ></div> -->
          </div>

          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse nav-width " style="float: right;">
          <ul id="menu-main-menu" class="nav navbar-nav navbar-right">
            <li id="menu-item-764" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-307 current_page_item menu-item-764 active"><a title="Home" href="<?=SITEURL?>">Home</a></li>
            
            <li id="menu-item-759" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-759"><a title="FAQ" href="<?=SITEURL?>all-models.php">All Models</a></li>
            <li class="menu-item menu-item-type-post_type menu-item-object-page "><a href="<?=SITEURL?>advertisements">Advertisement</a></li>
              
            <li id="menu-item-767" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-767 dropdown">
                <a title="Services" href="services.php" data-toggle="dropdown" class="dropdown-toggle">Services <span class="caret"></span></a>
                <ul role="menu" class=" dropdown-menu">
              	     <li id="menu-item-761" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-761">
                         <a title="" href="services.php?type=livecam">Live Cam</a>
                    </li>
              	     <li id="menu-item-763" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-763">
                         <a title="" href="services.php?type=groupshow"> Group Show </a>
                    </li>
                     <li id="menu-item-763" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-763">
                         <a title="" href="services.php?type=dating"> Dating Assignment  </a>
                    </li>
                     <li id="menu-item-763" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-763">
                         <a title="" href="services.php?type=invite"> Accept Invitaion Tours </a>
                    </li>
                     <li id="menu-item-763" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-763">
                         <a title="" href="services.php?type=content"> Sell Video & Images </a>
                    </li>
                     <li id="menu-item-763" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-763">
                         <a title="" href="services.php?type=modeling"> Accept Modeling & Movies Assignments </a>
                    </li>
                    <li id="menu-item-763" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-763">
                         <a title="" href="services.php?type=30days"> All 30 Days Access </a>
                    </li>
                </ul>
            </li>  

            <!-- <li id="menu-item-759" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-759"><a title="FAQ" href="<?=SITEURL?>faq.php">FAQ</a></li> -->
          
            <!-- <li id="menu-item-760" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-760"><a title="All Reviews" href="all-reviews/index.html">All Reviews</a></li> -->
            
           <!--  <li id="menu-item-767" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-767 dropdown"><a title="Blog" href="#" data-toggle="dropdown" class="dropdown-toggle">Blog <span class="caret"></span></a>
              <ul role="menu" class=" dropdown-menu">
              	<li id="menu-item-761" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-761"><a title="Blog - Full Width" href="blog-no-sidebar/index.html">Blog &#8211; Full Width</a></li>
              	<li id="menu-item-763" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-763"><a title="Blog - Normal" href="blog/index.html">Blog &#8211; Normal</a></li>
              </ul>
            </li> -->

          <!-- <li id="menu-item-762" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-762"><a title="Booking" href="booking/index.html">Booking</a></li> -->

          

          <?php if($_SESSION["log_user"]){ ?>

          <?php
              $log_user_id = $_SESSION["log_user_unique_id"];
              $sql1 = "SELECT * FROM model_user WHERE unique_id = '".$log_user_id."'";
              $result1 = mysqli_query($con,$sql1);

              if (mysqli_num_rows($result1) > 0) {

                $row1 = mysqli_fetch_assoc($result1);
                 
                 $status = $row1['as_a_model'];
                 if($status == 'Yes'){
          ?>

            <!-- <li id="menu-item-867" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-867"><a title="Casting" href="<?=SITEURL?>model-panel/dashboard.php">Broadcast Panel</a></li> -->

          <?php }else if($status == 'No'){ ?>

            <li id="menu-item-867" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-867"><a title="Casting" href="<?=SITEURL?>new-broadcaster.php">Become a Broadcaster</a></li>
            
          <?php } 

              }
            ?>

           <!--  <li id="menu-item-767" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-767 dropdown">
              <a title="Blog" href="#" data-toggle="dropdown" class="dropdown-toggle">Hello <?php echo $_SESSION["log_user"]; ?>
                <span class="caret"></span>
              </a>
              <ul role="menu" class=" dropdown-menu">
              	<?php
		            $log_user_id = $_SESSION["log_user_unique_id"];
		            $sql = "SELECT * FROM model_user_wallet WHERE user_unique_id = '".$log_user_id."'";
		            $result = mysqli_query($con,$sql);

		              if (mysqli_num_rows($result) > 0) {

		                $row1 = mysqli_fetch_assoc($result);
		                 
		                $wallet_coins = $row1['wallet_coins'];
		            }
		                 
		        ?>
                <li id="menu-item-761" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-761"><a title="" href="<?=SITEURL?>wallet.php">Wallet&nbsp;(<i class="fas fa-coins" style="font-size:15px;color:gold" aria-hidden="true"></i><?php if($wallet_coins){ echo $wallet_coins; }else{ echo '0'; }  ?>)&nbsp;</a></li>
                
                <li id="menu-item-763" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-763"><a title="" href="<?=SITEURL?>edit-profile.php">Edit Profile</a></li>
                <li id="menu-item-763" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-763"><a title="" href="<?=SITEURL?>logout.php">Logout</a></li>
              </ul>
            </li>             -->

          <?php }else{ ?>
            <li id="menu-item-758" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-758"><a title="Contact Us" href="<?=SITEURL?>login.php">Sign In</a></li>
          <?php } ?>
          <!-- <nav role='navigation'> -->
                  <div id="menuToggle" class="side-menu">
                    
                    <input type="checkbox" />
                    
                    <span></span>
                    <span></span>
                    <span></span>

                    <?php   
                      $sqls = "SELECT * FROM model_user WHERE unique_id = '".$_SESSION["log_user_unique_id"]."' ";
                      $resultd = mysqli_query($con, $sqls);
                      if (mysqli_num_rows($resultd) > 0) {
                        $rowesdw = mysqli_fetch_assoc($resultd);
                        $pro_path = $rowesdw['profile_pic'];
                      }
                    ?>
                  
                    <ul id="menu">
                      <?php if($_SESSION["log_user"]){ ?>
                      <img style="height: 50px;border-radius: 50%;float: left;" src="<?=SITEURL?><?php echo $pro_path; ?>">
                      
                      <div style="margin-bottom: 20px;">
                        <p class="prof_text"><?php echo $_SESSION["log_user"]; ?></p>
                        <small class="prof_elink"><a href="<?=SITEURL?>edit-profile.php">Edit Details</a></small>
                      </div>
                      <hr>
                      <?php
                        $sql_flow = "SELECT COUNT(status) FROM model_follow WHERE unique_model_id = '".$_SESSION["log_user_unique_id"]."' AND status = 'Follow' Order by id DESC";
                         $result_flow = mysqli_query($con, $sql_flow);
                         if (mysqli_num_rows($result_flow) > 0) {
                           $row_flow = mysqli_fetch_assoc($result_flow);
                           $num3 = $row_flow['COUNT(status)'];
                         }
                         $sql_flow1 = "SELECT COUNT(status) FROM model_follow WHERE unique_user_id = '".$_SESSION["log_user_unique_id"]."' AND status = 'Follow' Order by id DESC";
                         $result_flow1 = mysqli_query($con, $sql_flow1);
                         if (mysqli_num_rows($result_flow1) > 0) {
                           $row_flow1 = mysqli_fetch_assoc($result_flow1);
                           $num2 = $row_flow1['COUNT(status)'];
                         }
                      ?>
                      <div style="float: left;text-align: center;">
                        <h5 style="color: #8d8d8d;">Followers</h5>
                        <div class="followbers_popup">
                        <p style="cursor:pointer;" data-toggle="modal" data-target="#exampleModall"><?php echo $num3; ?></p>
                      </div>
                     
                      </div>
                      <div class="followbers_popup" style="text-align: center;">
                        <h5 style="color: #8d8d8d;">Following</h5>
                        <p style="cursor:pointer;" data-toggle="modal" data-target="#myModal"><?php echo $num2; ?></p>

                      </div>

                      <hr>
                      <?php if($_SESSION["user_type"] == 'Model'){ ?>
                      <a href="<?=SITEURL?>model-panel/edit-extra-details.php"><li>Edit profile detail</li></a>
                      <?php } ?>
                      <hr>
                      <!-- <a href="<?=SITEURL?>model-panel/insta-snap.php"><li>Add Insta and Snap coins</li></a>
                      <hr>
                      <a href="<?=SITEURL?>model-panel/social-media.php"><li>Add Social Links</li></a>
                      <hr> -->
                      <a href="<?=SITEURL?>wallet.php"><li>Wallet </li></a>
                      <hr>
                      <a title="" href="<?=SITEURL?>my-purchase.php"><li>My Purchase</li></a>
                       <hr>
                      <a href="<?=SITEURL?>model-panel/amount-withdrawal.php"><li>Withdraw ( Connect you bank details)</li></a>
                      <hr>
                      <a href="<?=SITEURL?>services-requested.php"><li>Services Requested</li></a>
                      <hr>
                      <a href="<?=SITEURL?>single-profile.php?m_unique_id=<?php echo $_SESSION["log_user_unique_id"]; ?>"><li>My Profile</li></a>
                      <hr>
                      <a href="<?=SITEURL?>advertisement/list.php"><li>Advertisement</li></a>
                      <hr>
                      
                      <!-- <hr>
                      <a id="darkmode1"><li id="darkmode_text1">Dark Mode</li></a>
                      <hr> -->
                      <!-- <a id="darkmode1"><li id="darkmode_text1">Live Broadcast</li></a>
                      <hr> -->
                      <a href="<?=SITEURL?>notifications.php"><li>Notifications</li></a>
                      <hr>
                      <a href="<?=SITEURL?>supports.php"><li>Support</li></a>
                      <hr>
                      <a href="<?=SITEURL?>logout.php"><li>Logout</li></a>
                      <hr>
                    
                    <?php }else{ ?>
                      <hr>
                      <a href="<?=SITEURL?>all-models.php"><li>All Models</li></a>
                      <hr>
                      <a href="<?=SITEURL?>login.php"><li>Login</li></a>
                      <hr>
                    <?php } ?>
                    </ul>
                  </div>
                <!-- </nav> -->
          </ul>        
        </div>
        <!-- <div class="mobail-view"><img src="assets/images/token.jpg"></div> -->
        <div></div>
      </div>
    </div>
  </nav>
</div>
</header>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-GD6CJ961PF"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-GD6CJ961PF');
</script>

       


        <div class="modal fade" id="exampleModall" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content" style=" width: 50%;margin: auto;background: #6d1e11 ">
                  <div class="modal-headera">
                    <div class="modal-titlea" id="exampleModalLabel"> Followers</div>
                    <button style="margin-top: -45px;margin-right:7px; opacity: 1; color: white" type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-bodya">
                      <a href=""><table style="color: white;">
                        <tr><td style="padding: 10px;">
                                         
                            <?php
                    
                     //$x = $_GET['m_unique_id'];

                    // echo $x;
                      
                    $query = "SELECT * from model_follow where unique_model_id ='".$_SESSION['log_user_unique_id']."' AND status = 'Follow' ";
                    
                     //echo $query;
                    $resultd = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_assoc($resultd)){

                      if(isset($row))
                      {
                       // echo $row['unique_user_id'];
                        // echo $row['unique_user_id']."<br>";
                        $query1 = "SELECT * from model_user where unique_id ='".$row['unique_user_id']."'";
                    
                         //echo $query;
                        $resultd1 = mysqli_query($con, $query1);
                        while ($row1 = mysqli_fetch_assoc($resultd1)){

                          if(isset($row1))
                          {
                                     // echo $row['unique_user_id'];
                                     // echo $row[0];
                                     if($row1['username'] != $_SESSION["log_user"]){

                                       echo $row1['name']."<br><br>";
                                      }
                                    }
                                  }
                                }
                              }
                              
                               ?>
                                     <?php //echo $row['unique_user_id']?>

                                      </td></tr>
                                </table></a>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>


                    <!-- ghgg -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content" style=" width: 50%;margin: auto;background: #6d1e11 ">
                  <div class="modal-headera">
                    <div class="modal-titlea" id="exampleModalLabel"> Following</div>
                    <button style="margin-top: -45px;margin-right:7px; opacity: 1; color: white" type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-bodya">
                      <a href=""><table style="color: white;">
                        <tr><td style="padding: 10px;">
                                 


                            <?php
                    
                     //$x = $_GET['m_unique_id'];

                    // echo $x;
                      
                    $query = "SELECT * from model_follow where unique_user_id ='".$_SESSION['log_user_unique_id']."' AND status = 'Follow' ";
                    
                     //echo $query;
                    $resultd = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_assoc($resultd)){

                      if(isset($row))
                      {
                       // echo $row['unique_user_id'];
                        // echo $row['unique_user_id']."<br>";
                        $query1 = "SELECT * from model_user where unique_id ='".$row['unique_model_id']."'";
                    
                         //echo $query;
                        $resultd1 = mysqli_query($con, $query1);
                        while ($row1 = mysqli_fetch_assoc($resultd1)){

                          if(isset($row1))
                          {
                                     // echo $row['unique_user_id'];
                                     // echo $row[0];
                            if($row1['username'] != $_SESSION["log_user"]){
                              echo $row1['name']."<br><br>";
                            }
                                    }
                                  }
                                }
                              }
                              
                               ?>
                                    

                                      </td></tr>
                                </table></a>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>

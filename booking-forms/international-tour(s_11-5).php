<?php
session_start();
?>
<html lang="en-US" class="no-js">
<?php 
    $usern = $_SESSION["log_user"];

    if($_SESSION["log_user_unique_id"] == $_GET['m_id']){
      echo '<script>alert("Oops!! You cant book your own services. Please use another model to book service.")</script>';
      echo '<script>window.history.back();</script>';
    }
    
    if( !$usern ){
        echo '<script>alert("Oops!! You need to register or Login first. Going to login page....")</script>';
        echo '<script>window.location.href="../login.php"</script>';
    }
?>
<?php include('../includes/config.php'); ?>
<!doctype html>
<html lang="en-US" class="no-js">
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <head>
<?php include('header.php');?>
  </head>
  <body class="page-template-default page page-id-311 custom-background">
    <?php include('../includes/header.php'); ?>
    <div class="container-fluid">
      <div id="content" class="clearfix row">
        <div id="main" class="col-md-12 clearfix" role="main">
          <article id="post-311" class="clearfix post-311 page type-page status-publish hentry" role="article" itemscope itemtype="http://schema.org/BlogPosting">
            <header class="page-head article-header">
              <div class="headline-outer">
                <h1 itemprop="headline" class="page-title entry-title">
                  <div class="prefancy fancy"><span>Booking for International Tour</span></div>
                </h1>
              </div>
            </header>
            <section class="page-content entry-content clearfix" itemprop="articleBody">
              <div class="artivle-body-bg">
                <center><p>Once you have submit request your coins will be deducted from your account.</p></center>
                <?php   
                  $sqls = "SELECT * FROM model_user WHERE unique_id = '".$_SESSION["log_user_unique_id"]."' ";
                  $resultd = mysqli_query($con, $sqls);
                  if (mysqli_num_rows($resultd) > 0) {
                    $rowesdw = mysqli_fetch_assoc($resultd);
                    $pro_path = $rowesdw['profile_pic'];
                  }
                ?>
                <?php   
                 $_GET["m_id"];
                  $sqls1 = "SELECT * FROM model_user WHERE unique_id = '".$_GET["m_id"]."' ";
                  $resultd1 = mysqli_query($con, $sqls1);
                  if (mysqli_num_rows($resultd1) > 0) {
                    $rowesdw1 = mysqli_fetch_assoc($resultd1);
                     $pro_path1 = $rowesdw1['profile_pic'];
                     $model_city = $rowesdw1['city'];
                     $profile_name = $rowesdw1['name'];

                  }
                ?>
                <div class="container-fluid" >
                 <div class="row" style="margin-left:0px;margin-right:0px;"> 
                  <div class="col-sm-4"></div>
                   <div class="col-sm-4  ">
<div style="display: flex;align-items: center;justify-content: center;">
<div style="text-align: center;min-width:40%">
<img style="height:50px; width:50px; border-radius: 50%; margin-top: 40px;"
src="https://thelivemodels.com/<?php echo $pro_path; ?>" > 
<p style="text-align: center;color: white;"><?php echo $_SESSION["log_user"]; ?></p>
</div>
<div style="text-center"><img style="height: 20px;" src="https://thelivemodels.com/assets/images/two-way-arrow.gif" ></div>
<div style="text-align: center;min-width:40%">  <img style="height:50px; width:50px;border-radius: 50%; margin-top: 40px;" src="https://thelivemodels.com/<?php echo $pro_path1; ?>" >
<p style="text-align: center;color: white;"><?php echo $profile_name; ?></p> </div>
</div>
                    
                 </div>
                 <div class="col-sm-4"></div>
                </div>
              </div>

              <center><hr>THE USER IS IN CITY <span style="font-weight: bold;font-size: 20px;    text-transform: capitalize;"><?php echo $_SESSION["city"] ?></span> AND THE MODEL IS IN CITY <span style="font-weight: bold;font-size: 20px;    text-transform: capitalize;"><?php echo $model_city ?></span><hr></center>
                <!-- <center>
                  <div>
                    <img style="height: 50px;border-radius: 50%;float: left;" src="https://thelivemodels.com/<?php echo $pro_path; ?>">
                    <p class="prof_text"><?php echo $_SESSION["log_user"]; ?></p>
                  </div>
                  <img src="https://thelivemodels.com/assets/images/two-way-arrow.gif">
                  <div>
                    <img style="height: 50px;border-radius: 50%;float: left;" src="https://thelivemodels.com/<?php echo $pro_path1; ?>">
                    <p class="prof_text"><?php echo $profile_name; ?></p>
                  </div>
                </center>
 -->                <div id="vfb-form-1" class="visual-form-builder-container">
                  <form class="visual-form-builder vfb-form-1" action="act-international-tour.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="form_id" value="1" />
                    <fieldset class="vfb-fieldset vfb-fieldset-1 your-contact-details" id="item-vfb-1">
                      <div class="vfb-legend">
                        <h3>Your Contact Details</h3>
                      </div>
                      <ul class="vfb-section vfb-section-1">
                        <!-- <li class="vfb-item vfb-item-text vfb-left-half" id="item-vfb-5">
                          <label for="vfb-5" class="vfb-desc">Your Name <span class="vfb-required-asterisk">*</span></label>
                          <input type="text" name="name" id="vfb-5" value="" class="vfb-text vfb-medium required" />
                        </li>
                        <li class="vfb-item vfb-item-text vfb-right-half" id="item-vfb-6">
                          <label for="vfb-6" class="vfb-desc">Your Phone Number <span class="vfb-required-asterisk">*</span></label><input type="text" name="phone" id="vfb-6" value="" class="vfb-text vfb-medium required" />
                        </li>
                        <li class="vfb-item vfb-item-email vfb-left-half" id="item-vfb-7">
                          <label for="vfb-7" class="vfb-desc">Your Email <span class="vfb-required-asterisk">*</span></label><input type="email" name="email" id="vfb-7" value="" class="vfb-text vfb-medium required email" />
                        </li> -->
                        <input type="hidden" name="user_unique_id" value="<?php echo $_SESSION["log_user_unique_id"]; ?>">
                        
                        <li class="vfb-item vfb-item-text vfb-left-half" id="item-vfb-8">
                          <label for="vfb-8" class="vfb-desc">Booking for: <span class="vfb-required-asterisk">*</span></label>
                          <select name="book_for" id="vfb-13-hour" class="vfb-select required">
                            <option value="2">2 Hour</option>
                            <option value="4">4 Hour</option>
                            <option value="8">Overnight (8 Hour)</option>
                          </select>
                        </li>
                        <li class="vfb-item vfb-item-text vfb-right-half" id="item-vfb-8">
                          <label for="vfb-8" class="vfb-desc">Do You Want to Meet the Model? <span class="vfb-required-asterisk">*</span></label>
                          <input type="radio" id="yes_meet" name="meet_model" value="Yes">
                          <label for="yes_meet" style="display: inline;"> Yes</label>
                          <input type="radio" id="no_meet" name="meet_model" value="No">
                          <label for="no_meet" style="display: inline;"> No</label>
                        </li>
                        <li class="vfb-item vfb-item-text vfb-left-half" id="item-vfb-8">
                          <label for="vfb-8" class="vfb-desc">Are You Willing to Sponser her Trip? <span class="vfb-required-asterisk">*</span></label>
                          <input type="radio" id="yes_sposer" name="sponser_trip" value="Yes">
                          <label for="yes_sposer" style="display: inline;"> Yes</label>
                          <input type="radio" id="no_sponser" name="sponser_trip" value="No">
                          <label for="no_sponser" style="display: inline;"> No</label>
                        </li>
                        <div id="no_sponser_div" style="display: none;">
                          <li class="vfb-item vfb-item-text vfb-left-half" id="item-vfb-8">
                            <input type="checkbox" id="notifiy" name="notifiy" value="Yes">
                            <label for="notifiy" style="display: inline;"> Notify when the model visits my country</label>
                          </li>
                        </div>
                        <div id="yes_sponser" style="display: none;">
                          <li class="vfb-item vfb-item-text vfb-left-half" id="item-vfb-8">
                            <label for="vfb-8" class="vfb-desc">WILL YOU BOOK MY TRAVEL? <span class="vfb-required-asterisk">*</span></label>
                            <input type="radio" id="yes_travel" name="book_travel" value="Yes">
                            <label for="yes_travel" style="display: inline;"> Yes</label>
                            <input type="radio" id="no_travel" name="book_travel" value="No">
                            <label for="no_travel" style="display: inline;"> No</label>
                          </li>
                          <li class="vfb-item vfb-item-text vfb-right-half" id="item-vfb-8">
                            <label for="vfb-8" class="vfb-desc">WILL YOU BOOK MY STAY? ? <span class="vfb-required-asterisk">*</span></label>
                            <input type="radio" id="yes_stay" name="book_stay" value="Yes">
                            <label for="yes_stay" style="display: inline;"> Yes</label>
                            <input type="radio" id="no_stay" name="book_stay" value="No">
                            <label for="no_stay" style="display: inline;"> No</label>
                          </li>
                          NOTE: THE INTERNATIONAL TOUR CHARGES ARE NOT INCLUSIVE THE STAY & TRAVEL
                        </div>
                        <script type="text/javascript">
                          $('input[type=radio][name=sponser_trip]').change(function() {
                            if (this.value == 'Yes') {
                                $("#no_sponser_div").hide();
                                $("#yes_sponser").show();
                            }
                            else if (this.value == 'No') {
                                $("#yes_sponser").hide();
                                $("#no_sponser_div").show();
                            }
                          });
                        </script>

                      </ul>
                      &nbsp;
                    </fieldset>
                    <fieldset class="vfb-fieldset vfb-fieldset-3 locations" id="item-vfb-14">
                      <div class="vfb-legend">
                        <h3>Instructions</h3>
                      </div>
                      <ul class="vfb-section vfb-section-3">
                        <!-- <li class="vfb-item vfb-item-address" id="item-vfb-15">
                          <label class="vfb-desc">Address </label>
                          <div>
                            <span class="vfb-full">
                            <input type="text" name="address" id="vfb-15-address" maxlength="150" class="vfb-text vfb-medium" />
                            <label for="vfb-15-address">Street Address</label>
                            </span>
                            <span class="vfb-left">
                            <input type="text" name="city" id="vfb-15-city" maxlength="150" class="vfb-text vfb-medium" /><label for="vfb-15-city">City</label>
                            </span>
                            <span class="vfb-right">
                            <input type="text" name="state" id="vfb-15-state" maxlength="150" class="vfb-text vfb-medium" /><label for="vfb-15-state">State / Province / Region</label>
                            </span>
                            <span class="vfb-left">
                            <input type="text" name="zip_code" id="vfb-15-zip" maxlength="150" class="vfb-text vfb-medium" /><label for="vfb-15-zip">Postal / Zip Code</label>
                            </span>
                            <span class="vfb-right">
                              <select name="country" class="vfb-select" id="vfb-15-country">
                                <option value="" selected="selected"></option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Brunei">Brunei</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo (Brazzaville)">Congo (Brazzaville)</option>
                                <option value="Congo">Congo</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Cote d\'Ivoire">Cote d\'Ivoire</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="East Timor (Timor Timur)">East Timor (Timor Timur)</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia, The">Gambia, The</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Greece">Greece</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran">Iran</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Korea, North">Korea, North</option>
                                <option value="Korea, South">Korea, South</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Laos">Laos</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libya">Libya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macedonia">Macedonia</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia">Micronesia</option>
                                <option value="Moldova">Moldova</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montenegro">Montenegro</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palestinian Territory">Palestinian Territory</option>
                                <option value="Palau">Palau</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Romania">Romania</option>
                                <option value="Russia">Russia</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                <option value="Saint Lucia">Saint Lucia</option>
                                <option value="Saint Vincent">Saint Vincent</option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Serbia">Serbia</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Slovakia">Slovakia</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syria">Syria</option>
                                <option value="Taiwan">Taiwan</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Togo">Togo</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States of America">United States of America</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Vatican City">Vatican City</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Vietnam">Vietnam</option>
                                <option value="Western Sahara">Western Sahara</option>
                                <option value="Western Samoa">Western Samoa</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                              </select>
                              <label for="vfb-15-country">Country</label>
                            </span>
                          </div>
                        </li> -->
                        <li class="vfb-item vfb-item-textarea" id="item-vfb-16">
                          <label for="vfb-16" class="vfb-desc">Special Instructions, or notes (optional) </label>
                          <div><textarea name="instructions" id="vfb-16" class="vfb-textarea vfb-medium"></textarea></div>
                        </li>
                      </ul>
                      &nbsp;
                    </fieldset>
                    <fieldset class="vfb-fieldset vfb-fieldset-2 appointment" id="item-vfb-9">
                      <div class="vfb-legend">
                        <h3>When do you want to see me? </h3>
                      </div>
                      <ul class="vfb-section vfb-section-2">
                       <!--  <li class="vfb-item vfb-item-text vfb-left-half" id="item-vfb-10">
                          <label for="vfb-10" class="vfb-desc">Model Name(s) <span class="vfb-required-asterisk">*</span></label> -->
                          <input type="hidden" name="model_name" id="vfb-11" value="<?php echo $_GET['model']; ?>" class="vfb-text vfb-medium required" readonly/>
                          <input type="hidden" name="model_id" value="<?php echo $_GET['m_id']; ?>" readonly>
                        <!-- </li> -->
                        <!-- <li class="vfb-item vfb-item-text vfb-right-half" id="item-vfb-11">
                          <label for="vfb-11" class="vfb-desc">Duration (for how long?) <span class="vfb-required-asterisk">*</span></label><input type="text" name="duration" id="vfb-11" value="" class="vfb-text vfb-medium required" />
                        </li> -->
                        <li class="vfb-item vfb-item-date vfb-left-half" id="item-vfb-12">
                          <label for="vfb-12" class="vfb-desc">Date <span class="vfb-required-asterisk">*</span></label>
                          <input type="date" name="meeting_date" id="vfb-12" value="" class="vfb-text vfb-date-picker vfb-medium required"  />
                        </li>
                        <li class="vfb-item vfb-item-time vfb-right-half" id="item-vfb-13">
                          <label class="vfb-desc">Time <span class="vfb-required-asterisk">*</span></label>
                          <span class="vfb-time">
                            <select name="meeting_time_hour" id="vfb-13-hour" class="vfb-select required">
                              <option value="01">01</option>
                              <option value="02">02</option>
                              <option value="03">03</option>
                              <option value="04">04</option>
                              <option value="05">05</option>
                              <option value="06">06</option>
                              <option value="07">07</option>
                              <option value="08">08</option>
                              <option value="09">09</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                            </select>
                            <label for="vfb-13-hour">HH</label>
                          </span>
                          <span class="vfb-time">
                            <select name="meeting_time_min" id="vfb-13-min" class="vfb-select required">
                              <option value="00">00</option>
                              <option value="05">05</option>
                              <option value="10">10</option>
                              <option value="15">15</option>
                              <option value="20">20</option>
                              <option value="25">25</option>
                              <option value="30">30</option>
                              <option value="35">35</option>
                              <option value="40">40</option>
                              <option value="45">45</option>
                              <option value="50">50</option>
                              <option value="55">55</option>
                            </select>
                            <label for="vfb-13-min">MM</label>
                          </span>
                          <span class="vfb-time">
                            <select name="ampm" id="vfb-13-ampm" class="vfb-select required">
                              <option value="AM">AM</option>
                              <option value="PM">PM</option>
                            </select>
                            <label for="vfb-13-ampm">AM/PM</label>
                          </span>
                          <div class="clear"></div>
                        </li>
                      </ul>
                      &nbsp;
                    </fieldset>
                    <input type="submit" name="submit" id="vfb-4" value="Let's Meet" class="vfb-submit " />
                    </li></ul>
                    </fieldset>
                  </form>
                </div>
              </div>
            </section>
            <footer>
            </footer>
          </article>
        </div>
      </div>
    </div>
    <?php include('../includes/footer.php'); ?>
  </body>
</html>
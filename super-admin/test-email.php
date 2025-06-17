<?php
  session_start();
  include('includes/config.php');

?>
<?php
                          $sqls = "SELECT * FROM model_extra_details Order by id DESC";
                            $resultd = mysqli_query($con, $sqls);
                            $count = 1;
                              if (mysqli_num_rows($resultd) > 0) {
                                while ($rowesdw = mysqli_fetch_assoc($resultd)){
                                	echo '<pre>';
                                		print_r($rowesdw);
                                	echo '</pre>';
                                }
                            }
                        ?>
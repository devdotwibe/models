<?php 

  session_start(); 

  include('includes/config.php');

  include('includes/helper.php');
  
  $output = array();
  
  
  $limit = 8;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

$sqls = "SELECT * FROM model_user WHERE as_a_model = 'Yes'  Order by id DESC LIMIT $limit OFFSET $offset";
$resultd = mysqli_query($con, $sqls);

                if (mysqli_num_rows($resultd) > 0) { 
				
				while($rowesdw = mysqli_fetch_assoc($resultd)) {
        $html .= '<div class="model-profile">';
        $html .= '<h4>' . htmlspecialchars($rowesdw['name']) . '</h4>';
        $html .= '<p>' . htmlspecialchars($rowesdw['bio']) . '</p>';
        $html .= '</div>';
    }
}
$output['html'] = $html;
echo json_encode($output);
?>

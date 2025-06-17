<?php 

  session_start(); 

  include('includes/config.php');

  include('includes/helper.php');
  
  $output = array();
  
  $limit = 8;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

$sqls = "SELECT * FROM model_user WHERE as_a_model = 'Yes' ORDER BY id DESC LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sqls);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="model-profile">';
        echo '<h4>' . htmlspecialchars($row['name']) . '</h4>';
        echo '<p>' . htmlspecialchars($row['bio']) . '</p>';
        echo '</div>';
    }
}

?>

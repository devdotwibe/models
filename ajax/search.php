<?php session_start();
include('../includes/config.php');
include('../includes/helper.php');



if (isset($_POST['search']) && !empty($_POST['search'])) {
    
    $search = $_POST['search'];

    $userDetails = search_user('model_user', ['name' => $search,'username'=>$search], false);

        if (!empty($userDetails)) {
            foreach ($userDetails as $user) {

            $defaultImage =SITEURL."/assets/images/girl.png";

            if($user['gender']=='Male'){
                $defaultImage =SITEURL."/assets/images/profile.jpg";
            }

            if(!empty($user['profile_pic']))
            {
                 if (checkImageExists($user['profile_pic'])) {
              
                    $defaultImage = SITEURL . $user['profile_pic'];
                 }
            }

                echo '
                <a href="'.SITEURL. urlencode($user['username']) . '" class="block p-3 hover:bg-gray-100">
                    <div class="flex items-center space-x-4">
                        <img src="'. $defaultImage . '" alt="' . htmlspecialchars($user['name']) . '" class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <div class="font-semibold text-black">' . htmlspecialchars($user['name']) . '</div>
                            <div class="text-sm text-gray-500">' . htmlspecialchars($user['username']) . '</div>
                        </div>
                    </div>
                </a>';
            }
        } else {

            echo "<div class='p-3 text-gray-500'>No results found.</div>";
        }
}

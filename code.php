<?php 


	$rootPath = $_SERVER['DOCUMENT_ROOT']; 

        $imagePath = $rootPath . '/' . ltrim('assets/images/logo-live.jpg', '/');

        $base64 = '';

        $imageData = @file_get_contents($imagePath);
        if ($imageData !== false) {
            $type = pathinfo($imagePath, PATHINFO_EXTENSION);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($imageData);
        }


        echo $base64 ;
?>
<?php 
$rootPath = $_SERVER['DOCUMENT_ROOT']; 
$imagePath = $rootPath . '/' . ltrim('assets/images/logo-live.jpg', '/');

$base64 = '';

$imageData = @file_get_contents($imagePath);
if ($imageData !== false) {
    $type = pathinfo($imagePath, PATHINFO_EXTENSION);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($imageData);
}
?>

<?php if (!empty($base64)): ?>
    <img src="<?= $base64 ?>" alt="Logo">
<?php else: ?>
    <p>Image not found.</p>
<?php endif; ?>

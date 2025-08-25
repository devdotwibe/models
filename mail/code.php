<?php
$path = __DIR__ . './assets/images/logo-live.jpg';
$base64 = '';

// Check if the image file exists
if (file_exists($path)) {
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
}
?>

<td align="right">
    <?php if ($base64): ?>
        <img src="<?php echo $base64; ?>" alt="Logo" />
    <?php else: ?>
        <!-- Fallback if image is missing -->
        <span>Logo not available</span>
    <?php endif; ?>
</td>

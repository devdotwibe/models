<?php
$imageUrl = 'https://models.staging3.dotwibe.com/assets/images/logo-live.jpg';
$base64 = '';

// Fetch image from URL
$imageData = @file_get_contents($imageUrl);
if ($imageData !== false) {
    $type = pathinfo($imageUrl, PATHINFO_EXTENSION);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($imageData);
}
?>

<td align="right">
    <?php if ($base64): ?>
        <img src="<?php echo $base64; ?>" alt="Logo" />
    <?php else: ?>
        <span>Logo not available</span>
    <?php endif; ?>
</td>

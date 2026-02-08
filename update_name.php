<?php
include("includes/config.php");

// Update site name in zap_config
$new_name = "ZapPlay";
$new_tagline = "Welcome to ZapPlay";
$new_title = "ZapPlay - Arcade HTML 5 Game Portal PHP Script";
$new_desc = "ZapPlay - Arcade HTML 5 Game Portal PHP Script";
$new_keywords = "ZapPlay Game Portal, Game Portal, Online Playing Games, HTML5 Games";

$query = "UPDATE zap_config SET 
    site_name = '$new_name', 
    profile_tagline = '$new_tagline',
    site_title = '$new_title',
    site_desc = '$new_desc',
    site_keywords = '$new_keywords'
    WHERE id = 1";

if (mysqli_query($con, $query)) {
    echo "<h1>Site name updated to ZapPlay successfully!</h1>";
    echo "<p>This script has been deleted for security. Please refresh your homepage to see the changes.</p>";
    unlink(__FILE__);
} else {
    echo "Error updating record: " . mysqli_error($con);
}
?>
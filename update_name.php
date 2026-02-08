<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("includes/config.php");

// Rename tables
$conversion_map = [
    'zon_ads' => 'zap_ads',
    'zon_category' => 'zap_category',
    'zon_comments' => 'zap_comments',
    'zon_config' => 'zap_config',
    'zon_games' => 'zap_games',
    'zon_likes' => 'zap_likes',
    'zon_pages' => 'zap_pages',
    'zon_unlikes' => 'zap_unlikes',
    'zon_users' => 'zap_users'
];

echo "<h2>Starting migration to ZapPlay...</h2>";

foreach ($conversion_map as $old => $new) {
    // Check if new table already exists
    $check_new = mysqli_query($con, "SHOW TABLES LIKE '$new'");
    if (mysqli_num_rows($check_new) > 0) {
        echo "Table $new already exists. Skipping rename.<br>";
        continue;
    }

    // Check if old table exists
    $check_old = mysqli_query($con, "SHOW TABLES LIKE '$old'");
    if (mysqli_num_rows($check_old) > 0) {
        $rename = "RENAME TABLE `$old` TO `$new`";
        if (mysqli_query($con, $rename)) {
            echo "Renamed $old to $new successfully.<br>";
        } else {
            echo "Error renaming $old: " . mysqli_error($con) . "<br>";
        }
    } else {
        echo "Old table $old not found.<br>";
    }
}

// Update config values in zap_config
$new_name = "ZapPlay";
$new_tagline = "Welcome to ZapPlay";
$new_title = "ZapPlay - Arcade HTML 5 Game Portal PHP Script";
$new_desc = "ZapPlay - Arcade HTML 5 Game Portal PHP Script";
$new_keywords = "ZapPlay Game Portal, Game Portal, Online Playing Games, HTML5 Games";
$new_logo_light = "logo.png";
$new_logo_dark = "logo-dark.png";
$new_favicon = "favicon.ico";

$query = "UPDATE zap_config SET 
    site_name = '$new_name', 
    profile_tagline = '$new_tagline',
    site_title = '$new_title',
    site_desc = '$new_desc',
    site_keywords = '$new_keywords',
    site_logo_light = '$new_logo_light',
    site_logo_dark = '$new_logo_dark',
    site_favicon = '$new_favicon'
    WHERE id = 1";

if (mysqli_query($con, $query)) {
    echo "<h3>System configuration updated to ZapPlay successfully.</h3>";
} else {
    echo "Error updating config (zap_config may not exist yet): " . mysqli_error($con) . "<br>";
}

echo "<p>Migration complete. You can now delete this file.</p>";
?>
<?php

$expression = '$img ? "PATH" : "DEFAULT"';
$root = "http://localhost/speedly_wind/multi-vendor-ecommerce/public";

$isPublicInRoot = str_contains($root, '/public');

// My previous logic:
$result_current = ($isPublicInRoot ? "storage/" : "public/storage/") . ($expression);
echo "Current logic output (string representation): $result_current\n";

// Wait! If I run this in REAL PHP:
$img = true;
$path = "REAL_PATH";
echo "Real PHP Evaluation (current): ";
echo ($isPublicInRoot ? "storage/" . ($img ? $path : "DEF") : "p/storage/" . ($img ? $path : "DEF"));
echo "\n";

echo "WAIT! It works in real PHP if parentheses are there. \n";
echo "Maybe the user'S DB already has some path issues?\n";
echo "NO, the user says the URL is .../public/uploads/...\n";
echo "THIS MEANS 'storage/' is MISSING.\n";

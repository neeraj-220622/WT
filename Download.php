<?php
$file = "uploads/" . $_GET['file'];

if (file_exists($file)) {
    header("Content-Type: " . mime_content_type($file));
    header("Content-Disposition: attachment; filename=" . basename($file));
    readfile($file);
} else {
    echo "File not found.";
}
readfile($file);

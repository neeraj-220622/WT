<?php
$file = "uploads/" . $_GET['file'];
if (file_exists($file)) {
    if (unlink($file)) {
        echo "File deleted successfully: " . $_GET['file'];
    } else {
        echo "Error deleting file: " . $_GET['file'];
    }
} else {
    echo "File does not exist: " . $_GET['file'];
}

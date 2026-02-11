<?php
//file Read/Write
$file = fopen("uploads/text.env", "r");
$content = fread($file, filesize("uploads/text.env"));
$text = file_get_contents("uploads/text.env");
echo $content . "<br>";
echo $text . "<br>";
fclose($file);

$file = fopen("uploads/text.env", "w");
fwrite($file, "This is a new content");
file_put_contents("uploads/text.env", "This is a new content");
fclose($file);

//file information
$file = "uploads/text.env";
if (file_exists($file)) {
    echo "File Name: " . basename($file) . "<br>";
    echo "File Size: " . filesize($file) . " bytes<br>";
    echo "File Type: " . mime_content_type($file) . "<br>";
    echo "Last Modified: " . date("F d Y H:i:s.", filemtime($file)) . "<br>";
    echo "Last appened time: " . date("F d Y H:i:s.", fileatime($file)) . "<br>";
    echo "Last copied time: " . date("F d Y H:i:s.", filectime($file)) . "<br>";
    echo "File permissions: " . fileperms($file) . "<br>";
    echo "File owner: " . fileowner($file) . "<br>";
    echo "File group: " . filegroup($file) . "<br>";
    echo "File in node: " . fileinode($file) . "<br>";
} else {
    echo "File does not exist.";
}

//file & Folder Management
if (file_exists("uploads/newfile.txt")) {
    if (copy('uploads/text.txt', 'uploads/newfile.txt')) {
        echo "File copied successfully." . "<br>";
    } else {
        echo "Failed to copy file." . "<br>";
    }
    if (rename('uploads/newfile.txt', 'uploads/renamedfile.txt')) {
        echo "File renamed successfully." . "<br>";
    } else {
        echo "Failed to rename file." . "<br>";
    }
    if (unlink('uploads/renamedfile.txt')) {
        echo "File deleted successfully." . "<br>";
    } else {
        echo "Failed to delete file." . "<br>";
    }
    if (mkdir('uploads/newfolder')) {
        echo "Folder created successfully." . "<br>";
    } else {
        echo "Failed to create folder.";
    }
    if (is_dir("uploads/newfolder")) {
        echo "It is a directory." . "<br>";
    } else {
        echo "It is not a directory." . "<br>";
    }
    if (rmdir('uploads/newfolder')) {
        echo "Folder deleted successfully." . "<br>";
    } else {
        echo "Failed to delete folder." . "<br>";
    }
    if (is_file("uploads/text.env")) {
        echo "It is a file" . "<br>";
    } else {
        echo "It is not a file." . "<br>";
    }
} else {
    echo "No file exists" . "<br>";
}

//Directory Handling (Parsing Directories)
$directory = "uploads";
if (is_dir($directory)) {
    $files = scandir($directory);
    print_r($files);
    if ($handle = opendir($directory)) {
        while (($file = readdir($handle)) !== false) {
            if ($file != "." && $file != "..") {
                echo "File: " . $file . "<br>";
            }
        }
        closedir($handle);
    }
    echo getcwd() . "<br>";
    chdir($directory);
    echo getcwd() . "<br>";
    chdir("c:/xampp/htdocs/WT");
} else {
    echo "Directory does not exist.";
}

//File Locking
$f = fopen("uploads/text.env", "a");
flock($f, LOCK_EX);
fwrite($f, "This is an appended content." . "\n");
fclose($f);


//File Operation modes
$file = "uploads/text.env";
if (file_exists($file)) {
    $f = fopen($file, "r");
    echo fread($f, filesize($file)) . "<br>";
    fclose($f);

    $f = fopen($file, "w");
    fwrite($f, "This is a new content." . "\n");
    fclose($f);

    $f = fopen($file, "a");
    fwrite($f, "This is an appended content." . "\n");
    fclose($f);

    $f = fopen($file, "x");
    if ($f) {
        fwrite($f, "This is a new file created with x mode." . "\n");
        fclose($f);
    } else {
        echo "File already exists. Cannot create with x mode." . "<br>";
    }

    $f = fopen($file, "r+");
    echo fread($f, filesize($file)) . "<br>";
    fwrite($f, "This is a new content written with r+ mode." . "\n");
    fclose($f);

    $f = fopen($file, "w+");
    fwrite($f, "This is a new content written with w+ mode." . "\n");
    rewind($f);
    echo fread($f, filesize($file)) . "<br>";
    fclose($f);

    $f = fopen($file, "a+");
    fwrite($f, "This is an appended content written with a+ mode." . "\n");
    rewind($f);
    echo fread($f, filesize($file)) . "<br>";
    fclose($f);
}

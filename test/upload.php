<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process file upload here

    // Example: print some data
  
    // Redirect to the HTML file in the super directory after processing the upload
    $uploadedFileName = $_FILES['file']['name'];
    echo "File uploaded: $uploadedFileName<br>";
    redirect('../test/upload.html');
    // header('Location: ../test/upload.html');
    exit();
}
function redirect($url) {
    header('Location: '.$url,true,302);
    die();
}
// hjjjdojf dkjfkjdkjfkd

?>

<?php

if (isset($_POST['generate'])) {
    // Include the QRcode library
    include('D:\xampp\htdocs\LibMSv1\resources\phpqrcode-master\phpqrcode-master\qrlib.php');

    // Get user input data
    $idNo = $_POST['idNo'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $data = "ID Number: $idNo\nUsername: $username\nName: $name";

    // Generate the QR code
    $tempDir = '/LibMSv1/users/admin/qrbin/qrcode.png'; // Change this to a writable temp directory
    $tempFile = $tempDir . uniqid() . '.png';

    QRcode::png($data, $tempFile, QR_ECLEVEL_L, 10);

    // Set headers to force download the QR code
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="generated_qr.png"');
    readfile($tempFile);

    // Clean up temporary file
    unlink($tempFile);
    exit;
}


/*
if (isset($_POST['generate'])) {
    // Include the QRcode library
    include('D:\xampp\htdocs\LibMSv1\resources\phpqrcode-master\phpqrcode-master\qrlib.php');

    // Get user input data
    $idNo = $_POST['idNo'];
    $username = $_POST['username'];
    $data = "ID Number: $idNo\nUsername: $username";

    // Generate the QR code
    $tempDir = '/LibMSv1/users/admin/qrbin/qrcode.png'; // Change this to a writable temp directory
    $tempFile = $tempDir . uniqid() . '.png';

    QRcode::png($data, $tempFile, QR_ECLEVEL_L, 10);

    // Set headers to force download the QR code
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="generated_qr.png"');
    readfile($tempFile);

    // Clean up temporary file
    unlink($tempFile);
    exit;
}
*/

/*



if (isset($_POST['generate'])) {
    // Include the QRcode library
    include('D:\xampp\htdocs\LibMSv1\resources\phpqrcode-master\phpqrcode-master\qrlib.php');

    // Get user input data
    $idNo = $_POST['idNo'];
    $username = $_POST['username'];
    $data = "ID Number: $idNo\nUsername: $username";

    // Generate the QR code
    $tempDir = '/LibMSv1/users/admin/qrbin/qrcode.png'; // Change this to a writable temp directory
    $tempFile = $tempDir . uniqid() . '.png';

    QRcode::png($data, $tempFile, QR_ECLEVEL_L, 10);

    // Set headers to force download the QR code
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="generated_qr.png"');
    readfile($tempFile);

    // Clean up temporary file
    unlink($tempFile);
    exit;
}


    if (isset($_POST['generate'])) {
        require_once('D:/xampp/htdocs/LibMSv1/resources/phpqrcode-master/phpqrcode-master/qrlib.php');

        $username = $_POST['username'];
        $id = $_POST['idNo'];

        // Generate a unique filename for the QR code
        $filename = uniqid().'.png';

        // Generate the QR code
        QRcode::png("Username: $username\nID: $id", $filename);

        // Display the QR code on the webpage
        echo '<div id="qrcode">';
        echo '<h3>Generated QR Code:</h3>';
        echo '<img src="'.$filename.'" alt="QR Code">';
        echo '</div>';

        // Remove the generated QR code file
        unlink($filename);
    }
*/
?>
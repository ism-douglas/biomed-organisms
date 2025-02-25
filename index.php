<?php 
//Echo response back to the API
header('Content-type: text/plain');

//Read POST variables from the API
$sessionId = $_POST['sessionId'];
$networkCode = $_POST['networkCode'];
$serviceCode = $_POST['serviceCode'];
$phoneNumber = ltrim($_POST['phoneNumber']);

$text = $_POST['text'] ?? '';

// Check if the user has entered the code
if ($text == '') {
    // Initial prompt asking the user to enter the code
    $response = "CON Please enter the code:";
} elseif ($text == '0004712') {
    // Valid code entered
    $response = "END Klebsiella pneumoniae ssp rhinoscleromatis\n97.7% GOOD IDENTIFICATION";
} elseif ($text == '0005023') {
    // Valid code entered
    $response = "END Pantoea spp 1\n98.0% GOOD IDENTIFICATION";
} else {
    // Invalid code entered
    $response = "CON Invalid input. Please enter the code again:";
}

echo $response;

; ?>
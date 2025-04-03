<?php

// Echo response back to the API
header('Content-type: text/plain');

// Read POST variables from the API
$sessionId = $_POST['sessionId'];
$networkCode = $_POST['networkCode'];
$serviceCode = $_POST['serviceCode'];
$phoneNumber = ltrim($_POST['phoneNumber']);
$text = $_POST['text'] ?? '';

// Split user input into an array
$textArray = explode('*', $text);
$userResponse = trim(end($textArray));

// USSD logic
if ($text == "") {
    // Session 1: Ask for hospital ID
    $response = "CON Welcome to the WSU GH Kenya AMR Hub\n";
    $response .= "1. Please enter your Hospital ID.";
} elseif (count($textArray) == 1) {
    // Session 2: Ask for bacteria type
    $response = "CON Kindly select bacteria type to identify:\n";
    $response .= "1. Gram Negative\n";
    $response .= "2. Gram Positive";
} elseif (count($textArray) == 2) {
    // Session 3: Ask for code
    $response = "CON Please enter the code.";
} elseif (count($textArray) == 3) {
    // Check user input for code    
    if ($userResponse == "0004712") {
        $response = "END Klebsiella pneumoniae ssp rhinoscleromatis\n97.7% GOOD IDENTIFICATION";
    } elseif ($userResponse == "0005023") {
        $response = "END Pantoea spp 1\n98.0% GOOD IDENTIFICATION";
    } else {
        $response = "CON Invalid code. Please try again.";
    }
} else {
    // Final response
    $response = "END Thank you for your input.";
}

// Echo response
echo $response;

?>



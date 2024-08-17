<?php
require_once __DIR__ . '/../model/CommunicationRepo.php';

// Fetch the message from the database
$message = findOneWayMessageByID(1);

if ($message === null) {
    $message = "Hi! How are you?";
}

// Morse Code Mapping
$morseCodeMap = [
    // Uppercase Letters
    'A' => '.-',    'B' => '-...',  'C' => '-.-.',  'D' => '-..',   'E' => '.',
    'F' => '..-.',  'G' => '--.',   'H' => '....',  'I' => '..',    'J' => '.---',
    'K' => '-.-',   'L' => '.-..',  'M' => '--',    'N' => '-.',    'O' => '---',
    'P' => '.--.',  'Q' => '--.-',  'R' => '.-.',   'S' => '...',   'T' => '-',
    'U' => '..-',   'V' => '...-',  'W' => '.--',   'X' => '-..-',  'Y' => '-.--',
    'Z' => '--..',

    // Lowercase Letters (same as uppercase)
    'a' => '.-',    'b' => '-...',  'c' => '-.-.',  'd' => '-..',   'e' => '.',
    'f' => '..-.',  'g' => '--.',   'h' => '....',  'i' => '..',    'j' => '.---',
    'k' => '-.-',   'l' => '.-..',  'm' => '--',    'n' => '-.',    'o' => '---',
    'p' => '.--.',  'q' => '--.-',  'r' => '.-.',   's' => '...',   't' => '-',
    'u' => '..-',   'v' => '...-',  'w' => '.--',   'x' => '-..-',  'y' => '-.--',
    'z' => '--..',

    // Numbers
    '1' => '.----', '2' => '..---', '3' => '...--', '4' => '....-', '5' => '.....',
    '6' => '-....', '7' => '--...', '8' => '---..', '9' => '----.', '0' => '-----',

    // Special Characters
    '.' => '.-.-.-', ',' => '--..--', ':' => '---...', '?' => '..--..', '\'' => '.----.',
    '-' => '-....-', '/' => '-..-.',  '(' => '-.--.',  ')' => '-.--.-', '"' => '.-..-.',
    '=' => '-...-',  '+' => '.-.-.',  '@' => '.--.-.', '!' => '-.-.--', '&' => '.-...',
    ';' => '-.-.-.', '_' => '..--.-', '$' => '...-..-', ' ' => '/'
];

// Convert the text to Morse code
function convertTextToMorse($text, $morseCodeMap) {
    $morseCode = '';
    $text = strtoupper($text);
    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        if (isset($morseCodeMap[$char])) {
            $morseCode .= $morseCodeMap[$char] . ' ';
        }
    }
    return trim($morseCode);
}

$morseCode = convertTextToMorse($message, $morseCodeMap);

// Send the Morse code as a JSON response
header('Content-Type: application/json');
echo json_encode(['morseCode' => $morseCode]);


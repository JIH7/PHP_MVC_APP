<?php
$env = file_get_contents("../.env");

// Split the file into lines
$lines = explode("\n", $env);

foreach($lines as $line) {
    // Trim the line to (remove extra spaces and ignore comments or empty lines
    $line = trim($line);
    if (empty($line) || $line[0] === '#') {
        continue;  // Skip empty lines and comments
    }

    // Use regex to extract the key-value pairs
    if (preg_match("/^([A-Za-z0-9_]+)=(.*)$/", $line, $matches)) {
        $key = trim($matches[1]);  // Environment variable name
        $value = trim($matches[2]); // Environment variable value

        // Set the environment variable
        putenv("$key=$value");
        $_ENV[$key]=$value;
    }
}
?>
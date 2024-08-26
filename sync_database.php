<?php

// Define the command
$command = 'php artisan sync:database';

// Change the directory to where the Laravel application is located
chdir('/vzzkpavvbn/public_html/');

// Execute the command
exec($command, $output, $returnVar);

// Check the result and output
if ($returnVar === 0) {
    echo "Command executed successfully\n";
} else {
    echo "Command failed with status $returnVar\n";
}

// Log the output to a file for debugging
file_put_contents('/vzzkpavvbn/public_html/sync_database.log', implode("\n", $output), FILE_APPEND);

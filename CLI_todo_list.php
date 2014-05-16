<?php

// Create array to hold list of todo items
$items = array(''); 
unset($items[0]);

function list_items($list)
{
    $result = '';
    foreach ($list as $key => $item) {       
        $result .= "[" . $key . "]" . $item . PHP_EOL;
    } 
    return $result;   
}

// Get STDIN, strip whitespace and newlines, 
// and convert to uppercase if $upper is true
function get_input($upper = FALSE) 
{   $result = trim(fgets(STDIN));
    return $upper ? strtoupper($result) : $result;
}

// The loop!
do {

    // // Iterate through list items
    echo list_items($items);

    // Show the menu options
    echo '(N)ew item, (R)emove item, (Q)uit : ';

    // Get the input from user
    // Use trim() to remove whitespace and newlines
    $input = get_input(true);

    // Check for actionable input
    if ($input == 'N') {
        // Ask for entry
        echo 'Enter item: ';
        // Add entry to list array
        $items[] = get_input();
    } elseif ($input == 'R') {
        // Remove which item?
        echo 'Enter item number to remove: ';
        // Get array key
        $key = get_input();
        // Remove from array
        unset($items[$key]);
        array_unshift($items, "");
        unset($items[0]);
    }
    
// Exit when input is (Q)uit
} while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);
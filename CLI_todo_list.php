<?php

// Create array to hold list of todo items
$items = array(); 
//array_unshift($items, '');
//unset($items[0]);

function list_items($list)
{
    $result = '';
    foreach ($list as $key => $item) {       
        $result .= "[" . ($key + 1) . "] " . $item . PHP_EOL;
    } 
    return $result;   
}
// Get STDIN, strip whitespace and newlines, 
// and convert to uppercase if $upper is true
function get_input($upper = FALSE) 
{   $result = trim(fgets(STDIN));
    return $upper ? strtoupper($result) : $result;
}

function sort_menu($items) {
    echo 'Sort (A)-Z, (Z)-A, (O)rder entered, (R)everse order entered: ';

    $sorting = get_input(true);
    //$sorting = strtoupper(trim(fgets(STDIN)));

    if ($sorting == 'A'){
           sort($items);
        } else if ($sorting == 'Z') {
            rsort($items);
        } else if ($sorting == 'O'){
            ksort($items);
        } else if ($sorting == 'R') {
            krsort($items);
        }
    return $items;  
}

// The loop!
do {

    // // Iterate through list items
    echo list_items($items);

    // Show the menu options
    echo '(N)ew item, (R)emove item, (Q)uit, (S)ort : ';

    // Get the input from user
    // Use trim() to remove whitespace and newlines
    $input = get_input(true);

    // Check for actionable input
    if ($input == 'N') {
        // Ask for entry
        echo 'Enter item: ';
        // Add entry to list array
        $items[] = get_input();
    } else if ($input == 'R') {
        // Remove which item?
        echo 'Enter item number to remove: ';
        // Get array key
        $key = get_input();
        // Remove from array
        unset($items[$key - 1]);
        $items = array_value($items);
        //array_unshift($items, "");
        //unset($items[0]);
    } else if($input == 'S') {
        
        //$sorting = get_input(true);

        $items = sort_menu($items);

    
    }
    
// Exit when input is (Q)uit
} while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);
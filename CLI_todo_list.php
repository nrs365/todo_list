<?php

// Create array to hold list of todo items
$items = array(); 
//array_unshift($items, '');
//unset($items[0]);

function list_items($list)
{
    $result = '';
    foreach ($list as $key => $item) {       
        $result .= '[' . ($key + 1) . '] ' . $item . PHP_EOL;
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

    if ($sorting == 'A'){
            natcasesort($items);
        } else if ($sorting == 'Z') {
            arsort($items, SORT_NATURAL | SORT_FLAG_CASE);
        } else if ($sorting == 'O'){
            ksort($items);
        } else if ($sorting == 'R') {
            krsort($items);
        }
    return $items;  
}

function open_file($filename, $array) {
    $filesize = filesize($filename);
    $read = fopen($filename, 'r');
    $listString = trim(fread($read, $filesize));
    $listArray = explode("\n", $listString);
    $array = array_merge($listArray, $array);
    fclose($read);
    return $array;        
}

function save_file($filename, $array) {
    $saved_file = fopen($filename, 'a');
    $listString = implode("\n", $array);
    fwrite($saved_file, $listString . "\n");
    fclose($saved_file);
    //return "Thanks for saving to {$filename}!\n";
}
// The loop!
do {

    // // Iterate through list items
    echo list_items($items);

    // Show the menu options
    echo '(O)pen file, (N)ew item, (R)emove item, (S)ort, S(a)ve, or (Q)uit : ';

    // Get the input from user
    // Use trim() to remove whitespace and newlines
    $input = get_input(true);

    // Check for actionable input
    if ($input == 'O') {
        echo 'Please enter the file name and location you would like loaded: ';
        $filename = get_input();
        $items = open_file($filename, $items);
       
    }
    else if ($input == 'N') {
        // Ask for entry
        // Add entry to list array
        // $items[] = get_input(); // equal to array push, replace with array push or array unshift; 
        echo 'Would you like this item added at the (b)eginning of the list or (e)nd of the list?';
        
        $add_location = get_input(true);
        
        echo 'Enter item: ';
        $new_item = get_input();

        if ($add_location == 'B') {
            array_unshift($items, $new_item);
        
        } else if ($add_location == 'E') {
            array_push($items, $new_item);
        
        } else {
             array_push($items, $new_item);
        }

    }

    else if ($input == 'R') {
        // Remove which item?
        echo 'Enter item number to remove: ';
        // Get array key
        $key = get_input();
        // Remove from array
        unset($items[$key - 1]);
        //$items = array_value($items);  have to get rid of this b/c it resorts the keys
        //array_unshift($items, "");
        //unset($items[0]);
    } else if ($input == 'S') {
        $items = sort_menu($items);
    } else if ($input == 'A'){
       echo 'Please enter the file name and location you would like to save to:';
       $filename = get_input();
            if (is_writeable($filename)) {
                echo "This file already exists.  Would you still like to save to this file? Y/N: \n";
                $save_option = get_input(true);
                if ($save_option == 'Y') {
                    save_file($filename, $items);
                    echo "Thanks for saving to {$filename}\n";
                }
            }    
    } else if ($input == 'F'){
        array_shift($items);
    } else if ($input == 'L'){
        array_pop($items);
    }
    
// Exit when input is (Q)uit
} while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);
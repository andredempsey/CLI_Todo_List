<?php

//This is the exercise for 
//Building a Todo List
//Date:  19 May 14
//Name:  Andre Dempsey
//Codeup Baddies

// Add a (S)ort option to your menu. When it is chosen, it should call a function called sort_menu().

//add functions and refactor
function list_items($list)
{
    // Return string of list items separated by newlines.
    // Should be listed [KEY] Value like this:
    // [1] TODO item 1
    // [2] TODO item 2 - blah
    // DO NOT USE ECHO, USE RETURN
    // Iterate through list items
    // Display each item and a newline
    $list_output='';
    foreach ($list as $key => $listitem) 
    {
        $list_output = $list_output . "[".($key+1)."]" ." {$listitem}\n";
    }
    return $list_output;
}

function get_input($upper = FALSE) 
// Get STDIN, strip whitespace and newlines, 
// and convert to uppercase if $upper is true
{
    // Return filtered STDIN input
    if ($upper) 
    {
        return strtoupper(trim(fgets(STDIN)));
    }
    else
    {
        return (trim(fgets(STDIN)));
    }
}


function sort_menu($items)
{
    echo "\n(A)-Z, (Z)-A, (O)rder entered, (R)everse order entered : ";
    $sort_input=strtoupper(trim(fgets(STDIN)));
    switch ($sort_input) 
    {
        case 'A':
            asort($items);
            return $items;
            break;
        case 'Z':
            arsort($items);
            return $items;
            break;
        case 'O':
            ksort($items);
            return $items;
            break;
        case 'R':
            krsort($items);
            return $items;
            break;
        default:
            return $items;
            break;
    }

}

// Create array to hold list of todo items
$items = array();
$orig_items=array();
// The loop!
do 
{
    //display list
    echo list_items($items);

    // Show the menu options
    if (empty($items)) 
    {
        echo '(N)ew item, (Q)uit : ';
    }
    else
    {
        echo '(N)ew item, (R)emove item, (S)ort, (Q)uit : ';
    }   

    // Get the input from user
    // Use trim() to remove whitespace and newlines
    $input = get_input(TRUE);

    // Check for actionable input
    if ($input == 'N') 
    {
        // Ask for entry
        echo 'Enter item: ';
        // Add entry to list arra
        $items[] = get_input();
    } 
    elseif ($input == 'R') 
    {
        // Remove which item?
        echo 'Enter item number to remove: ';
        // Get array key
        $key = get_input();
        // Remove from array
        unset($items[($key-1)]);
        $items=array_values($items);
        $orig_items = $items;
    }
    elseif ($input=='S') 
    {
        $items=sort_menu($items);
    }
// Exit when input is (Q)uit
} 
while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);
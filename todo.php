<?php

//This is the exercise for 
//Building a Todo List
//Date:  14 May 14
//Name:  Andre Dempsey
//Codeup Baddies

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
// Create array to hold list of todo items
$items = array();

// The loop!
do 
{
    //display list
    echo list_items($items);

    // Show the menu options
    echo '(N)ew item, (R)emove item, (Q)uit : ';

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
    }
// Exit when input is (Q)uit
} 
while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);
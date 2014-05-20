<?php

//This is the exercise for 
//Building a Todo List
//Date:  20 May 14
//Name:  Andre Dempsey
//Codeup Baddies

// 1.  Add a file menu option to the main menu in your TODO list app. In this file menu create a (O)pen file option. 
// The user should be able to enter the path to a file to have it loaded.
// 2.  Create a function that reads the file, and adds each line to the current TODO list. 
// Loading data/list.txt should properly load the list. Be sure to fclose() the file when you are done reading it.

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
    $sort_input=get_input(TRUE);
    switch ($sort_input) 
    {
        case 'A':
            asort($items, SORT_NATURAL|SORT_FLAG_CASE);
            break;
        case 'Z':
            arsort($items, SORT_NATURAL|SORT_FLAG_CASE);
            break;
        case 'O':
            ksort($items, SORT_NATURAL|SORT_FLAG_CASE);
            break;
        case 'R':
            krsort($items, SORT_NATURAL|SORT_FLAG_CASE);
            break;
    }
    return $items;
}

function readlist($filepathname, $target_array)
{
    $read_handle = fopen($filepathname, "r");
    $listitems = fread($read_handle, filesize($filepathname));
    $listitems_array = explode("\n", $listitems);
    foreach ($listitems_array as $item) 
    {
        array_push($target_array, $item);
    }
    fclose($read_handle);
    return $target_array;
}

// Create array to hold list of todo items
$items = array();
// The loop!
do 
{
    //display list
    echo list_items($items);

    // Show the menu options
    if (empty($items)) 
    {
        echo '(N)ew item, (O)pen file, (Q)uit : ';
    }
    else
    {
        echo '(N)ew item, (R)emove item, (S)ort, (Q)uit : ';
    }   

    // Get the input from user
    // Use trim() to remove whitespace and newlines
    $input = get_input(TRUE);
    switch ($input) 
    {
        case 'N':
            // Ask for entry
            echo "Would you like to add the item to the (B)eginning or (E)nd of the list?";
            switch (get_input(TRUE)) 
            {
                case 'B':
                    echo 'Enter item to add to the beginning: ';
                    array_unshift($items, get_input());
                    break;
                default:
                    echo 'Enter item to add to the end: ';
                    // Add entry to list array
                    array_push($items, get_input());
                    break;
            }
            break;        
        case 'R': //remove item from list
            // Remove which item?
            echo 'Enter item number to remove: ';
            // Get array key
            $key = get_input();
            // Remove from array
            unset($items[($key-1)]);
            // $items=array_values($items);
            $key++;
            break;        
        case 'S': //sort list
            $items=sort_menu($items);
            break;        
        case 'F':  //power user remove item to beginning of list
            array_shift($items);
            break;
        case 'L': //power user remove item to end of list
            array_pop($items);
            break;
        case 'O': //load list from file
            //current menu configuration only allows loading from file if array is empty
            echo "Source file: ";   
            $filepath = get_input(false);
            echo "To do items to be loaded from $filepath\n";
            $items= readlist($filepath,$items);
            break;
        default: // Exit when input is (Q)uit
            break;
    }
} 
while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);
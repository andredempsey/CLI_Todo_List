<?php

//This is the exercise for 
//Building a Todo List
//Date:  19 May 14
//Name:  Andre Dempsey
//Codeup Baddies

// Add a (S)ort option to your menu. When it is chosen, it should call a function called sort_menu().
// When sort menu is opened, show the following options "(A)-Z, (Z)-A, (O)rder entered, (R)everse order entered".
// When a sort type is selected, order the TODO list accordingly and display the results.
// When a new item is added to a TODO list, ask the user if they want to add it to the beginning or end of the list. Default to end if no input is given.
// Allow a user to enter F at the main menu to remove the first item on the list. This feature will not be added to the menu, 
// and will be a special feature that is only available to "power users". Also add a L option that grabs and removes the last item in the list.

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
            asort($items);
            break;
        case 'Z':
            arsort($items);
            break;
        case 'O':
            ksort($items);
            break;
        case 'R':
            krsort($items);
            break;
    }
    return $items;

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
    } 
    elseif ($input == 'R') 
    {
        // Remove which item?
        echo 'Enter item number to remove: ';
        // Get array key
        $key = get_input();
        // Remove from array
        unset($items[($key-1)]);
        // $items=array_values($items);
        $key++;
    }
    elseif ($input=='S') 
    {
        $items=sort_menu($items);
    }
    elseif ($input=='F') 
    {
        array_shift($items);
    }
    elseif ($input=='L') 
    {
        array_pop($items);
    }
// Exit when input is (Q)uit
} 
while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);
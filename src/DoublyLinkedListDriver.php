<?php
/**
 * this is the main driver used to construct a doubly linked list and test each of the methods 
 */
require_once('lib\LinkedList\ListNode.php');
require_once('lib\LinkedList\DoublyLinkedList.php');

use LinkedList\ListNode;
use LinkedList\DoublyLinkedList;

// create a new linked list
$theList = new DoublyLinkedList();

// show the current list count
echo $theList->printList() . "\r\n";

// check the validity of the traversal methods
echo "Checking validity before populating list\r\n";
echo "\tfirst: " . $theList->valid('first') . "\r\n";
echo "\tlast: " . $theList->valid('last') . "\r\n";
echo "\tnext: " . $theList->valid('next') . "\r\n";
echo "\tprevious: " . $theList->valid('previous') . "\r\n";
echo "\tcurrent: " . $theList->valid('current') . "\r\n";

// add some data to the list
echo "Adding some data\r\n";
$theList->add(9);
echo $theList->printList() . "\r\n";
$theList->add(3);
echo $theList->printList() . "\r\n";
$theList->add(2);
echo $theList->printList() . "\r\n";
$theList->add(7);
echo $theList->printList() . "\r\n";
$theList->add(8);
echo $theList->printList() . "\r\n";
$theList->add(5);
echo $theList->printList() . "\r\n";
$theList->add(4);
echo $theList->printList() . "\r\n";
$theList->add(6);
echo $theList->printList() . "\r\n";
$theList->add(10);
echo $theList->printList() . "\r\n";
$theList->add(1);
echo $theList->printList() . "\r\n";
$theList->add(4);
echo $theList->printList() . "\r\n";

// get the count
echo "List Size:  " . $theList->count() . "\r\n";

echo "\r\n";
echo "#############################################################################\r\n";
echo "Testing the call to current before it has been set (Expecting the exception):\r\n";
echo "#############################################################################\r\n";
try {
	$theList->current();
} catch (Exception $e) {
	echo $e->getMessage() . "\r\n";
	echo "\r\n";
}

// check that next sets the current
echo "#############################################################################\r\n";
echo "Testing the call to previous at head position(Expecting the exception):\r\n";
echo "#############################################################################\r\n";
$theList->next();
echo "Current Data:  " . $theList->current() . "\r\n";
try {
	$theList->previous();
} catch (Exception $e) {
	echo $e->getMessage() . "\r\n";
	echo "\r\n";
}

// check that next sets the current
echo "#############################################################################\r\n";
echo "Testing the call to next at tail position(Expecting the exception):\r\n";
echo "#############################################################################\r\n";
$theList->last();
echo "Current Data:  " . $theList->current() . "\r\n";
try {
	$theList->next();
} catch (Exception $e) {
	echo $e->getMessage() . "\r\n";
	echo "\r\n";
}

// get the head
echo "Head:  " . $theList->first() . "\r\n";

// get the tail
echo "Tail:  " . $theList->last() . "\r\n";

// traverse the list forward
$theList->first();
$theList->next();
$theList->next();
$theList->next();
$theList->next();
$theList->next();
$theList->next();
echo "Current Data (starting at head, after 6 next calls):  " . $theList->current() . "\r\n";

$theList->previous();
echo "Current Data (after previous call):  " . $theList->current() . "\r\n";

// check the validity of the traversal methods
echo "Checking validity before populating list\r\n";
echo "\tfirst: " . $theList->valid('first') . "\r\n";
echo "\tlast: " . $theList->valid('last') . "\r\n";
echo "\tnext: " . $theList->valid('next') . "\r\n";
echo "\tprevious: " . $theList->valid('previous') . "\r\n";
echo "\tcurrent: " . $theList->valid('current') . "\r\n";

// reverse the list traversal
$theList->reverse();

// get the head
echo "Head (reversed):  " . $theList->first() . "\r\n";

// get the tail
echo "Tail (reversed):  " . $theList->last() . "\r\n";

// test the previous position after calling the tail method
$theList->previous();
echo "Current Data:  " . $theList->current() . "\r\n";

// test the next position
$theList->next();
echo "Current Data:  " . $theList->current() . "\r\n";

// reverse the list traversal (back to original)
$theList->reverse();

// get the head
echo "Head (back to original):  " . $theList->first() . "\r\n";

// get the tail
echo "Tail (back to original):  " . $theList->last() . "\r\n";

// reverse the list
$theList->reverseList();
echo $theList->printList() . "\r\n";

// check new head and tail
echo "Head (reversed list):  " . $theList->first() . "\r\n";
echo "Tail (reversed list):  " . $theList->last() . "\r\n";

// check add
$theList->add(6);
echo $theList->printList() . "\r\n";

$theList->add(0);
echo $theList->printList() . "\r\n";

$theList->add(15);
echo $theList->printList() . "\r\n";

// get the count
echo "List Size:  " . $theList->count() . "\r\n";

// check traverse
$theList->first();
echo "Current Data (at head):  " . $theList->current() . "\r\n";

$theList->next();
echo "Current Data (after next):  " . $theList->current() . "\r\n";

$theList->previous();
echo "Current Data (after previous):  " . $theList->current() . "\r\n";


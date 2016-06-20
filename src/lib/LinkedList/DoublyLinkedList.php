<?php
/**
 * @purp:   This class represents a doubly linked list object and methods to act on it 
 */
namespace LinkedList;

require_once('ListNode.php');

use Exception;

class DoublyLinkedList
{
    private $head;
    private $tail;
    private $current;
    private $listSize;
    private $listTraversalDirection;
    private $listSortedAscending;

    public function __construct()
    {
        // points to the first node in the list
        $this->head = null;

        // points to the last node in the list
        $this->tail = null;

        // points to the current node position
        $this->current = null;

        // keeps track of the list size
        $this->listSize = 0;

        // set which direction we are traversing the list; true means forward
        $this->listTraversalDirection = true;

        // set the list to sort ascending
        $this->listSortedAscending = true;
    }

    /**
     * adds a new node/element to the linked list
     *
     * @param      int  $data   the data we want to add to the list
     */
    public function add($data)
    {
        // track that the add was successful or not
        $nodeAdded = false;

        // create the newNode
        $newNode = new ListNode($data);

        // if this is the first time we are adding to the list, set the head and tail node to this node
        if ($this->head === null) {
            $this->head = $newNode;
            $this->tail = $newNode;
            $nodeAdded = true;
        } else {
            // start at the head of the list
            $currentNode = $this->head;
            $canInsertNode = false;
            while ($currentNode != null) {
                // if the list is in ascending order, then check if the new node is less than or equal to the current node
                // this is done to cover the requirement that reverses the list
                if ($this->listSortedAscending) {
                    if ($newNode->data <= $currentNode->data) { 
                        $canInsertNode = true;
                    }
                } else {
                    // list is sorted descending so check if the new node is greater than or equal to the current node
                    if ($newNode->data >= $currentNode->data) { 
                        $canInsertNode = true;
                    }
                }
                // if the node can be inserted into the list based on the correct comparison, then add it
                if ($canInsertNode) {
                    $newNode->next = $currentNode;
                    // check to see if currentNode is the head of the list and if so reset the head to this node
                    if ($currentNode->previous === null) {
                        $this->head = $newNode;
                    } else {
                        // if this is not the head, then set the new nodes previous pointer to the current node's previous
                        $newNode->previous = $currentNode->previous;
                        $previousNode = $currentNode->previous;
                        $previousNode->next = $newNode;
                    }
                    $currentNode->previous = $newNode;

                    $nodeAdded = true;

                    // jump out of the loop
                    break;
                } else {
                    $currentNode = $currentNode->next;
                }
            }

            // if the node was not inserted, then we hit the end of the list and need to insert it there
            if (!$nodeAdded) {
                $newNode->previous = $this->tail;
                $tempNode = $this->tail;
                $tempNode->next = $newNode;

                // set the tail node to this new node
                $this->tail = $newNode;
                $nodeAdded = true;
            }
        }

        // if the add worked, increment the list size
        if ($nodeAdded) {
            $this->listSize++;
        }
    }

    /**
     * returns the current number of list elements
     *
     * @return     integer  the number of list elements
     * 
     * @note:  opted for using data tracked with the list over implementing a loop to get the count
     */
    public function count()
    {
        return $this->listSize;
    }

    /**
     * sets the current node to the first node position (per the traversal requirement)
     * and returns the data in the first node
     * 
     * @return     integer  the data of the first node
     */
    public function first()
    {
        // check to see if the list is empty or not
        if ($this->listSize == 0) {
            throw new Exception("List is empty.");
        }

        // check which direction we are traversing the list and set the current node
        if ($this->listTraversalDirection) {
            $this->current = $this->head;
        } else {
            $this->current = $this->tail;
        }

        // return the data from the first node
        return $this->current->data;
    }

    /**
     * sets the current node to the last node position (per the traversal requirement)
     * and returns the data in the last node
     * 
     * @return     integer  the data of the last node
     */
    public function last()
    {
        // check to see if the list is empty or not
        if ($this->listSize == 0) {
            throw new Exception("List is empty.");
        }

        // check which direction we are traversing the list
        if ($this->listTraversalDirection) {
            $this->current = $this->tail;
        } else {
            $this->current = $this->head;
        }

        // return the data from the first node
        return $this->current->data;
    }

    /**
     * retuns the data at the current node position
     *
     * @return     integer  the data of the current node
     */
    public function current()
    {
        // check to see if the list is empty or not
        if ($this->listSize == 0) {
            throw new Exception("List is empty.");
        }

        // check that the a current node has been set
        if (!$this->valid('current')) {
            throw new Exception("Current node has not been set. Must call next, previous, first or last method before calling current.");
        }

        // return the current node data
        return $this->current->data;
    }

    /**
     * sets the current node to the next node
     */
    public function next()
    {
        // check if the list is empty or not
        if ($this->listSize == 0) {
            throw new Exception("List is empty.");
        }

        // check which direction we are traversing the list
        if ($this->listTraversalDirection) {
            // check to see if current is set and if not, point it at the head
            if ($this->current === null) {
                $this->current = $this->head;
            } else {
                if ($this->current->next === null) {
                    throw new Exception("Exceeded list bound");
                } else {
                    $this->current = $this->current->next;
                }
            }
        } else {
            //check to see if the current is set and if not, point it at the tail
            if ($this->current === null) {
                $this->current = $this->tail;
            } else {
                if ($this->current->previous === null) {
                    throw new Exception("Exceeded list bound");
                } else {
                    $this->current = $this->current->previous;
                }
            }
        }

        return $this->current->data;
    }

    /**
     * sets the current node to the previous node
     */
    public function previous()
    {
        // check if the list is empty or not
        if ($this->listSize == 0) {
            throw new Exception("List is empty.");
        }

        // check which direction we are traversing the list
        if ($this->listTraversalDirection) {
            if ($this->current->previous === null) {
                throw new Exception("Exceeded list bound");
            } else {
                $this->current = $this->current->previous;
            }
        } else {
            if ($this->current->next === null) {
                throw new Exception("Exceeded list bound");
            } else {
                $this->current = $this->current->next;
            }
        }

        return $this->current->data;
    }

    /**
     * checks if the function name to call will return valid data or not
     *
     * @param      string   $functionName  the function being checked for valid data
     *
     * @return     boolean  identifies whether the function call would return valid data or not
     * 
     * @note:  the requirement on this was a little confusing. Not certain if we are checking just the "current" method or if
     *         the intention is to check if any of the provided traversal methods (first, last, next, previous) would return
     *         data or not. The latter made the most sense so that's what I went with
     */
    public function valid($functionName)
    {
        $returnValue = true;

        switch ($functionName) {
            case 'first':
                if (($this->head === null) || ($this->head->data === null)) {
                    $returnValue = false;
                }
                break;

            case 'last':
                if (($this->tail === null) || ($this->tail->data === null)) {
                    $returnValue = false;
                }
                break;

            case 'next':
                if (($this->current === null) || ($this->current->next === null) || ($this->current->next->data === null)) {
                    $returnValue = false;
                }
                break;

            case 'previous':
                if (($this->current === null) ||($this->current->previous === null) || ($this->current->previous->data === null)) {
                    $returnValue = false;
                }
                break;
            
            case 'current':
                if (($this->current === null) || ($this->current->data === null)) {
                    $returnValue = false;
                }
                break;

            default:
                // method name does not exist so return false
                $returnValue = false;
                break;
        }
        return $returnValue;
    }

    /**
     * reverses the list traversal direction
     * 
     * note:  I am assuming that the reverse method, based on the requirement, is meant to change the traversing order of the list
     *        and not the order of the list itself. This is a little confusing with the requirement that is talking about
     *        algortihm performance so I have decided to provide both methods.
     */
    public function reverse()
    {
        $this->listTraversalDirection = !$this->listTraversalDirection;
    }

    /**
     * reverses the list
     * 
     * @note:  Again, I was not certain about the requirement around reversing the list, if it was actually reversing the 
     *         order of the list or the traversing direction. The other thing this brings up is that the add method would have
     *         to account for ordered insertion if we actually reverse the list.
     */
    public function reverseList()
    {
        // check if the list is empty or not
        if ($this->listSize == 0) {
            throw new Exception("List is empty.");
        }

        $current = $this->head;
        $this->tail = $this->head;
        $temp    = null;
        while ($current != null) {
            $temp = $current->previous;
            
            $current->previous = $current->next;
            $current->next = $temp;
            $current = $current->previous;
        }
        if ($temp != NULL) {
            $this->head = $temp->previous;
        }

        // update the list sorted direction (ascending or descending)
        $this->listSortedAscending = !$this->listSortedAscending;

        // reset current - there is not a requirement around what to do with the current position after a reverse
        // so I am going to reset it here
        $this->current = null;
    }

    /**
     * prints out the current list
     *
     * @return     string  contains the string representation of the list
     */
    public function printList()
    {
        $returnValue = "";

        // check to see if the list is empty or not
        if ($this->listSize == 0) {
            $returnValue = "The list is empty.";
        } else {
            // start at the front of the list
            $currentNode = $this->head;

            while ($currentNode != null) {
                $returnValue .= $currentNode->data . " ";
                $currentNode = $currentNode->next;
            }
        }

        // drop the last space before we return
        return $returnValue;
    }
}

<?php
/**
 * Represents a list node element that comprises the link list.
 */
namespace LinkedList;

use Exception;

class ListNode
{
    // define public properties for this object
    public $data;
    public $previous;
    public $next;

    /**
     * constructor
     *
     * @param      int  $data   data to store with this node
     */
    public function __construct($data)
    {
        if (is_numeric($data)) {
            $this->data = $data;
        } else {
            throw new Exception("The data passed in is either null or not a valid number.");
        }
    }
}

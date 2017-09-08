<?php

/**
 * This class manages a Structure STACK
 *
 * @param  stack  stack structure
 * @param  limit  limit of elements that stack can contain
 */
class Stack
{
    protected $stack;
    protected $limit;
    
	
	/**
	 * constructor setup the class properties  
	 *
	 */
    public function __construct($limit = MAX_ELEMENT) {
        // initialize the stack
        $this->stack = array();
        // stack can only contain this many items
        $this->limit = $limit;
    }

	/**
	 * push a new item on the top of the stak 
	 *
	 * @param  item  element to push
	 * @return      error message if stack is full
	 */
    public function push($item) {
        // trap for stack overflow
        if (count($this->stack) < $this->limit) {
            // prepend item to the start of the array
            array_unshift($this->stack, $item);
        } else {
            throw new RunTimeException('Stack is full!'); 
        }
    }

	/**
	 * pop the element on top from the stack 
	 *
	 * @return      error message if stack is empty
	 */
    public function pop() {
        if ($this->isEmpty()) {
            // trap for stack underflow
	      throw new RunTimeException('Stack is empty!');
	  } else {
            // pop item from the start of the array
            return array_shift($this->stack);
        }
    }

	/**
	 * return element on top 
	 *
	 * @return      elemnt on top
	 */
    public function top() {
        return current($this->stack);
    }

	/**
	 * check if stack is empty
	 *
	 * @return      true if is not empty
	 *				false if is empty
	 */
    public function isEmpty() {
        return empty($this->stack);
    }
	
	/**
	 * Display whole stack on screen
	 */
    public function displayStack() {
        echo  implode($this->stack) . '<br/>';
    }
}

?>
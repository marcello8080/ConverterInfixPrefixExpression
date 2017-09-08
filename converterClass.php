<?php

/**
 * This class convert an infix espression to an prefix expression through a stack structure
 * this class ignores any operator or operand that hasn't been declare on class OperandOperator
 * this class assumes that the expression in input is a valid infix math expression 
 * although I add a method to test is the expression is a good math expression or not I cannot be sure about this
 *
 * @param  operator  class to manage operator, operand and parentheses
 * @param  stack  calss to manage the stack
 * @param  expressionReady  flag variable, if true the expression has been inserted on the class, false otherwise
 * @param  result  result of the convertion, prefix expression
 * @param  expression  expression to convert, infix expression
 */
class ConverterInfixPrefix{
	private $operator;
	private $stack;
	private $expressionReady = false;
	private $result = array();
	private $expression = array();
	
	/**
	 * constructor setup the class operator and stack  
	 *
	 */
	public function __construct() {
        $this->operator = new OperandOperator();
        $this->stack = new Stack();
    }
	
	/**
	 * set the value of the expression, also set flag variable expressionReady
	 *
	 * @param  expression  infix expression
	 */
	public function setExpression($expression){
		$this->expression = $expression;
		$this->expressionReady = true;
	}
	
	/**
	 * check if the expression has been inserted
	 *
	 * @return  message error
	 */
	public function getExpression(){
		if($this->expressionReady == false){
			return "Expression is not ready!!!";
		}
		return $this->expression;
	}
	
	/**
	 * calculate the prefix expression
	 * convert the "expression" to result
	 *
	 * @return  message error
	 */
	public function convert(){
		if($this->expressionReady == false){
			return "Expression is not ready!!!";
		}
		else{
			for( $i = 0 ; $i < strlen($this->expression); $i++){
				// if current element is operand put it in result
				if($this->operator->isOperand($this->expression[$i])) // if current element is operand put it in result
					$this->result[] = $this->expression[$i];
				else
					// if current element is operator check what is in the stack
					if($this->operator->isOperator($this->expression[$i])){ // if current element is operator check what is in the stack
						// if stack is empty AND the element on stack top is not opening parentheses AND the element on stack top has higher precedence
						while (!$this->stack->isEmpty() && !$this->operator->isOpeningParentheses($this->stack->top()) && $this->operator->hasHigherPrec($this->stack->top(),$this->expression[$i])){
							$this->result[] = $this->stack->top(); // copy element on stack top to result
							$this->stack->pop();
						}
						$this->stack->push($this->expression[$i]); // push element on the stack otherwise
					}
					else 
						// if current element is opening parentheses push it on the stack 
						if($this->operator->isOpeningParentheses($this->expression[$i]))
							$this->stack->push($this->expression[$i]);
						else
							// if current element is closing parentheses push it on the stack 
							if($this->operator->isClosingParentheses($this->expression[$i])){
								while (!$this->stack->isEmpty() && !$this->operator->isOpeningParentheses($this->stack->top())){
									$this->result[] = $this->stack->top();
									$this->stack->pop();
								}
								$this->stack->pop();
							}
				// display evolution of stack and return expression
				//$this->stack->displayStack();
				//$this->displayResult();
			}
			$this->emptyStack();
			
			return implode($this->result);
		}
	}
	
	/**
	 * empty the stack if there is any element inside,
	 * copy the elements left in the stack to the prefix expression
	 */
	private function emptyStack(){
		while(!$this->stack->isEmpty()){
			$this->result[] = $this->stack->top();
			$this->stack->pop();
		}
	}
	
	/**
	 * display the current value of result expression (the prefix one) on screen
	 *
	 * @return  prefix expression
	 */
	private function displayResult(){
		echo implode($this->result) . '<br/>';
	}
	
	/**
	 * check if the expression in input is a math expression or not
	 *
	  * @param  expression  infix expression
	 * @return  true if it's an math expression	
	 *			false if it's not
	 */
	function is_math( $maybe_math ){
		$pattern = '([-+]?[0-9]*\.?[0-9]+[\/\+\-\*])+([-+]?[0-9]*\.?[0-9])';
		if( 0 === preg_match( $maybe_math, $pattern ) ){
			return true;
		}
	}
}

?>
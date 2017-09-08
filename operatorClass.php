<?php

/**
 * This class manages the operators and the operand of the expression
 *
 * @param  lowOperator  array with low priority operators
 * @param  highOperator  array with high priority operators
 * @param  parentheses  array parentheses, not in use, eventually if we want to extend the program to [] parentheses and {}
 */
 
class OperandOperator{
	
	public $lowOperator = array("+", "-");
	public $highOperator = array("*", "/");
	public $parentheses = array("(", ")");
	
	/**
	 * check if element in input is a operand accepted by the system 
	 *
	 * @param  element  operand in input
	 * @return      true if the element is a number or a space
	 * 				false otherwise
	 */
	public function isOperand($element){
		if($element == ' ')
			return(true);
		return is_numeric($element); 
	}
	
	/**
	 * check if element in input is a operator accepted by the system 
	 *
	 * @param  element  operator in input
	 * @return      true if the element is in lowOperator array or highOperator array
	 * 				false otherwise
	 */
	public function isOperator($element){
		if(in_array($element,$this->lowOperator))
			return (true);
		if(in_array($element,$this->highOperator))
			return (true);
		return (false);
	}
	
	/**
	 * check if elemTop in input has highter precedence than element
	 *
	 * @param  elemTop  element to compare
	 * @param  element  second element
	 * @return      true if the elemTop has more precendece, elemTop is in array highOperator and element is not
	 * 				false otherwise
	 */
	public function hasHigherPrec($elemTop, $element){
		if(in_array($elemTop, $this->highOperator) && (!in_array($element, $this->highOperator)))
			return (true);
		return (false);
	}
	
	/**
	 * check if element in input is and Opening Parentheses
	 *
	 * @param  element  element
	 * @return      true if element in input is and Opening Parentheses
	 * 				false otherwise
	 */
	public function isOpeningParentheses($element){
		if($element == '(')
			return (true);
		return (false);
	}
	
	/**
	 * check if element in input is and Closing Parentheses
	 *
	 * @param  element  element
	 * @return      true if element in input is and Closing Parentheses
	 * 				false otherwise
	 */
	public function isClosingParentheses($element){
		if($element == ')')
			return (true);
		return (false);
	}
}

?>
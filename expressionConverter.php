<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define ("MAX_ELEMENT",100);
$expression = "((15 / (7 - (1 + 1))) * 3) - (2 + (1 + 1)) ";

include("stackClass.php");
include("operatorClass.php");
include("converterClass.php");


$converter = new ConverterInfixPrefix();
$converter->setExpression($expression);
echo $converter->getExpression() . '<br/>';
echo $converter->convert();

?>
<br/><br/>
Here the example:
<a href="https://en.wikipedia.org/wiki/Reverse_Polish_notation#Example" target="_blank">https://en.wikipedia.org/wiki/Reverse_Polish_notation</a>
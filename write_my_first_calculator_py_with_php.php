<?php
define("OPERATORS", ['+', '-', '*', '/']);
echo "Define the range of numbers ~from~ and ~to~\n";
echo "from: ";
$input = preg_match('/\d+/', readline(), $from);
if (!$input): echo "Just accept digits :D"; exit; endif;
echo "to: ";
$input = preg_match('/\d+/', readline(), $to);
if (!$input): echo "Just accept digits :D";exit; endif;
if ($from[0] > $to[0]): echo "Are ypu stupid? :D";exit; endif;
define("FROM", (int) $from[0]);
define("TO", (int) $to[0]);
$acc_text = "";
$filename = "my_first_calculator_" . strtotime(date("Y-m-d H:i:s"));

function calc($n1, $n2, $op) {
    switch ($op) {
        case '+':
            return $n1 + $n2;
            break;
        
        case '-':
            return $n1 - $n2;
            break;

        case '*':
            return $n1 * $n2;
            break;

        case '/':
            return $n1 / $n2;
            break;
    }
}

foreach (OPERATORS as $operator) {
    foreach (range(FROM, TO) as $_n1) {
        foreach (range(FROM, TO) as $_n2) {
            $v = calc($_n1, $_n2, $operator);
            $acc_text .= "if num1 == $_n1 and sign == '$operator' and num2 == {$_n2}: \n\tprint(\"{$_n1}{$operator}{$_n2} = {$v}\")\n";
        }
    }
}

$pycalculator = <<<TEXT
# my_first_calculator.py by wpkenpachi
# TODO: Make it work for all floating point numbers too

if 3/2 == 1:  # Because Python 2 does not know maths
    input = raw_input  # Python 2 compatibility

print('Welcome to this calculator!')
print('It can add, subtract, multiply and divide whole numbers from $from[0] to $to[0]')
num1 = int(input('Please choose your first number: '))
sign = input('What do you want to do? +, -, /, or *: ')
num2 = int(input('Please choose your second number: '))

$acc_text

print("Thanks for using this calculator, goodbye :)")
TEXT;

$pyscript = fopen("$filename.py", "w") or die("Unable to open file!");
fwrite($pyscript, $pycalculator);
fclose($pyscript);
echo "Your $filename.py has been created!";
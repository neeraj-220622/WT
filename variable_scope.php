<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="variable_scope.php" method="post">
        <label>Press the Button to increment</label><br>
        <input type="hidden" name="input" value="0"><br>
        <button type="submit">submit</button>
    </form>
</body>

</html>
<?php
//Task A2
$integer = 45;
$string = "Hello, World!";
$arr = array("basketball", "soccer", "tennis");
$bool = true;
$float = 3.14;
echo "Integer: " . $integer . "<br>";
echo "Integer Type:" . var_dump($integer) . "<br>";
echo "String: " . $string . "<br>";
echo "String Type:" . var_dump($string) . "<br>";
echo "Array: ";
print_r($arr);
echo "Array Type:" . var_dump($arr) . "<br>";
echo "Boolean: " . ($bool ? "true" : "false") . "<br>";
echo "Boolean Type:" . var_dump($bool) . "<br>";
echo "Float: " . $float . "<br>";
echo "Float Type:" . var_dump($float) . "<br>";
//Task A3
function displayValue()
{
    $a = 25;
    echo "The value of a is : " . $a . "<br>";
}
displayValue();
echo "The variable declared inside the function cant be displayed" . $a . "<br>";
$b = 30;
function display()
{
    global $b;
    echo "The value outside the function should called by using global keyword :" . $b . "<br>";
}
echo "The value outside the function call : " . $b . "<br>";
display();
$num = 0;
function increment()
{
    static $num = 0;
    echo ++$num;
}
increment();
increment();
increment();

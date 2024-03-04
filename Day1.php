<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Day first of php -->
    <?php
        $txt = ' kal ';
        $length = strlen($txt);
        for($i = 0; $i < $length; $i++)
        {
            echo $txt[$i]." ";
        }
        echo 'hello '. $txt;
        echo strlen($txt);
        echo str_word_count($txt);
        echo strpos("Hello world!", "!");
        $x = "  Hello World!  ";
        $y = explode(" ", $x);
        //Use the print_r() function to display the result:
        print_r($y);
        echo str_replace("World","php",$x);
        echo strrev($x);
        echo trim($x);
        echo(print " My first " .$txt." program version ");
        echo "my first $txt program <br>";
        echo "This ", "string ", "was ", "made ", "with multiple parameters.";
        $num1 = 2;
        echo "<br>";
        $num2 = 2;
        $num = "-";
        $num = (boolean)$num;
        echo $num;
        // echo $num1*$num2;
        // echo "<br>";
        // echo $txt . "aman <br> ";
        // var_dump(5);
        // var_dump("John");
        // var_dump(3.14);
        // var_dump(true);
        // var_dump([2, 3, 56]);
        // var_dump(NULL);
        // var_dump($num1);
        function test()
        {
            $GLOBALS['num1'] = $GLOBALS['num2'] + $GLOBALS['num1'];
        }
        function myTest()
        {

            $name = "Aman";
            global $num2;
            static $age = $num2;
            $student = $name." ".$age+1;
            echo $student ."<br>";
            echo $name." ".$age;
            $age++;
            echo "<br>";
        }
        test();
        myTest();
        myTest();
        myTest();
        echo "num varible ".$num1."<br>";

        echo "Hexadecimal part";
        $temp = "02";
        $t = "02";
        if($temp === $t)
        {
            echo " equal";
        }
        else
            echo "Not equal";
        echo pow(2,5);
        ?>
</body>
</html>
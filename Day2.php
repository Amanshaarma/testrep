<?php 
    // include_once '';
    $str = "Aman";
    $str1 = 'Sharma';

    echo $str." ". $str1."\n";
    $length = strlen($str1);
    for($i = 0; $i < $length; $i++)
    {
        if($str1[$i] == 'a')
        {
            $str1[$i]='A';
        }
    }
    echo $str1;
    // Heredoc
$heredocString = <<<EOD
This is a heredoc $str.
It can span multiple lines.
EOD;
 echo $heredocString;
// Nowdoc
$nowdocString = <<<'EOD'
This is a nowdoc $str.
It behaves like single quotes.
EOD;
echo $nowdocString;
$originalString = "Hello, World!";
$replacement = "PHP\n";
$index = 7; // Index where replacement should start

$newString = substr_replace($originalString, $replacement, $index, strlen($replacement));

echo $newString."\n";
$count =readfile("C:\aman\NoMain.java");
$fielcontent = fopen("C:\aman\NoMain.java","a");
fwrite($fielcontent,$replacement);
fwrite($fielcontent,$replacement);
fwrite($fielcontent,$replacement);
// $t =  fread($fielcontent,filesize("c:\aman\NoMain.java"));
fclose($fielcontent);
echo "\n".$count; 
$arr = array("Volvo", "BMW", "Toyota");
$arr += ["Aman"];
array_push($arr,2);
print_r($arr);
echo $arr[1];
$myCar = [];
$myCar["brand"] = "Ford";
$myCar["model"] = "Mustang";
$myCar["year"] = 1964;
print_r($myCar);
echo $myCar["brand"];
$hashmap=array("name"=>"aman","age"=>"25");
$hashmap+=["color" => "brown", "year" => 1964];
print_r($hashmap);
$date = date("d-m-y  ");
echo $date;
$text = "The quick brown fox jumps over the lazy dog.";

// Using preg_match to search with a regular expression
$searchPattern = "/brown/i";  // case-insensitive search for "brown"
$matchCount = preg_match($searchPattern, $text, $matches);
echo $matchCount;
print_r($matches) ;
echo strlen($text);
echo str_pad($text,5," 23");
echo str_repeat($text,6)."\n";
$number = 1234567.89;
echo number_format($number,2,".",",");
function myFunction() {
    echo "I come from a function!";
  }
  
  $myArr = array("Volvo", 15, myFunction());
  echo $myArr[2];
  $myArr[2];


?>
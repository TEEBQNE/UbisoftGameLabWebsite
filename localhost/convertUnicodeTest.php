<?php
include("src/Emoji.php");

//$input = "Hello 👍🏼 World 👨‍👩‍👦‍👦";
$input = "😋😋😋😋😋😋😋😋😋😋";

// finds all emojis in the string
$emoji = Emoji\detect_emoji($input);

$emojiCount = sizeof($emoji);

echo $input;
echo '<br>';

//$input = preg_replace('/([0-9#][\x{20E3}])|[\x{00ae}\x{00a9}\x{203C}\x{2047}\x{2048}\x{2049}\x{3030}\x{303D}\x{2139}\x{2122}\x{3297}\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u', $input, $emojis);

// loop through all emojis found
for($x = 0; $x < sizeof($emoji); $x++)
{
	//echo $emoji[$x]['hex_str'];
	//echo $emoji[$x]['hex_str'];
	//echo $emoji[$x]['emoji'];
	//echo "<br>";
}

echo $emoji;


?>
<?php
namespace Emoji;

define('LONGEST_EMOJI', 8);

function detect_emoji($string) {
  // Find all the emoji in the input string

  $prevencoding = mb_internal_encoding();
  mb_internal_encoding('UTF-8');

  $data = array();
	$test = $string;
  static $map;
  if(!isset($map))
    $map = _load_map();

  static $regexp;
  if(!isset($regexp))
    $regexp = _load_regexp();

  if(preg_match_all($regexp, $string, $matches)) {
    foreach($matches[0] as $ch) {
      $points = array();
      for($i=0; $i<mb_strlen($ch); $i++) {
        $points[] = strtoupper(dechex(uniord(mb_substr($ch, $i, 1))));
      }
      $hexstr = implode('-', $points);
		$theMatch = $string.exec($ch);
		
		$test = substr_replace($test, "[[[[".$hexstr."]]]]", strpos($test, $ch), strlen($ch));
    }
  }

  if($prevencoding)
    mb_internal_encoding($prevencoding);

  return $test;
}

function _load_map() {
  return json_decode(file_get_contents(dirname(__FILE__).'/map.json'), true);
}

function _load_regexp() {
  return '/(?:' . json_decode(file_get_contents(dirname(__FILE__).'/regexp.json')) . ')/u';
}

function uniord($c) {
  $ord0 = ord($c[0]); if ($ord0>=0   && $ord0<=127) return $ord0;
  $ord1 = ord($c[1]); if ($ord0>=192 && $ord0<=223) return ($ord0-192)*64 + ($ord1-128);
  $ord2 = ord($c[2]); if ($ord0>=224 && $ord0<=239) return ($ord0-224)*4096 + ($ord1-128)*64 + ($ord2-128);
  $ord3 = ord($c[3]); if ($ord0>=240 && $ord0<=247) return ($ord0-240)*262144 + ($ord1-128)*4096 + ($ord2-128)*64 + ($ord3-128);
  return false;
}

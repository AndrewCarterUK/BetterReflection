--TEST--
ReflectionParameter::getDeclaringFunction()
--CREDITS--
Stefan Koopmanschap <stefan@stefankoopmanschap.nl>
#testfest roosendaal on 2008-05-10
--FILE--
<?php require 'vendor/autoload.php';
function ReflectionParameterTest($test, $test2 = null) {
	echo $test;
}
$reflect = \BetterReflection\Reflection\ReflectionFunction::createFromName('ReflectionParameterTest');
$params = $reflect->getParameters();
foreach($params as $key => $value) {
	echo $value->getDeclaringFunction() . "\n";
}
?>
==DONE==
--EXPECTF--
Function [ <user> function ReflectionParameterTest ] {
  @@ %s.php %d - %d

  - Parameters [2] {
    Parameter #0 [ <required> $test ]
    Parameter #1 [ <optional> $test2 = NULL ]
  }
}

Function [ <user> function ReflectionParameterTest ] {
  @@ %s.php %d - %d

  - Parameters [2] {
    Parameter #0 [ <required> $test ]
    Parameter #1 [ <optional> $test2 = NULL ]
  }
}

==DONE==

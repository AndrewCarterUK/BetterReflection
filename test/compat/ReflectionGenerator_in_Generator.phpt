--TEST--
ReflectionGenerator while being currently executed
--FILE--
<?php require 'vendor/autoload.php';

function call(ReflectionGenerator $ref, $method, $rec = true) {
	if ($rec) {
		call($ref, $method, false);
		return;
	}
	// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($ref->$method());
}

function doCalls(ReflectionGenerator $ref) {
	call($ref, "getTrace");
	call($ref, "getExecutingLine");
	call($ref, "getExecutingFile");
	call($ref, "getExecutingGenerator");
	call($ref, "getFunction");
	call($ref, "getThis");
}

($gen = (function() use (&$gen) {
	$ref = \BetterReflection\Reflection\ReflectionGenerator::createFromName($gen);

	doCalls($ref);

	yield from (function() use ($ref) {
		doCalls($ref);
		yield; // Generator !
	})();
})())->next();

?>
--EXPECTF--
array(0) {
}
int(%d)
string(%d) "%sReflectionGenerator_in_Generator.%s"
object(Generator)#2 (0) {
}
object(ReflectionFunction)#4 (1) {
  ["name"]=>
  string(9) "{closure}"
}
NULL
array(1) {
  [0]=>
  array(2) {
    ["function"]=>
    string(9) "{closure}"
    ["args"]=>
    array(0) {
    }
  }
}
int(%d)
string(%d) "%sReflectionGenerator_in_Generator.%s"
object(Generator)#5 (0) {
}
object(ReflectionFunction)#6 (1) {
  ["name"]=>
  string(9) "{closure}"
}
NULL

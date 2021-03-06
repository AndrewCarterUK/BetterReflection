--TEST--
ReflectionClass::hasProperty() - error cases
--CREDITS--
Robin Fernandes <robinf@php.net>
Steve Seear <stevseea@php.net>
--FILE--
<?php require 'vendor/autoload.php';
class C {
	public $a;
}

$rc = \BetterReflection\Reflection\ReflectionClass::createFromName("C");
echo "Check invalid params:\n";
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rc->hasProperty());
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rc->hasProperty("a", "a"));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rc->hasProperty(null));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rc->hasProperty(1));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rc->hasProperty(1.5));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rc->hasProperty(true));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rc->hasProperty(array(1,2,3)));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rc->hasProperty(new C));
?>
--EXPECTF--
Check invalid params:

Warning: ReflectionClass::hasProperty() expects exactly 1 parameter, 0 given in %s on line 8
NULL

Warning: ReflectionClass::hasProperty() expects exactly 1 parameter, 2 given in %s on line 9
NULL
bool(false)
bool(false)
bool(false)
bool(false)

Warning: ReflectionClass::hasProperty() expects parameter 1 to be string, array given in %s on line 14
NULL

Warning: ReflectionClass::hasProperty() expects parameter 1 to be string, object given in %s on line 15
NULL

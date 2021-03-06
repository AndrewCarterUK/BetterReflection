--TEST--
ReflectionClass::getDocComment() - bad params
--CREDITS--
Robin Fernandes <robinf@php.net>
Steve Seear <stevseea@php.net>
--FILE--
<?php require 'vendor/autoload.php';
class C {}
$rc = \BetterReflection\Reflection\ReflectionClass::createFromName('C');
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rc->getDocComment(null));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rc->getDocComment('X'));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rc->getDocComment(true));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rc->getDocComment(array(1,2,3)));
?>
--EXPECTF--
Warning: ReflectionClass::getDocComment() expects exactly 0 parameters, 1 given in %s on line %d
NULL

Warning: ReflectionClass::getDocComment() expects exactly 0 parameters, 1 given in %s on line %d
NULL

Warning: ReflectionClass::getDocComment() expects exactly 0 parameters, 1 given in %s on line %d
NULL

Warning: ReflectionClass::getDocComment() expects exactly 0 parameters, 1 given in %s on line %d
NULL

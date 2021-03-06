--TEST--
ReflectionClass::isIterateable()
--CREDITS--
Robin Fernandes <robinf@php.net>
Steve Seear <stevseea@php.net>
--FILE--
<?php require 'vendor/autoload.php';
Interface ExtendsIterator extends Iterator {
}
Interface ExtendsIteratorAggregate extends IteratorAggregate {
}
Class IteratorImpl implements Iterator {
	public function next() {}
	public function key() {}
	public function rewind() {}
	public function current() {}
	public function valid() {}
}
Class IterarorAggregateImpl implements IteratorAggregate {
	public function getIterator() {}
}
Class ExtendsIteratorImpl extends IteratorImpl {
}
Class ExtendsIteratorAggregateImpl extends IterarorAggregateImpl {
}
Class A {
}

$classes = array('Traversable', 'Iterator', 'IteratorAggregate', 'ExtendsIterator', 'ExtendsIteratorAggregate', 
	  'IteratorImpl', 'IterarorAggregateImpl', 'ExtendsIteratorImpl', 'ExtendsIteratorAggregateImpl', 'A');

foreach($classes as $class) {
	$rc = \BetterReflection\Reflection\ReflectionClass::createFromName($class);
	echo "Is $class iterable? ";
	// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rc->isIterateable());
}

echo "\nTest invalid params:\n";
$rc = \BetterReflection\Reflection\ReflectionClass::createFromName('IteratorImpl');
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rc->isIterateable(null));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rc->isIterateable(null, null));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rc->isIterateable(1));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rc->isIterateable(1.5));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rc->isIterateable(true));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rc->isIterateable('X'));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rc->isIterateable(null));

echo "\nTest static invocation:\n";
ReflectionClass::isIterateable();

?>
--EXPECTF--
Is Traversable iterable? bool(false)
Is Iterator iterable? bool(false)
Is IteratorAggregate iterable? bool(false)
Is ExtendsIterator iterable? bool(false)
Is ExtendsIteratorAggregate iterable? bool(false)
Is IteratorImpl iterable? bool(true)
Is IterarorAggregateImpl iterable? bool(true)
Is ExtendsIteratorImpl iterable? bool(true)
Is ExtendsIteratorAggregateImpl iterable? bool(true)
Is A iterable? bool(false)

Test invalid params:

Warning: ReflectionClass::isIterateable() expects exactly 0 parameters, 1 given in %s on line 34
NULL

Warning: ReflectionClass::isIterateable() expects exactly 0 parameters, 2 given in %s on line 35
NULL

Warning: ReflectionClass::isIterateable() expects exactly 0 parameters, 1 given in %s on line 36
NULL

Warning: ReflectionClass::isIterateable() expects exactly 0 parameters, 1 given in %s on line 37
NULL

Warning: ReflectionClass::isIterateable() expects exactly 0 parameters, 1 given in %s on line 38
NULL

Warning: ReflectionClass::isIterateable() expects exactly 0 parameters, 1 given in %s on line 39
NULL

Warning: ReflectionClass::isIterateable() expects exactly 0 parameters, 1 given in %s on line 40
NULL

Test static invocation:

Fatal error: Uncaught Error: Non-static method ReflectionClass::isIterateable() cannot be called statically in %s:43
Stack trace:
#0 {main}
  thrown in %s on line 43

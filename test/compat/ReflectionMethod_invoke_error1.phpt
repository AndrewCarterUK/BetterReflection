--TEST--
ReflectionMethod::invoke() errors
--FILE--
<?php require 'vendor/autoload.php';

class TestClass {
    public $prop = 2;

    public function foo() {
        echo "Called foo(), property = $this->prop\n";
        // @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($this);
        return "Return Val";
    }

    private static function privateMethod() {
        echo "Called privateMethod()\n";
    }
}

abstract class AbstractClass {
    abstract function foo();
}

$foo = \BetterReflection\Reflection\ReflectionMethod::createFromName('TestClass', 'foo');
$privateMethod = \BetterReflection\Reflection\ReflectionMethod::createFromName("TestClass::privateMethod");

$testClassInstance = new TestClass();
$testClassInstance->prop = "Hello";

echo "invoke() on a non-object:\n";
try {
    // @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($foo->invoke(true));
} catch (ReflectionException $e) {
    // @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($e->getMessage());
}

echo "\ninvoke() on a non-instance:\n";
try {
    // @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($foo->invoke(new stdClass()));
} catch (ReflectionException $e) {
    // @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($e->getMessage());
}

echo "\nPrivate method:\n";
try {
    // @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($privateMethod->invoke($testClassInstance));
} catch (ReflectionException $e) {
    // @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($e->getMessage());
}

echo "\nAbstract method:\n";
$abstractMethod = \BetterReflection\Reflection\ReflectionMethod::createFromName("AbstractClass::foo");
try {
    $abstractMethod->invoke(true);
} catch (ReflectionException $e) {
    // @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($e->getMessage());
}

?>
--EXPECTF--
invoke() on a non-object:
string(29) "Non-object passed to Invoke()"

invoke() on a non-instance:
string(72) "Given object is not an instance of the class this method was declared in"

Private method:
string(86) "Trying to invoke private method TestClass::privateMethod() from scope ReflectionMethod"

Abstract method:
string(53) "Trying to invoke abstract method AbstractClass::foo()"

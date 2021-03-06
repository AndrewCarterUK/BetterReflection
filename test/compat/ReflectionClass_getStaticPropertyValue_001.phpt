--TEST--
ReflectionClass::getStaticPropertyValue() 
--CREDITS--
Robin Fernandes <robinf@php.net>
Steve Seear <stevseea@php.net>
--SKIPIF--
<?php if (version_compare(zend_version(), '2.4.0', '>=')) die('skip ZendEngine 2.3 or below needed'); ?>
--FILE--
<?php require 'vendor/autoload.php';
class A {
	static private $privateOverridden = "original private";
	static protected $protectedOverridden = "original protected";
	static public $publicOverridden = "original public";
}

class B extends A {
	static private $privateOverridden = "changed private";
	static protected $protectedOverridden = "changed protected";
	static public $publicOverridden = "changed public";
}

echo "Retrieving static values from A:\n";
$rcA = \BetterReflection\Reflection\ReflectionClass::createFromName('A');
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rcA->getStaticPropertyValue("privateOverridden", "default value"));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rcA->getStaticPropertyValue("\0A\0privateOverridden"));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rcA->getStaticPropertyValue("protectedOverridden", "default value"));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rcA->getStaticPropertyValue("\0*\0protectedOverridden"));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rcA->getStaticPropertyValue("publicOverridden"));

echo "\nRetrieving static values from B:\n";
$rcB = \BetterReflection\Reflection\ReflectionClass::createFromName('B');
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rcB->getStaticPropertyValue("\0A\0privateOverridden"));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rcB->getStaticPropertyValue("\0B\0privateOverridden"));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rcB->getStaticPropertyValue("\0*\0protectedOverridden"));
// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rcB->getStaticPropertyValue("publicOverridden"));

echo "\nRetrieving non-existent values from A with no default value:\n";
try {
	// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rcA->getStaticPropertyValue("protectedOverridden"));
	echo "you should not see this";
} catch (Exception $e) {
	echo $e->getMessage() . "\n";
}

try {
	// @todo see https://github.com/Roave/BetterReflection/issues/155 --- var_dump($rcA->getStaticPropertyValue("privateOverridden"));
	echo "you should not see this";	
} catch (Exception $e) {
	echo $e->getMessage() . "\n";
}

?>
--EXPECTF--
Retrieving static values from A:
string(13) "default value"
string(16) "original private"
string(13) "default value"
string(18) "original protected"
string(15) "original public"

Retrieving static values from B:
string(16) "original private"
string(15) "changed private"
string(17) "changed protected"
string(14) "changed public"

Retrieving non-existent values from A with no default value:
Class A does not have a property named protectedOverridden
Class A does not have a property named privateOverridden

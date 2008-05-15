<?php
require_once dirname(dirname(__FILE__)) . '/examples.inc.php';
require_once dirname(__FILE__) . '/FooObject.php';

$foo = new FooObject();

$yield = new SingaDefaultYieldImpl();
$yield->addObject($foo);

echo $yield->next()->process() . PHP_EOL;
echo $yield->next()->process() . PHP_EOL;
echo $yield->next()->process() . PHP_EOL;

echo "-------" . PHP_EOL;

echo $yield->prev()->process() . PHP_EOL;
echo $yield->prev()->process() . PHP_EOL;
echo $yield->prev()->process() . PHP_EOL;

echo "-------" . PHP_EOL;

for($i = 0; $i < 10; $i++){
    echo "foo process: " . $foo->process() . PHP_EOL;
    echo "yield process: " . $yield->next()->process() . PHP_EOL;
}

echo "-------" . PHP_EOL;

foreach($yield as $key => $y){
    echo $y->process() . PHP_EOL;
}

var_dump($yield);

?>

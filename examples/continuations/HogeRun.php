<?php
require_once dirname(dirname(__FILE__)) . '/examples.inc.php';
require dirname(__FILE__) . '/HogeObject.php';

$continuation = new SingaDefaultContinuationImpl();
$continuation->addObject(new HogeObject());

$continuation->start();

echo "start" . PHP_EOL;

for($i = 0; $i < 5; $i++){
    $continuation->getObject()->execute();
}

echo "suspend main" . PHP_EOL;
$continuation->suspend(3);

for($i = 0; $i < 7; $i++){
    $continuation->getObject()->execute();
}

for($i = 0; $i < 6; $i++){
    echo "suspend sub --------------" . $i . PHP_EOL;
    $continuation->suspend(1);
    for($c = 0; $c < 7; $c++){
        $continuation->getObject()->execute();
    }
    $continuation->resume();
    echo "resume sub ---------------" . $i . PHP_EOL;
}

echo "resume main" . PHP_EOL;
$continuation->resume();

for($i = 0; $i < 10; $i++){
    $continuation->getObject()->execute();
}

$continuation->shutdown();

debug_zval_dump($continuation);
?>

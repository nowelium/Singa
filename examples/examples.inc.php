<?php
define('SRC_DIR', dirname(dirname(__FILE__)) . '/src/main/singa');
require_once SRC_DIR . '/Singa.php';
require_once SRC_DIR . '/LoaderInterface.php';
require_once SRC_DIR . '/utils/ClassLoader.php';
require_once SRC_DIR . '/server/ContinuationInterface.php';
require_once SRC_DIR . '/server/ContinuableInterface.php';
require_once SRC_DIR . '/server/continuations/DefaultContinuation.php';
require_once SRC_DIR . '/server/continuations/EventListener.php';
require_once SRC_DIR . '/server/YieldInterface.php';
require_once SRC_DIR . '/server/YieldableInterface.php';
require_once SRC_DIR . '/server/continuations/DefaultYield.php';

declare(ticks = 1);
?>

<?php
    $time1 = microtime(true);
    include 'lib/Hiss/Hiss.php';
    Hiss::run(dirname(__FILE__).DIRECTORY_SEPARATOR);
    $time2 = microtime(true);
?>
<hiss:include template="PAGE_CONTAINER"></hiss:include>
<?php
    // echo 'Script execution time: ' . ($time2 - $time1);
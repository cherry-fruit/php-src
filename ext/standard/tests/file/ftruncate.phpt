--TEST--
ftruncate() tests
--FILE--
<?php

$filename = __DIR__."/ftruncate.dat";

file_put_contents($filename, "some test data inside");

$fp = fopen($filename, "r");
var_dump(ftruncate($fp, 10));
fclose($fp);
var_dump(file_get_contents($filename));

$fp = fopen($filename, "w");
var_dump(ftruncate($fp, 10));
fclose($fp);
var_dump(file_get_contents($filename));

file_put_contents($filename, "some test data inside");

$fp = fopen($filename, "a");
var_dump(ftruncate($fp, 10));
fclose($fp);
var_dump(file_get_contents($filename));

$fp = fopen($filename, "a");
var_dump(ftruncate($fp, 0));
fclose($fp);
var_dump(file_get_contents($filename));

file_put_contents($filename, "some test data inside");

$fp = fopen($filename, "a");
try {
    var_dump(ftruncate($fp, -1000000000));
} catch (\ValueError $e) {
    echo $e->getMessage() . \PHP_EOL;
}
fclose($fp);
var_dump(file_get_contents($filename));

@unlink($filename);

?>
--EXPECTF--
bool(false)
string(21) "some test data inside"
bool(true)
string(10) "          "
bool(true)
string(10) "some test "
bool(true)
string(0) ""
Negative size is not supported
string(21) "some test data inside"

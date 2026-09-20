<?php
$quota = 30;
$registered = 18;
$isFull = $registered >= $quota;
$hasSeat = $registered < $quota;
var_dump($isFull);
var_dump($hasSeat);
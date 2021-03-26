<?php 
require "core.php";
print $db->q("select * from animals")->json(); 
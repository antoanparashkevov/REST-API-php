<?php

header('Content-Type: application/json');

$data = [
  "message" => "Hello World!"  
];

json_encode($data);
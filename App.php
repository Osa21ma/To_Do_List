<?php

require_once 'classes/Request.php';
require_once 'classes/Session.php';
require_once 'classes/Validation/Validator.php';
require_once 'classes/Validation/Required.php';
require_once 'classes/Validation/Str.php';
require_once 'classes/Validation/Validation.php';


use Classes\Request;
use Classes\Session;
use Classes\Validation\Required;
use Classes\Validation\Str;
use Classes\Validation\Validation;

$request = new Request();

$session = new Session();

$validation = new Validation;
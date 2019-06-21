<?php

$validate = new Classes\ClassValidate();

$validate->validateFields($_POST);
$validate->validateEmail($email);
$validate->validateIssetEmail($email, 'esqueci-senha');

echo $validate->validateFinalSen($arrVar);
<?php

$validate = new Classes\ClassValidate();

$arqName  = (isset($_FILES['imagem']['name'])) ? $_FILES['imagem']['name'] : null;
$arqType  = (isset($_FILES['imagem']['type'])) ? $_FILES['imagem']['type'] : null;
$arqSize  = (isset($_FILES['imagem']['size'])) ? $_FILES['imagem']['size'] : null;
$arqTemp  = (isset($_FILES['imagem']['tmp_name'])) ? $_FILES['imagem']['tmp_name'] : null;
$arqError = (isset($_FILES['imagem']['error'])) ? $_FILES['imagem']['error'] : null;

echo $validate->validateFinalEditar($arqName, $arqType, $arqSize, $arqTemp, $arqError, $arrVar);
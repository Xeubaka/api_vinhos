<?php
// phpcs:disable PEAR.Commenting
// phpcs:disable Generic.Files.LineLength.TooLong
use Util\ConstantGenericalUtil;
use Util\JsonUtil;
use Util\RoutesUtil;
use Validator\RequestValidator;

require_once "bootstrap.php";

try{
    $RequestValidator = new RequestValidator(RoutesUtil::getRoute());
    $retorno = $RequestValidator->processRequest();
    $JsonUtil = new JsonUtil();
    $JsonUtil->processArrayToReturn($retorno);
} catch (Exception $exception) {
    echo json_encode([ConstantGenericalUtil::TYPE => ConstantGenericalUtil::TYPE_ERROR,ConstantGenericalUtil::ANSWER => utf8_encode($exception->getMessage())], JSON_THROW_ON_ERROR, 512);
    exit;
}

?>




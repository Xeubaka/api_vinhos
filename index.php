<?php
/**
 * PHP version 7.4
 * Autoload
 * Auto load all classes
 *
 * @category AutoLoad
 * @package  Initial
 * @author   Luis Roberto <lrs.juca@gmail.com>
 * @license  Open Source https://opensource.org/docs/osd
 * @link     https://github.com/Xeubaka/api_vinhos/
 */


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

} catch (Exception $exception){
        echo json_encode([
            ConstantGenericalUtil::TYPE => ConstantGenericalUtil::TYPE_ERROR,
            ConstantGenericalUtil::ANSWER => utf8_encode($exception->getMessage())
        ], JSON_THROW_ON_ERROR, 512);
        exit;
    }

?>




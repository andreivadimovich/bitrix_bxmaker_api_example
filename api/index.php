<? 

// https://bxmaker.ru/doc/api/

define('STOP_STATISTICS', true);
define('NO_KEEP_STATISTIC', 'Y');
define('NO_AGENT_STATISTIC', 'Y');
define('DisableEventsCheck', true);
define('BX_SECURITY_SHOW_MESSAGE', false);
define('NOT_CHECK_PERMISSIONS', true);

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php'); 

if(\Bitrix\Main\Loader::includeModule('bxmaker.api'))
{
    $oApi = \Bxmaker\Api\Handler::getInstance();
    $oApi->setParam(array(
        'IBLOCK_ID_CATALOG' => 41,
        'PRICE_TYPE' => 'catalog_PRICE_1',
    ));

    // Проверка sessid не будет производиться для запросов в которых method=sale.* ... 
    /* дальше в этом про авторизацию рыть*/
    $oApi->setSkipMethodSessidControl(array(
        //'sale.*',
      'sale.session'
    ));
    #TODO

    $oApi->init();
    $oApi->showResult();
}
else
{
      echo json_encode(array('ststus' => 0, 'error' => array(
        'error_code' => 0,
        'error_msg' => 'Модуль обработки запросов не установлен'
    )));
}
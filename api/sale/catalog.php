<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/*
 * Get JSON catalog list.
 */

CModule::IncludeModule('iblock');
CModule::IncludeModule('catalog');
CModule::IncludeModule('sale');

$arFilter = Array('IBLOCK_ID'=> $this->getParam('IBLOCK_ID_CATALOG'), 'GLOBAL_ACTIVE'=>'Y');
$db_list = CIBlockSection::GetList(array("SORT"=>"ASC"), $arFilter, true);

$res=[];
while($ar_result = $db_list->GetNext()) {
    if (isset($ar_result['NAME']) && !empty($ar_result['NAME'])) {

        $res[$ar_result['ID']] = array(
        	'name' => $ar_result['NAME'],
            'category_id' => $ar_result['ID']);
    }
}

if (count($res) == 0) {
    return $this->setError('Empty catalog!', '666');
}

$res['count'] = count($res);
$res = json_encode($res,JSON_FORCE_OBJECT);

$this->setResult(array( 
   'success' => true ,
   'msg' => $res ? $res : (array('msg' => 'EMPTY CATALOG'))
));

<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

CModule::IncludeModule('iblock');
CModule::IncludeModule('catalog');
CModule::IncludeModule('sale');

if (!isset($_REQUEST['category_id']) || empty($_REQUEST['category_id'])) {
    return $this->setError('The category id is not found!', '666');
}

$_REQUEST['category_id'] = (int)$_REQUEST['category_id'];

$arFilter = array(
    'IBLOCK_ID'=> $this->getParam('IBLOCK_ID_CATALOG'),
    'SECTION_ID' => $_REQUEST['category_id'],
    'ACTIVE' => 'Y',
    'price'=> $this->getParam('PRICE_TYPE'),
);
$db_list = CIBlockElement::GetList(array("SORT"=>"ASC"), $arFilter, false);

$res=[];
while($ar_result = $db_list->GetNext()) {
    // цена
    $rsPrices = CPrice::GetList(array(), array('PRODUCT_ID' => $ar_result['ID']));
    $arPrice = $rsPrices->Fetch();

    // остатки
    $rsStore = CCatalogStoreProduct::GetList(array(), array('PRODUCT_ID' => $ar_result['ID']), false, false, array('AMOUNT'));
    $arStore = $rsStore->Fetch();

    $res[$ar_result['ID']] = array(
        'name' => $ar_result['NAME'],
        'price' => $arPrice['PRICE'],
        'remains' => $arStore['AMOUNT'] ? $arStore['AMOUNT'] : 0,
    );
}

$this->setResult(array(
    'success' => true ,
    'msg' => count($res) > 0 ? $res : (array('msg' => 'Catalog is empty (check congif data in index.php)'))
));
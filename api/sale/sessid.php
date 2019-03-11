<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

exit(json_encode(array(
	'sessid' => $_SESSION['fixed_session_id'])
));
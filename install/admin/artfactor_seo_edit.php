<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");
if (CModule::IncludeModule('IBlock')) {
    IncludeModuleLangFile(__FILE__);
    if (!$USER->CanDoOperation('edit_other_settings')&&$_GET["AF_ACCESS"]!="TRUE")
      $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
    $site_description = COption::GetOptionString("main","site_description");
    $arError = $arSmile = $arFields = $arLang = array();
    if ($REQUEST_METHOD == "POST") {
      if (!check_bitrix_sessid()) {
          $arError[] = array(
              "id" => "bad_sessid",
              "text" => GetMessage("ERROR_BAD_SESSID"));
      }
      if (empty($arError)) {
          $site_description	= strip_tags($_REQUEST['site_description']);
          COption::SetOptionString("main","site_description", $site_description);
        }
        header('Location: /bitrix/admin/artfactor_seo_edit.php');
    }
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");

$aMenu = array(
    array(
        "TEXT" => "Описание сайта",
        "LINK" => "/bitrix/admin/artfactor_seo_edit.php?lang=" . LANG,
        "ICON" => "btn_list",
    )
);

$context = new CAdminContextMenu($aMenu);
$context->Show();
if (isset($message) && $message)
    echo $message->Show();
?>
<form method="POST" action="<?= $APPLICATION->GetCurPageParam() ?>" name="seo_edit" enctype="multipart/form-data" class="form-table">
    <input type="hidden" name="Update" value="Y"/>
    <input type="hidden" name="lang" value="<?= LANG ?>"/>
    <input type="hidden" name="ID" value="<?= $ID ?>"/>
    <?=bitrix_sessid_post() ?>
    <style type="text/css">
    <!--
    .form-table table input,.form-table table textarea{
        display: block;
        width: 100%;
        resize: none;
        box-sizing: border-box;
    }
    .prl15{
        padding: 0 15px !important;
    }
    tbody th {
        width: 190px;
        line-height: 25px;
        text-align: left !important;
        padding-left:15px !important;
    }
    tbody td{
        padding-right: 15px !important;
    }

    thead{
        line-height: 21px;
    }

    .addMoreCity, .addMoreItem {
        float: right;
        cursor: pointer;
    }
    .p0{
        padding: 0 !important;
    }
    .hr{
        display: none;
    }
    .cities-body+.cities-body .hr{
        display: table-row;
    }
    .next-body+.point-body{
        border-top: 1px solid #f5f9f9;
    }
    </style>
    <form>
    <table>
      <tr class="adm-list-table-row">
          <th class="adm-list-table-cell">
              <label for="site_description">Описание сайта:</label>
          </th>
          <td class="adm-list-table-cell">
              <textarea name="site_description" id="site_description"><?=stripslashes(htmlspecialchars($site_description))?></textarea>
          </td>
      </tr>
    </table>  
    <input type="submit">
    </form>  
</form>
<link href="/css/jquery-ui.min.css" type="text/css" rel="stylesheet">
<?
require($DOCUMENT_ROOT . "/bitrix/modules/main/include/epilog_admin.php"); ?>

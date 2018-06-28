<?

Class artfactor_seo extends CModule
{
var $MODULE_ID = "artfactor_seo";
var $MODULE_VERSION;
var $MODULE_VERSION_DATE;
var $MODULE_NAME;
var $MODULE_DESCRIPTION;
var $MODULE_CSS;

function artfactor_seo()
{
$arModuleVersion = array();

$path = str_replace("\\", "/", __FILE__);
$path = substr($path, 0, strlen($path) - strlen("/index.php"));
include($path."/version.php");

if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
{
$this->MODULE_VERSION = $arModuleVersion["VERSION"];
$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
}

$this->MODULE_NAME = "SEO штуки, используемые артфактором";
$this->MODULE_DESCRIPTION = "После установки вы сможете пользоваться модулем artfactor_seo";
}

function InstallFiles()
{
  CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/artfactor_seo/install/admin",
              $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin", true, true);
  return true;
}

function UnInstallFiles()
{
  DeleteDirFilesEx("/bitrix/admin/artfactor_seo_edit.php");
  return true;
}

function DoInstall()
{
  global $DOCUMENT_ROOT, $APPLICATION;
  $this->InstallFiles();
  RegisterModule("artfactor_seo");
  $APPLICATION->IncludeAdminFile("Установка модуля artfactor_seo ", $DOCUMENT_ROOT."/bitrix/modules/artfactor_seo/install/step.php");
}

function DoUninstall()
{
  global $DOCUMENT_ROOT, $APPLICATION;
  $this->UnInstallFiles();
  UnRegisterModule("artfactor_seo");
  $APPLICATION->IncludeAdminFile("Деинсталляция модуля artfactor_seo", $DOCUMENT_ROOT."/bitrix/modules/artfactor_seo/install/unstep.php");
}
}
?>
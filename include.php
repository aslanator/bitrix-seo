<?//Подключаем модуль инфоблоков 
if (\Bitrix\Main\Loader::includeModule('iblock'))
{ 
   //регистрируем обработчик события
   \Bitrix\Main\EventManager::getInstance()->addEventHandler(
      "iblock",
      "OnTemplateGetFunctionClass",
      array("ShowSiteName", "eventHandler")
   ); 

   \Bitrix\Main\EventManager::getInstance()->addEventHandler(
    "iblock",
    "OnTemplateGetFunctionClass",
    array("ShowSiteDescription", "eventHandler")
 ); 
   //подключаем файл с определением класса FunctionBase
   //это пока требуется т.к. класс не описан в правилах автозагрузки
   include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/iblock/lib/template/functions/fabric.php");
   class ShowSiteName extends \Bitrix\Iblock\Template\Functions\FunctionBase
   {
      //Обработчик события на вход получает имя требуемой функции
      //парсер её нашел в строке SEO
      public static function eventHandler($event)
      {
         $parameters = $event->getParameters();
         $functionName = $parameters[0];
         if ($functionName === "site_name")
         {
            //обработчик должен вернуть SUCCESS и имя класса
            //который будет отвечать за вычисления
            return new \Bitrix\Main\EventResult(
               \Bitrix\Main\EventResult::SUCCESS,
               "\\ShowSiteName"
            );
         }
      }
      //собственно функция выполняющая "магию"
      public function calculate($parameters)
      {
        $rsSites = CSite::GetByID(SITE_ID);
        $arSite = $rsSites->Fetch();
        return $arSite['NAME'];
      }
   }

   class ShowSiteDescription extends \Bitrix\Iblock\Template\Functions\FunctionBase
   {
      //Обработчик события на вход получает имя требуемой функции
      //парсер её нашел в строке SEO
      public static function eventHandler($event)
      {
         $parameters = $event->getParameters();
         $functionName = $parameters[0];
         if ($functionName === "site_description")
         {
            //обработчик должен вернуть SUCCESS и имя класса
            //который будет отвечать за вычисления
            return new \Bitrix\Main\EventResult(
               \Bitrix\Main\EventResult::SUCCESS,
               "\\ShowSiteDescription"
            );
         }
      }
      //собственно функция выполняющая "магию"
      public function calculate($parameters)
      {
        return COption::GetOptionString("main","site_description");
      }
   }
}
 ?>
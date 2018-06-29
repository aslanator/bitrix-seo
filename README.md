# bitrix-seo
Модуль для добавления различных недостающих битриксу вещей, нужных в seo

Модуль необходимо помещать в папку bitrix/modules/artfactor_seo/
Затем подключить модуль в init (CModule::IncludeModule("artfactor_seo"))

# Функции

## Шаблоны

### Имя сайта
{=site_name}
Меняется в настройка сайта

### Описание сайта
{=site_description} 
Меняется в настройках SEO (в самом низу в каталоге)

Эти шаблоны можно использовать и в pageProperty, но тогда вы должны выводить свойства в таком виде: 
```<title><?$APPLICATION->ShowTitle()?></title>
<meta name="keywords" content="<?$APPLICATION->ShowProperty("keywords")?>">
<meta name="description" content="<?$APPLICATION->ShowProperty("description")?>">```

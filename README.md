# Способ снижения нагрузки на сервер (cron), на площадках разработкиков

## Предисловие

:white_check_mark: Данный код не претендует на какой-либо научный прорыв. Не надо придираться к несоблюдению общепринятых стандартов разработки

:white_check_mark: В примере код и архитектура расположения класса упрощена для легкого понимания

## Возможности

:white_check_mark: Данный код снимает нагрузку с сервера (cron), когда разработчик не работает на площадке разработчика 

## Для работы нам понадобится

:white_check_mark: Зарегистрировать класс и вызвать его метод через событие в файле - /local/php_interface/init.php

:white_check_mark: Обернуть вывод агентов нашим проверочным методом запуска в файле - /local/php_interface/cron_events.php

:white_check_mark: У меня для примера крон дёргает этот файл - /local/php_interface/cron_events.php

# A way to reduce the load on the server (cron) at development sites

## Preface

:white_check_mark: This code does not claim to be any scientific breakthrough. No need to find fault with non-compliance with generally accepted development standards

:white_check_mark: In the example, the code and architecture of the class layout are simplified for easy understanding

## Possibilities

:white_check_mark: This code takes the load off the server (cron) when the developer is not working at the developer site

## For work we need

:white_check_mark: Register a class and call its method through an event in the file - /local/php_interface/init.php

:white_check_mark: Wrap the agents output with our check launch method in the file - /local/php_interface/cron_events.php

:white_check_mark: For example, my cron pulls this file - /local/php_interface/cron_events.php

1. Перед запуском скрипта index.php, необходимо указать путь для запроса ленты новостей в переменной $urlAllNews, 
и часть пути (без индекса) для одной новости в переменной $urlOneNews
2. При запуске скрипта index.php будут созданы и заполнены данными два файла:
файл новостей в формате id и title (путь указан в $filePathNews);
файл с блоками в формате  id, type, md5(content)(путь указан в $filePathBlock)
3. Чтобы не проводить проверку на запись данных по существующему в файлах индексу (дублирование), 
для функций getDataAllNews и getDataOneNews
в качестве $filePathNews и $filePathBlock указать пустые кавычки ''

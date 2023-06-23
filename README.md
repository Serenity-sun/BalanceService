## Проект для работы с балансами пользователей

### необходимые зависимости
1. `docker docker-compose make`

### Запуск проекта
1. `make run`
1. `make migrate`

### Описание и код возможных ошибок:

* `ошибка при добавлений баланса ` `1000`
* `ошибка при списаний баланса` `1001`
* `ошибка при переводе ` `1002`
* `недостаточно баланса ` `1003`
* `пользователь не существует ` `1004`
* `ошибка валидации ` `3`


#### Excange API и другие API для курса валют требуют подписку или очень ограниченный лимит.

#### Стэк:

* `php 8.2`
* `Yii 2`


#### Postman коллекция:

[![Run in Postman](https://run.pstmn.io/button.svg)](https://god.gw.postman.com/run-collection/15905625-7c90b71d-0e69-41e0-92c7-d612ce13104e?action=collection%2Ffork&source=rip_markdown&collection-url=entityId%3D15905625-7c90b71d-0e69-41e0-92c7-d612ce13104e%26entityType%3Dcollection%26workspaceId%3Df2402ce7-7a07-4685-8c72-a18ca5a07f94)

Если postman не работает, то можно воспользоваться с импортом файла `storage/*collection.json`
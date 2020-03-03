# BACK-END ERP AUTOPEÇAS

Primeiros passos
---

 - `git clone git_url`
 - `php artisan composer install`
 - `php artisan migrate`
 - `php artisan passport:install`
 - configurar o arquivo .env com as seguintes configurações:

     - MAIL_DRIVER=smtp
     - MAIL_HOST=smtp.mailtrap.io
     - MAIL_PORT=2525
     - MAIL_USERNAME=mailtrap_user
     - MAIL_PASSWORD=mailtrap_password
     - MAIL_FROM_ADDRESS=umemailqualquer@email.com
     - MAIL_FROM_NAME=UmNomeQualquer

Para testar as funcionalidades basta rodar o comando: `php artisan serve`
 
Para testar a api os headers que devem ser adicionados são so seguintes:

 - Content-Type: application/json
 - X-Requested-With: XMLHttpRequest
 - Authorization: Bearer token
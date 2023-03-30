## Projeto CRUD Liberfly
> Este é um projeto basico utilizando laravel 7, mysql , autenticação via JWT e swagger

### como executar
0. Faça o clone do projeto
1. para instalar as dependências, execute na pasta do projeto

> ```composer install```
2. crie a chave da sua aplicação com 
>```php artisan key:generate```

3. Crie a chave secreta que a autenticação JWT ira utilizar
>```php artisan jwt:secret  ```

4. prencha suas credencias de banco no arquivo .ENV

5. para criar as tabelas que serão utilizadas pela aplicação execute
>``` php artisan migrate ```

6. Para popular o banco com dados fake, execute
>```php artisan db:seed --class=UsersTableSeeder  ```

>```php artisan db:seed --class=ProblmeaAereoTableSeeder ```

6. Agora é so rodar a aplicação com o comando
>``` php artisan serve ```

#### documentação feitas com swagger disponovel no link:
> ```http://localhost:8000/api/documentation```

# PHP DUMP DATABASE

Simples Gerenciador de cópia de segurança e envio de banco de dados MySQL e MariaDB

## Utilização

Para utilizar este gerenciador basta seguir o exemplo abaixo:
```php
    <?php
        //Carregamento do autoload
        require 'vendor/autoload.php';
        
        //Dependência (uso de namespace)
        use HerminigildoSebastiao\Dump\Dump;

        //Instância da classe
        $dump = new Dump("nome_do_usuario_do_banco_de_dados", "senha_do_banco_de_dados", "nome_do_banco_de_dados", "nome_do_usuario_logado_no_servidor");
        
        //Execução do método de cópia de segurança
        $dump->database();
    ?>
```
### Requisitos
PHP7

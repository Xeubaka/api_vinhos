## Ambiente 💻
  - Servidor Local: [Xampp 8.0.3](https://www.apachefriends.org/pt_br/download.html)🔗

## RewriteEngine 🔧
   - abrir arquivo "HTTPD.conf" do Apache 
        ```
          C:\xampp\apache\conf\httpd.conf
        ```
   - descomentar a linha "LoadModule rewrite_module modules/mod_rewrite.so" (remover o '#')
   - Alterar "AllowOverride none" para "AllowOverride All"
   - reiniciar o Apache
   - para verificar se funcionou entrar com uma url aleatoria (ex: *http://localhost/api_vinhos/aaaa*)

## Banco de Dados 🏦
   - Para criar o Banco de dados basta importar o arquivo 
        ``` script_banco.sql ```

## Api 👾
   - GET (api_vinhos/vinhos/:id)
       - Retorna todos registros, caso informe o :id irá retornar o registro com esse :id
   - POST (api_vinhos/vinhos/cadastrar) [JSON]
       - Insere novos registros na tabela, necessário informar os campos:
            |Campo|Tipo|Exemplo|
            |:------:|:-----------:|:---------:|
            |name|Varchar(24)|Periquita|
            |type|Varchar(10)|Tinto|
            |weight|Decimal|1.200|
   - PUT (api_vinhos/vinhos/atualizar/id)
        - Atualiza registro, :id obrigatório
        - Atualiza somente os campos informados, não sendo necessário informar todos campos
   - DELETE (api_vinhos/vinhos/deletar/id)
        - Delete registro por :id
   - NO_EXIST 
        - Links que não tem função retornam: ``` { "tipo":"erro","resposta":"Recurso inexistente!" } ```

## Gratidão
![programando](https://i0.wp.com/terminaldeinformacao.com/wp-content/uploads/2020/05/it_crowd.gif?resize=500%2C272&ssl=1)

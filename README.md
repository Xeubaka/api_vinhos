## Ambiente
  - Servidor Local: [Xampp 8.0.3](https://www.apachefriends.org/pt_br/download.html)

## RewriteEngine
   - abrir arquivo "HTTPD.conf" do Apache 
        ```
          C:\xampp\apache\conf\httpd.conf
        ```
   - descomentar a linha "LoadModule rewrite_module modules/mod_rewrite.so" (remover o '#')
   - Alterar "AllowOverride none" para "AllowOverride All"
   - reiniciar o Apache
   - para verificar se funcionou entrar com uma url aleatoria (ex: *http://localhost/api/aaaa*)
    
   * A api tem um retorno em json de erro: 
        ```
        {"tipo":"erro","resposta":"Recurso inexistente!"}
        ```

## Banco de Dados
   - Para criar o Banco de dados basta importar o arquivo 
        ``` script_banco.sql ```

## Api :shipit:
Rotas:
    - GET [:id]
        - Retorna todos registros, caso informe o [:id] irá retornar o registro com esse [:id]
    - POST 
        - Insere novos registros na tabela, necessário informar os campos:
            |Campo|Tipo|Exemplo|
            |:------:|:-----------:|:---------:|
            |name|Varchar(24)|Piriquita|
            |type|Varchar(10)|Tinto|
            |weight|Decimal|1.200|
    - PUT
        - Atualiza registro, [:id] obrigatório
        - Atualiza somente os campos informados, não sendo necessário informar todos campos
    - DELETE
        - Delete registro por [:id]

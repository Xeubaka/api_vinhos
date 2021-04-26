## Ambiente 💻
  - Servidor Local: [Xampp 8.0.3](https://www.apachefriends.org/pt_br/download.html)🔗

## RewriteEngine 🔧
     
### Explicaçao
   - RewriteEngine, facilita a modelagem de URL’s, possibilitando gerenciar melhor as rotas da api (Config: .htaccess; Conceito: RequestValidator.php && RotasUtil.php)

### Configuração
   - abrir arquivo "HTTPD.conf" do Apache 
        ```
          C:\xampp\apache\conf\httpd.conf
        ```
   - descomentar a linha "LoadModule rewrite_module modules/mod_rewrite.so" (remover o '#')
   - Alterar "AllowOverride none" para "AllowOverride All"
   - reiniciar o Apache
   - para verificar se funcionou entrar com uma url aleatoria, deve retornar um JSON com mensagem: ``` { "tipo":"erro","resposta":"Recurso inexistente!" } ```

## Banco de Dados 🎲
   - Para criar o Banco de dados basta importar o arquivo 
        ``` script_banco.sql ```

## Api 👾
   - GET (api_vinhos/wines/list/:id)
       - Retorna todos registros, caso informe o :id irá retornar o registro com esse :id
   - POST (api_vinhos/wines/insert)
       - Insere novos registros na tabela, necessário informar todos os campos:
            |Campo|Tipo|Exemplo|
            |:------:|:-----------:|:---------:|
            |name|Varchar(24)|Periquita|
            |type|Varchar(10)|Tinto|
            |weight|Decimal|1.200|
       - Json:
          ```
         {
            "name": "Periquita",
            "type": "Tinto",
            "weight": 1.200
          }
          ```
   - PUT (api_vinhos/wines/update/id)
        - Atualiza registro, :id obrigatório
        - Atualiza somente os campos informados, não sendo necessário informar todos campos
   - DELETE (api_vinhos/wines/delete/id)
        - Deleta registro por :id
   - NO_EXIST 
        - Links que não tem função retornam: ``` { "tipo":"erro","resposta":"Recurso inexistente!" } ```

## Minha experiência com esse estudo

Desenvolver uma api em php, mesmo após certo tempo enferrujado com a linguagem, foi certamente uma experiência divertida, o que me fascina em programação é que não importa a linguagem, pois lógica sempre será uma constante, o divertido é ver como essa lógica é subvertida aos conceitos e parâmetros de cada linguagem, por fim, desenvolver não é sobre a linguagem utilizada, mas sim quais conceitos e parâmetros você se dispõe a utilizar.


## Gratidão fml 🙏
![programando](https://i0.wp.com/terminaldeinformacao.com/wp-content/uploads/2020/05/it_crowd.gif?resize=500%2C272&ssl=1)

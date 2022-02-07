## Ambiente 💻
  - Servidor Local: [Spring Boot 2.6.3](https://spring.io/projects/spring-boot)🔗
     
### Explicaçao
   - RewriteEngine, facilita a modelagem de URL’s, possibilitando gerenciar melhor as rotas da api (Config: .htaccess; Conceito: RequestValidator.php && RotasUtil.php)

### Configuração (Testado em ambiente Windows)
   - Baixar a branch
   - (para o proximo comando é necessário ter docker instalado e rodando)
   - Na pasta da api executar o comando ``` & .\mvnw.cmd clean package -f .\pom.xml ``` (irá gerar o executavel e criar a imagem docker da api)
   - Ao final da execução anterior basta executar ``` docker-compose up ```

## Banco de Dados 🎲
   - Optei pelo H2, que salva em memoria enquanto roda a aplicação.

## Api 👾
   - GET (localhost:8080/vehicles)
       - Retorna lista de todos registros de veiculos cadastrados.
   - GET (localhost:8080/vehicle/{id})
       - Retorna o veiculo referente ao id informado.
   - POST (localhost:8080/vehicle)
       - Insere um novo veiculo, necessário informar todos os campos:
            |Campo|Tipo|Exemplo|
            |:------:|:-----------:|:---------:|
            |name|String|Luis|
            |model|String|Palio|
            |dtFab|String|"01/01/2003"|
            |kmCity|Long|9|
            |kmRoad|Long|10|
       - Json:
          ```
         {
            "name": "Luis",
            "modedl": "Palio",
            "dtFab": "01/01/2003",
            "kmCity": 9,
            "kmRoad": 10
          }
          ```
   - PUT (localhost:8080/vehicle/{id})
        - Atualiza registro referente ao id.
        - Necessário informar todos os campos.
   - DELETE (localhost:8080/vehicle/{id})
        - Deleta registro por :id

## Minha experiência com esse estudo

Não cheguei a trabalhar com java ou spring boot a nivel profissional anteriormente, mas gostei bastante da facilidade e interatividade que a tecnologia proporciona, certamente estudarei mais sobre no futuro.

O que me fascina em programação é que não importa a linguagem, pois lógica sempre será uma constante, o divertido é ver como essa lógica se submete aos conceitos e parâmetros de cada linguagem, por fim, desenvolver não é sobre a linguagem utilizada, mas sim quais conceitos e parâmetros você se dispõe a utilizar.


## Gratidão fml 🙏
![programando](https://i0.wp.com/terminaldeinformacao.com/wp-content/uploads/2020/05/it_crowd.gif?resize=500%2C272&ssl=1)

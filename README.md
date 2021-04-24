Servidor Local:
    - Xampp 8.0.3 (https://www.apachefriends.org/pt_br/download.html)

Configuração RewriteEngine:
    - abrir arquivo "HTTPD.conf" do Apache
    - descomentar a linha "LoadModule rewrite_module modules/mod_rewrite.so"
    - Alterar "AllowOverride none" para "AllowOverride All"
    - reiniciar o Apache


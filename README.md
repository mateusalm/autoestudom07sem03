# autoestudom07sem03

Na pasta src, o código PHP WebServer.php inicia um servidor web com uma página HTML simples que realiza as operações de leitura e criação de dados salvos em um banco de dados. O servidor se conecta com o banco de dados através de usuário e senha, acessando o endpoint do RDS, as informações de acesso foram salvas no arquivo "dbinfo.inc". Primeiramente, verifica-se se existe uma tabela chamada "PRODUCTS" no banco de dados e, caso não exista, ela é criada. Em seguida os dados inputados no front (nome, preço e quantidade do produto) são adicionados ao banco no momento que o usuário aperta o botão "Add Product". Abaixo, existe uma tabela que lista os produtos salvos no banco. Todas as operações com o banco de dados seguem o padrão SQL.

AWS:
- EC2: instância rodando com servidor PHP
- RDS: banco de dados MySQL rodando, conectado à instância EC2

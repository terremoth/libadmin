# LibAdmin
Software de Gestão de Biblioteca Caseira.

## Setup
Vá na pasta da aplicação, esteja com o terminal aberto nela, então execute:

```bash
$ mysql -u <user> -p -e 'create database libadmin collate utf8mb4_unicode_ci;'
```

```bash
$ mysql -u <user> -p libadmin < db_libadmin.sql
```
Para criar a tabela de livros

### Using:
- PHP:
	-  MySQLi Driver
- JavaScript:
	- JQuery
	- Bootstrap
	- DataTables
	- jQuery Mask
- CSS:
	- Bootstrap

### To Do
- Mudar mysqli driver para PDO
- jQuery ajax API ao invés de xmlhttprequest
- Remover linhas da tabela pelo Datatables (mas ao que parece a api deles é bugada nisso com jquery) ao invés de js remove() puro
- Mudar tudo para inglês

📘 Documentação do Sistema AgendaDigital
1. Introdução

Este documento descreve o funcionamento, a arquitetura, os requisitos e a operação do Sistema AgendaDigital, desenvolvido em PHP, utilizando MySQL como banco de dados e Bootstrap 5 para a interface visual. O sistema tem como objetivo gerenciar dados de contatos e permitir o controle de usuários e permissões. A solução foi projetada para ser utilizada em ambiente local, com interface responsiva e modular. 🌐

2. Objetivo do Projeto
2.1 Objetivo Geral 🎯

Desenvolver um sistema de gestão de contatos simples e funcional, aplicando conceitos fundamentais de desenvolvimento web com PHP, MySQL e Bootstrap, com funcionalidades como login, cadastro de usuários e gerenciamento de contatos.

2.2 Objetivos Específicos 📝

Implementar a funcionalidade de login e controle de acesso.

Criar um módulo de cadastro, edição e exclusão de contatos.

Desenvolver uma área administrativa para o gerenciamento de usuários.

Demonstrar o uso de sessões e permissões para segurança e controle de acesso.

Entregar uma interface limpa, responsiva e fácil de usar.

3. Tecnologias Utilizadas 🛠️
Tecnologia	Finalidade
PHP 8+	Lógica de aplicação, rotas e CRUD.
MySQL / MariaDB	Armazenamento dos dados de usuários e contatos.
Bootstrap 5	Interface responsiva e estilização visual.
CSS personalizado	Ajustes visuais extras para melhorar a aparência.
XAMPP	Ambiente de execução local (Apache + MySQL).
4. Arquitetura do Sistema 🏗️

O sistema foi estruturado de forma modular e organizada. Abaixo, temos uma visão geral da estrutura do projeto:

AgendaDigital/
│-- index.php           # Tela de login
│-- register.php        # Cadastro de usuários
│-- home.php            # Painel principal
│-- add.php             # Cadastro de contato
│-- edit.php            # Edição de contato
│-- delete.php          # Exclusão de contato
│-- logout.php          # Finalização de sessão
│-- db.php              # Conexão com MySQL
│-- style.css           # Estilos personalizados
└── sql/
    └── banco.sql       # Script do banco de dados

5. Requisitos do Sistema 💡
5.1 Requisitos Funcionais ✔️

RF01 – O sistema deve permitir o login de usuários cadastrados.

RF02 – O sistema deve permitir cadastro de novos usuários.

RF03 – O usuário deve ser capaz de visualizar, adicionar, editar e excluir contatos.

RF04 – O sistema deve permitir que administradores gerenciem outros usuários.

RF05 – O sistema deve proteger áreas críticas, permitindo que apenas usuários autenticados acessem o painel.

RF06 – O último administrador não pode ser excluído do sistema.

5.2 Requisitos Não Funcionais ⚙️

RNF01 – A interface deve ser responsiva, utilizando Bootstrap.

RNF02 – O sistema deve ser executado em ambiente local (XAMPP).

RNF03 – O banco de dados deve ser protegido e com backup regular.

RNF04 – O tempo de resposta do sistema deve ser rápido, inferior a 2 segundos.

6. Banco de Dados 💾
6.1 Estrutura do Banco de Dados

O banco de dados crud_exemplo contém duas tabelas principais:

Tabela: usuarios
Campo	Tipo	Descrição
id	INT (PK, AI)	Identificador único
usuario	VARCHAR(50)	Nome do usuário (login)
senha	VARCHAR(255)	Senha criptografada
tipo	ENUM('admin','user')	Define o tipo de usuário
Tabela: contatos
Campo	Tipo	Descrição
id	INT (PK, AI)	Identificador único
nome	VARCHAR(100)	Nome do contato
email	VARCHAR(100)	E-mail do contato
telefone	VARCHAR(20)	Telefone do contato
7. Fluxo de Funcionamento 🔄
7.1 Fluxo de Login 🔑

O usuário acessa a página index.php.

O sistema valida o login no banco de dados.

Se válido, o usuário é redirecionado para o home.php.

Se inválido, o sistema exibe uma mensagem de erro.

7.2 Fluxo do CRUD de Contatos 🗂️

O usuário acessa o home.php após login.

Pode adicionar, editar ou excluir contatos.

As alterações são refletidas diretamente no banco de dados.

7.3 Fluxo Administrativo 👑

Administradores podem acessar uma área para gerenciar usuários.

Administradores podem promover ou rebaixar permissões de usuários.

O sistema impede a exclusão do último administrador.

8. Telas do Sistema 📱

(Se necessário, envie prints das telas do sistema para incluir nesta seção)

9. Segurança 🔐

O sistema utiliza sessões PHP para autenticação. As senhas são armazenadas de forma criptografada (MD5 para fins acadêmicos). O sistema impede a exclusão do último administrador e protege áreas sensíveis com verificações de permissão.

10. Instalação e Execução 🚀
10.1 Requisitos

PHP 8+

MySQL 5.7+

XAMPP / WAMP / LAMPP

Navegador moderno

10.2 Passos para Instalar e Executar

Baixe e instale o XAMPP aqui
.

Coloque os arquivos do projeto na pasta C:\xampp\htdocs\AgendaDigital\.

Importe o banco de dados utilizando o phpMyAdmin:

Acesse: http://localhost/phpmyadmin

Importe o arquivo banco.sql localizado na pasta /sql/.

Inicie o Apache e o MySQL no XAMPP.

Acesse o sistema no navegador: http://localhost/AgendaDigital/

10.3 Login Inicial

Usuário: admin

Senha: 123456

11. Conclusão 🎉

O Sistema AgendaDigital demonstrou a aplicação prática de conceitos importantes no desenvolvimento de sistemas web, como CRUD, autenticação, e gerenciamento de usuários. A solução é simples, eficaz e pode ser expandida para necessidades mais complexas no futuro. Este projeto contribuiu para a compreensão do uso integrado de PHP, MySQL e Bootstrap, além de práticas fundamentais de segurança e gerenciamento de dados.

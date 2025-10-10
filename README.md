# Cadastro e Listagem de Produtos ⭐

Projeto da disciplina Design Patterns & Clean Code que complementa um sistema já existente de cadastro e listagem de produtos em PHP puro, utilizando Composer e autoload PSR-4, sem banco de dados, armazenando os dados em um arquivo de texto.

Poliana Rodriguez - 2000444  

Eder Luiz - 1971959

---

## O sistema permite:  
- Cadastro de usuários com validação de dados (nome, e-mail e senha).  
- Listagem de usuários em uma tabela HTML simples (somente leitura).  
- Cadastro e listagem de produtos com nome e preço.  

#### Todas as funcionalidades respeitam SRP e separação de camadas:  
- **Infraestrutura:** leitura e escrita em arquivos de texto (`storage/`).  
- **Aplicação:** orquestração das operações sem formatação.  
- **Apresentação:** páginas públicas (`public/`) apenas exibem os dados.

---

## Listagem de Usuários

**URL:** `http://localhost/solid-srp-demo/public/users.php`  

**Método:** `GET`  

**Descrição:** Exibe uma lista de todos os usuários cadastrados no sistema em uma tabela HTML simples.  

**Expectativa de resultado:**
- Tabela com Nome e E-mail de cada usuário
- Caso não haja usuários, aparece a mensagem "Nenhum usuário cadastrado até o momento"

## Limitações conhecidas:
- Sem paginação: todos os usuários são exibidos de uma vez.  
- Sem ordenação: usuários listados na ordem de cadastro.  
- Sem filtros de busca por nome ou e-mail.  
- Retorno em HTML, não em JSON.

---

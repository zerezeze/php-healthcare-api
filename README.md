# API de Gerenciamento de Pacientes - Clínica Patológica

Este projeto implementa uma API RESTful simples para gerenciar pacientes de uma clínica patológica. A API permite realizar operações CRUD (Create, Read, Update, Delete) em registros de pacientes.

## Funcionalidades

- Listar todos os pacientes
- Buscar um paciente específico por ID
- Adicionar um novo paciente
- Atualizar informações de um paciente existente
- Excluir um paciente

## Tecnologias Utilizadas

- PHP
- JSON (para armazenamento de dados)

## Estrutura do Projeto

- `index.php`: Contém a lógica principal da API
- `pacientes.json`: Arquivo de armazenamento dos dados dos pacientes

## Configuração e Execução Local

### Pré-requisitos

- Servidor web com suporte a PHP (por exemplo, Apache)
- PHP 7.0 ou superior

### Passos para Execução

1. Clone este repositório para o diretório do seu servidor web local (por exemplo, `htdocs` para XAMPP).
2. Certifique-se de que o servidor web está em execução.
3. Acesse a API através do navegador ou de uma ferramenta como Postman.

## Uso da API

### Endpoints

- `GET /`: Lista todos os pacientes
- `GET /{id}`: Busca um paciente específico pelo ID
- `POST /`: Cria um novo paciente
- `PUT /{id}`: Atualiza um paciente existente
- `DELETE /{id}`: Exclui um paciente

### Exemplos de Requisições

#### Listar todos os pacientes
```
GET http://localhost/index.php/
```

#### Buscar um paciente específico (por exemplo, ID 1)
```
GET http://localhost/index.php/1
```

#### Criar um novo paciente
```
POST http://localhost/index.php/
Content-Type: application/json

{
  "nome": "Novo Paciente",
  "idade": 30,
  "historicoMedico": ["Alergia"],
  "condicoesAtuais": ["Rinite alérgica"]
}
```

#### Atualizar um paciente existente (por exemplo, ID 1)
```
PUT http://localhost/index.php/1
Content-Type: application/json

{
  "idade": 31,
  "condicoesAtuais": ["Rinite alérgica", "Asma leve"]
}
```

#### Excluir um paciente (por exemplo, ID 1)
```
DELETE http://localhost/index.php/1
```

## Notas Importantes

- Este projeto é uma implementação básica e não inclui medidas de segurança robustas. Não é recomendado para uso em ambiente de produção sem modificações adicionais.
- Certifique-se de que o arquivo `pacientes.json` tenha permissões de leitura e escrita para o usuário do servidor web.

## Contribuições

Contribuições para melhorar este projeto são bem-vindas. Por favor, sinta-se à vontade para fazer um fork do repositório e enviar pull requests.



## RPG-Builder

Sistema para criação de personagens RPG com atributos sorteados, cadastro, edição, poderes e inventário.

## Funcionalidades

- Cadastro e edição de personagens.
- Definição de nome, sobrenome, raça, classe, poderes e história.
- Atributos sorteados automaticamente (Força, Destreza, Constituição, Inteligência, Sabedoria, Carisma).
- Inventário e poderes.

## Tecnologias utilizadas

- Laravel 12
- PHP 8.2
- TailwindCSS
- Faker 

### Instalação e uso

1. Clone este repositório:
```
git clone https://github.com/Shinymonke69/Laravel_Projects/tree/Feature/RPG_Builder
```
2. Instale as dependências:
```
composer install
npm install
```
3. Rode as migrations:
```
php artisan migrate
```
5. Inicie o servidor local:
```
php artisan serve
npm run dev
```
## Documentação da API

Rotas disponíveis
```
GET /api/personagens
Retorna a lista de personagens.

POST /api/personagens
Cria um novo personagem.
Body exemplo:
{
"nome": "Gandalf",
"atributos": {
    "forca": 15,
    "destreza": 11,
    "constituicao": 14,
    /api/personagens/{id}
Retorna um personagem específico.

PUT /api/personagens/{id}
Atualiza um personagem.
Body exemplo:
{
"nome": "Gandalf, o Branco",
"atributos": { ... }
}

DELETE /api/personagens/{id}
Remove um personagem. "inteligencia": 18,
    "sabedoria": 17,
    "carisma": 16
}
}

GET 
```
Exemplo de consumo
- Com CURL:
```
curl -X POST http://localhost:8000/api/personagens \
  -H "Content-Type: application/json" \
  -d '{"nome":"Legolas","atributos":{"forca":12,"destreza":18,"constituicao":12,"inteligencia":14,"sabedoria":10,"carisma":13}}'
```
- Com Javascript (fetch):
```
fetch('/api/personagens', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({ nome: 'Aragorn', atributos: { ... } })
})
.then(res => res.json())
.then(data => console.log(data));
```
- Com Postman: Configure URL e método, escolha raw > JSON, e cole o exemplo do body acima.

## Como contribuir

- Faça um fork do projeto
- Crie uma branch nova feature/nomedafeature
- Envie um pull request descrevendo sua alteração

## Licença

Este projeto está licenciado sob a Licença MIT, veja mais detalhes no arquivo LICENSE.md.

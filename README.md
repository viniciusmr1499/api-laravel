# API REST

Essa aplicação é um serviço para a comunicação entre usuários (clientes) e agentes (atendentes) em tempo real.

## Instalação - Criando a imagem
### 1° Caso - Iniciando sessão
+ Ao receber uma mensagem do contato, o bot irá enviar uma requisição para o servidor. Quando o servidor receber essa mensagem, ele deve criar uma nova sessão (conversa), se ela não existir, e gravar a mensagem na sessão em atendimento e retornar uma mensagem para o contato contendo <strong>Reply: mensagem recebida</strong>

### 2° Caso - Consultando a sessão
+ É necessário criar uma rota para consultar as sessões que estão em atendimento no momento.
+ Também é possível realizar uma busca pelo nome do contato.

### 3° Caso - Finalizando a sessão
+ É importante fornecer uma rota para finalizar a sessão que está em atendimento, ao ser finalizado a sessão deve ser excluída do banco retornado uma mensagem informando o contato da finalização.

## Tecnologias | Libs | Frameworks | Databases
+ PHP
+ Lumen Framework
+ Docker
+ Redis
+ Mongo
+ Telegram-bot
### Iniciar Aplicação
```
  docker-compose up
  ou
  docker-compose up -d (em segundo plano)
```

### Criar migration de sessões
```
  php artisan migrate
  ps: Certifique-se de está na pasta "src" do projeto
```

### Encerrar aplicação
```
  docker-compose down
```

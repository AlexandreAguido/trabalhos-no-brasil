#Projeto Trabalhos no Brasil

Este projeto é um site busca de empregos fictício. As vagas são encontradas em
sites reais através [deste programa](https://github.com/AlexandreAguido/scrapperEmpregos)

Uma versão funcional está disponível no endereço https://trabalhos-no-brasil.herokuapp.com/

###Instruções para a execução local


instalar dependências

```
docker run --rm -it \
--volume $PWD/src:/app \
composer install
```

inserir as credencials da api do site [geonames.org](https://geonames.org) no arquivo src/.env

criar estrutura do banco de dados e popular com vagas

` docker exec app php artisan migrate:fresh --seed `


visite o endereço: [http://localhost:4000](http://localhost:4000)
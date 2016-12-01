# RecognizerLinkChallenge

Reconhecimento de Estruturas de Links.

## Desafio da Shopback

Imagine o cenário onde o cliente João nos fornece o XML de sua loja (www.lojadojoao.com). O XML contém todos os produtos disponíveis em seu site. Fazemos o processamento do XML, e cadastramos todos os produtos em nossa base. Esse processamento é feito todos os dias para atualizar os produtos.

Depois de termos os produtos em nossa base, passamos fazer o trackeamento das páginas através de uma tag javascript. Essa tag, nos envia sempre a página em que o usuário se encontra, e ao receber essa informação, nosso backend verifica se essa URL corresponde a um produto, para associarmos essa página vista ao ID do produto corretamente.

Tudo começa funcionar perfeitamente, e passamos a computar em média 1.000 páginas vistas, sendo aproximadamente 700 em páginas de produtos.

Após alguns dias vemos que a média de páginas vistas se mantém, porém o número de visitas em páginas de produtos cai drasticamente. Ao efetuar uma análise, fazemos a constatação de que os links dos produtos no XML possuem agora uma estrutura diferente dos links no site do cliente.

Agora temos um problema e precisamos de uma solução. Crie uma solução que detecte de forma dinâmica esse tipo de mudança entre as estruturas de links. Se conseguir uma solução que já resolva o problema automaticamente, é ainda melhor.

### XMLs para massa de testes

#### Explicando a estrutura do XML

```xml
<item>
  <id>Id ou SKU do Produto</id>
  <title>Nome do Produto</title>
  <price>Preço do Produto</price>
  <link>Link do produto que se encontra em nossa base</link>
</item>
```

#### Loja do João

```xml
<item>
  <id>16599221</id>
  <title>Produto de Teste 1</title>
  <price>100.00</price>
  <link>http://www.lojadojoao.com.br/p/16599221</link>
</item>
```

```
// Links visitados pelos clientes

http://www.lojadojoao.com.br/
http://www.lojadojoao.com.br/produto-de-teste-1-16599221
http://www.lojadojoao.com.br/categoria-teste
http://www.lojadojoao.com.br/search/helloword
http://www.lojadojoao.com.br/produto-de-teste-1-16599221?utm_teste=testando
```

#### Loja da Maria

```xml
<item>
  <id>12345</id>
  <title>Produto Legal</title>
  <price>230.00</price>
  <link>http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt/t/2/campanha_id/+752+</link>
</item>
```

```
// Links visitados pelos clientes

http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt?utm_source=ShopBack
http://www.lojadamaria.com.br/search/helloword
http://www.lojadamaria.com.br/categoria-legais
http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt
```

#### Loja do José

```xml
<item>
  <id>8595</id>
  <title>Produto Sem Nome</title>
  <price>140.00</price>
  <link>http://www.lojadoze.com.br/p/chapeu-caipira-de-palha-desfiado/campanha_id/34</link>
</item>
```

```
// Links visitados pelos clientes

http://www.lojadoze.com.br/chapeu-caipira-de-palha-desfiado
http://www.lojadoze.com.br/home
http://www.lojadoze.com.br/categoria-teste
http://www.lojadoze.com.br/chapeu-caipira-de-palha-desfiado?google
```

## Linguagem a ser adotada?
* Temos certa preferência à PHP, pois é nossa linguagem mais usada no momento, mas o que queremos entender é somente a SUA lógica de programação para resolução do desafio, a linguagem é somente uma ferramenta, nós queremos acima de tudo a pessoa.

## Deve conter

* Reconhecedor de links de produtos de acordo com o XML da loja e os links de requests informados.

## Dúvidas?
* Só criar uma issue.

## Ganha + pontos se conter

* For completamente automático.
* Funcionar sem intervenção humana em mais de 95% dos casos.
* Conter testes unitários.

## Processo de submissão

O candidato deverá implementar a solução e enviar um pull request para este repositório com a solução.

O processo de Pull Request funciona da seguinte maneira:

1. Candidato fará um fork deste repositório (não irá clonar direto).
2. Fará seu projeto nesse novo fork.
3. Commitará e subirá as alterações para o SEU fork.
4. E, pela interface do GitHub, irá enviar um pull request.

## ATENÇÃO

Não se deve tentar fazer o PUSH diretamente para o branch MASTER!!!



## BERTONI
Foi utilizado o framework symfony como base
Os códigos estão em src/LinkChallengeBundle
Para rodar os testes: "./vendor/phpunit/phpunit/phpunit src/LinkChallengeBundle/Tests/Helper/"

---
title: Documentação SDK

language_tabs:
  - php

toc_footers:
  - <a href='https://moip.com.br/docs/'>Documentação da API</a>
  - <a href='https://moip.com.br/forum'>Fórum</a>
  - <a href='https://desenvolvedor.moip.com.br/sandbox/cadastro/integracao/3434373731333435353133353330393639'>Cadastro Sandbox</a>

includes:

search: true
---

# Moip\Moip

O participante `Moip\Moip` é o ponto de entrada do SDK. É um Façade que além de permitir um ponto central de configuração, ainda permite o acesso aos outros participantes.

```php
<?php
require 'vendor/autoload.php';

use Moip\Moip;
use Moip\MoipBasicAuth;

$token = '0ERVDN386WE3RZRI4YYG6QCDLMJ57LBR';
$key = 'SRZGHRXYOT0PVDLRB3YE8XQWLNLA0JRXTKOIDVDQ';

$auth = new MoipBasicAuth($token, $key);
$moip = new Moip($auth);
```

> Você pode configurar o ambiente que vai utilizar através do segundo parâmetro do construtor.

```php
<?php
require 'vendor/autoload.php';

use Moip\Moip;
use Moip\MoipBasicAuth;

$token = '0ERVDN386WE3RZRI4YYG6QCDLMJ57LBR';
$key = 'SRZGHRXYOT0PVDLRB3YE8XQWLNLA0JRXTKOIDVDQ';

$auth = new MoipBasicAuth($token, $key);
$moip = new Moip($auth, Moip::SANDBOX_ENDPOINT);
```

<aside class="notice">Por padrão, é utilizado o ambiente de produção caso nenhum ambiente seja especificado.</aside>

| Retorno | Método  | Descrição |
| ------------ |---------------| ------------- |
|`Moip\Resource\Customer` | `customers()` | Cria uma nova instância do objeto `Customer`. |
|`Moip\Resource\Entry` | `entries()` | Cria uma nova instância do objeto `Entry`. |
|`Moip\Resource\Orders` | `orders()` | Cria uma nova instância do objeto `Orders`. |
|`Moip\Resource\Payment` | `payments()` | Cria uma nova instância do objeto `Payment`. |
|`Moip\Resource\Multiorders` | `multiorders()` | Cria uma nova instância do objeto `Multiorders`. |

# Moip\Resource\Orders

Um Pagamento é representado, criado ou consultado através do participante `self`. A tabela abaixo descreve sua interface e parâmetros:

> O SDK possui uma interface fluente, que permite que seus métodos sejam encadeados segundo seu contexto.

```php
<?php
require 'vendor/autoload.php';

use Moip\Moip;
use Moip\MoipBasicAuth;

$endpoint = 'private-31ec8-moip.apiary-mock.com';
$token = '0ERVDN386WE3RZRI4YYG6QCDLMJ57LBR';
$key = 'SRZGHRXYOT0PVDLRB3YE8XQWLNLA0JRXTKOIDVDQ';

$moip = new Moip(new MoipBasicAuth($token, $key), $endpoint);

$order = $moip->orders()->setOwnId('sandbox_v2_1401147277')
                        ->addItem('Pedido de testes Sandbox - 1401147277', 1, 'Mais info...', 10000)
                        ->setShippingAmount(100)
                        ->setCustomer($moip->customers()->setOwnId('sandbox_v2_1401147277')
                                                        ->setFullname('Jose Silva')
                                                        ->setEmail('sandbox_v2_1401147277@email.com')
                                                        ->setBirthDate('1988-12-30')
                                                        ->setTaxDocument('33333333333')
                                                        ->setPhone(11, 66778899)
                                                        ->addAddress('BILLING',
                                                                     'Avenida Faria Lima', 2927,
                                                                     'Itaim', 'Sao Paulo', 'SP',
                                                                     '01234000', 8))
                        ->create();
```

| Retorno | Método  | Descrição |
| ------------ |---------------| ------------- |
| `self` | `addItem($product, $quantity, $detail, $price)` | Adiciona um produto ao pedido |
| `self` | `addReceiver($moipAccount, $type = 'PRIMARY')` | Adiciona um recebedor. Por padrão, um recebedor primário |
| `Moip\Resource\Orders` | `create()` | Cria um pedido |
| `self` | `get($id)` | Obtém um pedido através de seu identificador |
| `string` | `getId()` | Getter para obtenção do ID do pedido |
| `string` | `getOwnId()` | Getter para obtenção do ID próprio do pedido |
| `float` | `getAmountTotal()` | Getter para obtenção do valor total do pedido |
| `float` | `getAmountFees()` | Getter para obtenção do valor das taxas do pedido |
| `float` | `getAmountRefunds()` | Getter para obtenção do valor total de reembolsos do pedido |
| `float` | `getAmountLiquid()` | Getter para obtenção do valor líquido do pedido |
| `float` | `getAmountOtherReceivers()` | Getter para obtenção do valor de outros recebedores |
| `string` | `getCurrenty()` | Getter para obtenção da moeda utilizada no pedido |
| `float` | `getSubtotalShipping()` | Getter para obtenção do subtotal relacionado com despesas de entrega |
| `float` | `getSubtotalAddition()` | Getter para obtenção do valor adicional do item |
| `float` | `getSubtotalDiscount()` | Getter para obtenção do valor do desconto |
| `float` | `getSubtotalItems()` | Getter para obtenção do valor dos itens 
| `\Iterator` | `getItemIterator()` | Obtém um iterator para percorrer os itens |
| `Moip\Resource\Customer` | `getCustomer()` | Obtém o cliente relacionado com o pedido |
| `\Iterator` | `getPaymentIterator()` | Obtém um iterator para percorrer os pagamentos relacionados com o pedido |
| `\Iterator` | `getReceiverIterator()` | Obtém um iterator para percorrer os recebedores relacionados com o pedido |
| `\Iterator` | `getEventIterator()` | Obtém um iterator para percorrer os eventos relacionados com o pedido |
| `\Iterator` | `getRefundIterator()` | Obtém um iterator para percorrer os reembolsos relacionados com o pedido |
| `string` | `getStatus()` | Getter para obtenção do status do pedido |
| `string` | `getCreatedAt()` | Getter para obtenção da data de criação do pedido |
| `string` | `getUpdatedAt()` | Getter para obtenção da data de atualização do pedido |
| `object` | `getLinks()` | Getter para obtenção dos links de relacionamento com outros recursos da API |
| `Moip\Resource\Payment` | `payments()` | Método de acesso/criação de uma instância de `Payment` já configurada para esse pedido |
| `Moip\Resource\Refund` | `refunds()` | Método de acesso/criação de uma instância de `Refund` já configurada para esse pedido |
| `self` | `setAddition($value)` | Setter para definição do valor adicional |
| `self` | `setCustomer(Customer $customer)` | Setter para definição do cliente do pedido |
| `self` | `setDiscont($value)` | Setter para definição do desconto do pedido |
| `self` | `setOwnId($ownId)` | Setter para definição do id próprio do pedido |
| `self` | `setShippingAmount($value)` | Setter para definição do valor das despesas de entrega |

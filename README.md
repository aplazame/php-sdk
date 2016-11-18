# Aplazame PHP SDK

[![Aplazame](docs/banner-728-white-php.png)](https://aplazame.com)

[Aplazame](https://aplazame.com), a consumer credit company, offers a payment system that can be
used by online buyers to receive funding for their purchases.


## Installation

You can use [Composer](https://getcomposer.org):

```bash
composer require aplazame/aplazame-api-sdk
```


## Usage


### Checkout

This SDK provides a tree of objects for guide you about to craft the checkout model.

```php
/*
 * Merchant model
 */
$merchant = new Aplazame\BusinessModel\Merchant(
    "/confirm", // url that the JS client sent to confirming the order.
    "/cancel",  // url that the customer is sent to if there is an error in the checkout.
    "/success"  // url that the customer is sent to after confirming their order.
);
$merchant->checkout_url = "/checkout"; // url that the customer is sent to if the customer chooses to back to the e-commerce, by default is /.


/*
 * Article model
 */
$article = new Aplazame\BusinessModel\Article(
    "89793238462643383279",                            // The article ID.
    "Reloj en oro blanco de 18 quilates y diamantes",  // Article name.
    "http://shop.example.com/product.html",            // Article url.
    "http://shop.example.com/product_image.png",       // Article image url.
    2,                                                 // Article quantity.
    Aplazame\BusinessModel\Decimal::fromFloat(4020.00) // Article price (tax is not included). (4,020.00 €)
);
$article->description = "Movimiento de cuarzo de alta precisión";          // Article description.
$article->tax_rate = Aplazame\BusinessModel\Decimal::fromFloat(21.00);     // Article tax rate. (21.00%)
$article->discount = Aplazame\BusinessModel\Decimal::fromFloat(5.00);      // The discount amount of the article. (5.00 €)
$article->discount_rate = Aplazame\BusinessModel\Decimal::fromFloat(2.00); // The rate discount of the article. (2.00 %)

// ... rest of articles in the shopping cart.

/*
 * Articles collection
 */
$articles = array( $article, ... );


/*
 * Order model
 */
$order = new Aplazame\BusinessModel\Order(
    "28475648233786783165",                             // Your order ID.
    "EUR",                                              // Currency code of the order.
    Aplazame\BusinessModel\Decimal::fromFloat(21.00),   // Order tax rate. (21.00%)
    Aplazame\BusinessModel\Decimal::fromFloat(4620.00), // Order total amount. (4,620.00 €)
    $articles                                           // Articles in cart.
);
$order->discount = Aplazame\BusinessModel\Decimal::fromFloat(160.00);         // The discount amount of the order. (160.00 €)
$order->discount_rate = Aplazame\BusinessModel\Decimal::fromFloat(2.00);      // The rate discount of the order. (2.00 %)
$order->cart_discount = Aplazame\BusinessModel\Decimal::fromFloat(0.50);      // The discount amount of the cart. (0.50 €)
$order->cart_discount_rate = Aplazame\BusinessModel\Decimal::fromFloat(3.00); // The rate discount of the cart. (3.00 %)

/*
 * Customer address model
 */
$customerAddress = new Aplazame\BusinessModel\Address(
    "John",                 // Address first name.
    "Coltrane",             // Address last name.
    "Plaza del Angel nº10", // Address street.
    "Madrid",               // Address city.
    "Madrid",               // Address state.
    "ES",                   // Address country code.
    "28012"                 // Address postcode.
);
$customerAddress->phone = "616123456";                              // Address phone number.
$customerAddress->alt_phone = "+34917909930";                       // Address alternative phone.
$customerAddress->address_addition = "Cerca de la plaza Santa Ana"; // Address addition.

/*
 * Customer model
 */
$customer = new Aplazame\BusinessModel\Customer(
    "1618",                                          // Customer ID.
    "dev@aplazame.com",                              // The customer email.
    Aplazame\BusinessModel\Customer::TYPE_EXISTING,  // Customer type. Other options are: TYPE_GUEST and TYPE_NEW.
    Aplazame\BusinessModel\Customer::GENDER_UNKNOWN, // Customer gender. Other options are: GENDER_MALE, GENDER_FEMALE and GENDER_NOT_APPLICABLE.
);
$customer->first_name = "John";                                                                     // Customer first name.
$customer->last_name = "Coltrane";                                                                  // Customer last name.
$customer->birthday = DateTime::createFromFormat(DateTime::ISO8601, "1990-08-21T13:56:45+0000");    // Customer birthday.
$customer->language = "es";                                                                         // Customer language preferences.
$customer->date_joined = DateTime::createFromFormat(DateTime::ISO8601, "2014-08-21T13:56:45+0000"); // A datetime designating when the customer account was created.
$customer->last_login = DateTime::createFromFormat(DateTime::ISO8601, "2014-08-27T19:57:56+0000");  // A datetime of the customer last login.
$customer->address = $customerAddress;                                                              // Customer address.


/*
 * Billing address model
 */
$billingBilling = new Aplazame\BusinessModel\Address(
   "Bill",                    // Billing first name.
   "Evans",                   // Billing last name.
   "Calle de Las Huertas 22", // Billing street.
   "Madrid",                  // Billing city.
   "Madrid",                  // Billing state.
   "ES",                      // Billing country code.
   "28014"                    // Billing postcode.
);
$billingAddress->phone = "+34914298407";                     // Billing phone number.
$billingAddress->alt_phone = null;                           // Billing alternative phone.
$billingAddress->address_addition =  "Cerca de la pizzería"; // Billing address addition.


/*
 * Shipping info model
 */
$shippingInfo = new Aplazame\BusinessModel\Address(
   "Django",                                        // Shipping first name.
   "Reinhard",                                      // Shipping last name.
   "Plaza del Angel nº10",                          // Shipping street.
   "Madrid",                                        // Shipping city.
   "Madrid",                                        // Shipping state.
   "ES",                                            // Shipping country code.
   "28012",                                         // Shipping postcode.
   "Planet Express",                                // Shipping name.
   Aplazame\BusinessModel\Decimal::fromFloat(5.00), // Shipping price (tax is not included). (5.00 €)
);
$shippingInfo->phone = "616123456";                                             // Shipping phone number.
$shippingInfo->alt_phone = "+34917909930";                                      // Shipping alternative phone.
$shippingInfo->address_addition = "Cerca de la plaza Santa Ana";                // Shipping address addition.
$shippingInfo->tax_rate = Aplazame\BusinessModel\Decimal::fromFloat(21.00);     // Shipping tax rate. (21.00%)
$shippingInfo->discount = Aplazame\BusinessModel\Decimal::fromFloat(1.00);      // The discount amount of the shipping. (1.00 €)
$shippingInfo->discount_rate = Aplazame\BusinessModel\Decimal::fromFloat(2.00); // The rate discount of the shipping. (2.00 %)


/*
 * Checkout model
 */
$checkout = new Aplazame\BusinessModel\Checkout(
    true,      // TOC
    $merchant,
    $order,
    $customer
);
$checkout->billing = $billingAddress;
$checkout->shipping = $shippingInfo;
```

In your view you will need to put an snippet similar to this one.
```html
<script>
  aplazame.checkout( <?php echo $checkout->jsonSerialize(); ?> );
</script>
```

### API Calls

This SDK assist you for craft a well formatted API request and decode the response back to PHP.

```php
$apiBaseUri = 'https://api.aplazame.com';
$environment = Aplazame\Api\Client::ENVIRONMENT_SANDBOX; // When you are ready use Aplazame\Api\Client::ENVIRONMENT_PRODUCTION
$accessToken = 'api private key';

$aplazameApiClient = new Aplazame\Api\Client($apiBaseUri, $environment, $accessToken);
try {
    $result = $aplazameApiClient->get('/me');
} catch (Aplazame\Api\ApiCommunicationException $apiCommunicationException) {
    // A network error has occurred while sending the request or receiving the response.

    // Retry
} catch (Aplazame\Api\DeserializeException $deserializationException) {
    // Nobody knows when this happen, may an HTTP Proxy on our side or on your side started to return HTML responses with errors.

    // Retry
} catch (Aplazame\Api\ApiServerException $apiServerException) {
    // Our server has crashed. We promise to fix it ASAP.

    echo 'Error type', $apiServerException->getType(), PHP_EOL;
    echo 'Error message', $apiServerException->getMessage(), PHP_EOL;

    $rawErrorWithErrorDetails = $apiServerException->getError();

} catch (Aplazame\Api\ApiClientException $apiClientException) {
    // Your client has sent an invalid request. Please check your code.

    echo 'Error type', $apiClientException->getType(), PHP_EOL;
    echo 'Error message', $apiClientException->getMessage(), PHP_EOL;

    $rawErrorWithErrorDetails = $apiClientException->getError();
}
print_r($result);
```


## Documentation

Documentation is available at http://docs.aplazame.com.

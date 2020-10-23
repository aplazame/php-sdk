<?php

/*
 * This file provides an example about how to complete the step 01 of Aplazame's
 *  integration as described in:
 * https://aplazame.com/integraciones/api/
 *
 * It contains three steps:
 *
 *  1. Create an Aplazame\Api\Client with your Aplazame API credentials
 *  2. Create the checkout payload.
 *  3. Send the payload to Aplazame and retrieve the generated ID by Aplazame.
 */

/*
 * Aplazame's private key.
 * You can find your keys on your Aplazame's control panel (https://vendors.aplazame.com/)
 */
$privateKey = '<aplazame private API key>';

/*
 * Enable test mode (`Aplazame\Api\Client::ENVIRONMENT_SANDBOX`) or
 *  production mode (`Aplazame\Api\Client::ENVIRONMENT_PRODUCTION`)
 */
$environment = Aplazame\Api\Client::ENVIRONMENT_SANDBOX;

/*
 * Aplazame Client setup
 */
$apiBaseUri = 'https://api.aplazame.com';
$aplazameApiClient = new Aplazame\Api\Client($apiBaseUri, $environment, $privateKey);


/**
 * Create checkout payload as described in https://aplazame.com/integraciones/api/checkout-creation/
 *
 * @return object
 */
function createCheckoutPayload() {
    /*
     * Merchant model
     */
    $merchant = new stdClass();
    $merchant->notification_url = 'https://merchant.com/order/step3_checkout_confirm.php'; // url where you will receive Aplazame webhook events as described in https://aplazame.com/en/docs/api/confirm-api/#implement-the-confirmation-endpoint
    $merchant->success_url = "/success";                                                   // url that the customer is sent to after confirming their order.
    $merchant->pending_url = "/pending";                                                   // url that the customer is sent to if the order status is pending.
    $merchant->error_url = "/error";                                                       // url that the customer is sent to if there is an error in the checkout.
    $merchant->dismiss_url = "/checkout";                                                  // url that the customer is sent to if the customer chooses to back to the e-commerce, by default is /.
    $merchant->ko_url = "/ko";                                                             // url that the customer is sent to if Aplazame refuses the order.

    /*
     * Article model
     */
    $article = new stdClass();
    $article->id = '89793238462643383279';                                  // The article ID.
    $article->name = 'Reloj en oro blanco de 18 quilates y diamantes';      // Article name.
    $article->url = 'http://shop.example.com/product.html';                 // Article url.
    $article->image_url = 'http://shop.example.com/product_image.png';      // Article image url.
    $article->quantity = 2;                                                 // Article quantity.
    $article->price = Aplazame\Serializer\Decimal::fromFloat(4020.00);      // Article price (tax is not included). (4,020.00 €)
    $article->description = 'Movimiento de cuarzo de alta precisión';       // Article description.
    $article->tax_rate = Aplazame\Serializer\Decimal::fromFloat(21.00);     // Article tax rate. (21.00%)
    $article->discount = Aplazame\Serializer\Decimal::fromFloat(5.00);      // The discount amount of the article. (5.00 €)

    // ... rest of articles in the shopping cart.

    /*
     * Articles collection
     */
    $articles = array( $article, );

    /*
     * Order model
     */
    $order = new stdClass();
    $order->id = '28475648233786783165';                                       // Your order ID.
    $order->currency = 'EUR';                                                  // Currency code of the order.
    $order->tax_rate = Aplazame\Serializer\Decimal::fromFloat(21.00);          // Order tax rate. (21.00%)
    $order->total_amount = Aplazame\Serializer\Decimal::fromFloat(4620.00);    // Order total amount. (4,620.00 €)
    $order->articles = $articles;                                              // Articles in cart.
    $order->discount = Aplazame\Serializer\Decimal::fromFloat(160.00);         // The discount amount of the order. (160.00 €)
    $order->cart_discount = Aplazame\Serializer\Decimal::fromFloat(0.50);      // The discount amount of the cart. (0.50 €)

    /*
     * Customer address model
     */
    $customerAddress = new stdClass();
    $customerAddress->first_name = 'John';                                       // Address first name.
    $customerAddress->last_name = 'Coltrane';                                    // Address last name.
    $customerAddress->street = 'Plaza del Valle Boreal nº10';                    // Address street.
    $customerAddress->city = 'Madrid';                                           // Address city.
    $customerAddress->state = 'Madrid';                                          // Address state.
    $customerAddress->country = 'ES';                                            // Address country code.
    $customerAddress->postcode = '28080';                                        // Address postcode.
    $customerAddress->phone = '601234567';                                       // Address phone number.
    $customerAddress->address_addition = 'Cerca de la plaza Pontífice Sulyvahn'; // Address addition.

    /*
     * Customer model
     */
    $customer = new stdClass();
    $customer->id = '1618';                                                                               // Customer ID.
    $customer->email = 'customer@address.com';                                                            // The customer email.
    $customer->type = 'e';                                                                                // Customer type, the choices are g:guest, n:new, e:existing.
    $customer->gender = 0;                                                                                // Customer gender, the choices are 0: not known, 1: male, 2:female, 3: not applicable.
    $customer->first_name = 'John';                                                                       // Customer first name.
    $customer->last_name = 'Coltrane';                                                                    // Customer last name.
    $customer->birthday = Aplazame\Serializer\Date::fromDateTime(new DateTime('1990-08-21 13:56:45'));    // Customer birthday.
    $customer->language = 'es';                                                                           // Customer language preferences.
    $customer->date_joined = Aplazame\Serializer\Date::fromDateTime(new DateTime('2014-08-21 13:56:45')); // A datetime designating when the customer account was created.
    $customer->last_login = Aplazame\Serializer\Date::fromDateTime(new DateTime('2020-08-27 19:57:56'));  // A datetime of the customer last login.
    $customer->address = $customerAddress;                                                                // Customer address.

    /*
     * Billing address model
     */
    $billingAddress = new stdClass();
    $billingAddress->first_name = 'Bill';                         // Billing first name.
    $billingAddress->last_name = 'Evans';                         // Billing last name.
    $billingAddress->street = 'Calle Central Yharnam 92';         // Billing street.
    $billingAddress->city = 'Madrid';                             // Billing city.
    $billingAddress->state = 'Madrid';                            // Billing state.
    $billingAddress->country = 'ES';                              // Billing country code.
    $billingAddress->postcode = '28080';                          // Billing postcode.
    $billingAddress->phone = '601765432';                         // Billing phone number.
    $billingAddress->address_addition =  'Cerca del Gran Puente'; // Billing address addition.

    /*
     * Shipping info model
     */
    $shippingInfo = new stdClass();
    $shippingInfo->first_name = 'Django';                                        // Shipping first name.
    $shippingInfo->last_name = 'Reinhard';                                       // Shipping last name.
    $shippingInfo->street = 'Plaza del Valle Boreal nº10';                       // Shipping street.
    $shippingInfo->city = 'Madrid';                                              // Shipping city.
    $shippingInfo->state = 'Madrid';                                             // Shipping state.
    $shippingInfo->country = 'ES';                                               // Shipping country code.
    $shippingInfo->postcode = '28080';                                           // Shipping postcode.
    $shippingInfo->name = 'Planet Express';                                      // Shipping name.
    $shippingInfo->price = Aplazame\Serializer\Decimal::fromFloat(5.00);         // Shipping price (tax is not included). (5.00 €)
    $shippingInfo->phone = '601234567';                                          // Shipping phone number.
    $shippingInfo->address_addition = 'Cerca de la plaza Pontífice Sulyvahn';    // Shipping address addition.
    $shippingInfo->tax_rate = Aplazame\Serializer\Decimal::fromFloat(21.00);     // Shipping tax rate. (21.00%)
    $shippingInfo->discount = Aplazame\Serializer\Decimal::fromFloat(1.00);      // The discount amount of the shipping. (1.00 €)

    /*
     * Checkout model
     */
    $checkout = new stdClass();
    $checkout->toc = true;
    $checkout->merchant = $merchant;
    $checkout->order = $order;
    $checkout->customer = $customer;
    $checkout->billing = $billingAddress;
    $checkout->shipping = $shippingInfo;

    return $checkout;
}

/**
 * Send the checkout payload generated by createCheckoutPayload to Aplazame and returns the Aplazame Checkout ID
 *
 * @param \Aplazame\Api\Client $aplazameApiClient A configured client with the api key and environment
 * @param array|object $payload Checkout Parameters as described in https://aplazame.com/integraciones/api/checkout-creation/
 *
 * @return string Aplazame checkout ID
 *
 * @throws \Aplazame\Api\ApiClientException Payload contains invalid data
 * @throws \Aplazame\Api\ApiServerException An error has occur on Aplazame's servers
 * @throws \Aplazame\Api\ApiCommunicationException A network error has occurred while sending the request or receiving the response.
 * @throws \Aplazame\Api\DeserializeException Deserialization exception (unusual to happen but it could)
 */
function createAplazameCheckout(Aplazame\Api\Client $aplazameApiClient, $payload)
{
    try {
        return $aplazameApiClient->post('/checkout', $payload)['id'];
    } catch (Aplazame\Api\ApiCommunicationException $apiCommunicationException) {
        // A network error has occurred while sending the request or receiving the response.

        // Retry
        throw $apiCommunicationException;
    } catch (Aplazame\Api\DeserializeException $deserializationException) {
        // Nobody knows when this happen, may an HTTP Proxy on our side or on your side started to return HTML responses with errors.

        // Retry
        throw $deserializationException;
    } catch (Aplazame\Api\ApiServerException $apiServerException) {
        // Our server has crashed. We promise to fix it ASAP.

        echo 'HTTP Status code', $apiServerException->getHttpStatusCode(), PHP_EOL;
        echo 'Error type', $apiServerException->getType(), PHP_EOL;
        echo 'Error message', $apiServerException->getMessage(), PHP_EOL;

        $rawErrorWithErrorDetails = $apiServerException->getError();

        throw $apiServerException;
    } catch (Aplazame\Api\ApiClientException $apiClientException) {
        // Your client has sent an invalid request. Please check your code.

        echo 'HTTP Status code', $apiClientException->getHttpStatusCode(), PHP_EOL;
        echo 'Error type', $apiClientException->getType(), PHP_EOL;
        echo 'Error message', $apiClientException->getMessage(), PHP_EOL;

        $rawErrorWithErrorDetails = $apiClientException->getError();

        throw $apiClientException;
    }
}

$aplazameCheckoutId = createAplazameCheckout($aplazameApiClient, createCheckoutPayload());

echo 'Aplazame Checkout ID: ', $aplazameCheckoutId;

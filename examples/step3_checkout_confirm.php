<?php

/*
 * This file provides an example about how to complete the step 03 of Aplazame's integration as described in:
 * - https://aplazame.dev/en/docs/api/checkout-process/
 * - https://aplazame.dev/docs/api/checkout-process/
 *
 * This file is split in two main sections:
 *
 * A. Basic settings:
 *
 *  - Aplazame's private key
 *  - Test mode
 *  - Failed callback
 *  - Accepted callback
 *  - Pending callback. Please read the notes of this callback and check if some scenario may apply to your integration.
 *
 * B. Aplazame's checkout checks and confirmation logic.
 */

/*
 * Aplazame's private key.
 * You can find your keys on your Aplazame's control panel (https://vendors.aplazame.com/)
 */
$privateKey = "<aplazame private API key>";

/*
 * Enable test mode (`Aplazame\Api\Client::ENVIRONMENT_SANDBOX`) or
 *  production mode (`Aplazame\Api\Client::ENVIRONMENT_PRODUCTION`)
 */
$environment = Aplazame\Api\Client::ENVIRONMENT_SANDBOX;

/**
 * Aplazame's payment has been REJECTED by Aplazame.
 *
 * Apply here your own logic to reject the order and return cart items to the inventory stock.
 *
 * @param string $order_id This is the same value as you filled in `order.id` when the checkout was created.
 *
 * @return bool `true` is the regular value. You can return `false` if something strange has happen, anyway for Aplazame
 * the order is already declined.
 */
function setOrderPaymentStatusFailed($order_id)
{
    throw new BadMethodCallException(
        'You have to customize this function with your own logic when the payment is declined'
    );


    return true;
}

/**
 * Aplazame's payment has been ACCEPTED by Aplazame but we need your system to confirm the order.
 *
 * Apply here your own logic to set the order as paid and then proceed with the delivery of the order items.
 *
 * @param string $order_id This is the same value as you filled in `order.id` when the checkout was created.
 *
 * @return bool `true` is the regular value. You can return `false` if you don't want to proceed with this order.
 */
function setOrderPaymentStatusAsPaid($order_id)
{
    throw new BadMethodCallException(
        'You have to customize this function with your own logic when the payment is accepted'
    );

    /*
     * Most shops always return "true" here but some scenarios may apply to your checkout process:
     *
     * - Cart item has been sold to a different customer.
     * - Any other undefined reason to reject this order.
     *
     * If any of these scenarios apply to your checkout process, then you should to return `false` here.
     */

    return true;
}

/**
 * Aplazame's payment is PENDING.
 *
 * Apply here your own logic for to set the order as pending payment.
 *
 * This callback is called only for specific orders (not for every order). Regular callbacks (Failed and Accepted) will be
 * called once the pending state has been resolved.
 *
 * @param string $order_id This is the same value as you filled in `order.id` when the checkout was created.
 *
 * @return bool `true` is the default value. You can return `false` if you don't want to proceed with this order.
 */
function setOrderPaymentStatusAsPending($order_id)
{
    /*
     * Most shops does not need to do nothing here but there are some scenarios may affect you:
     *
     * - Items in the order are saved from the stock (i.e. another customer could purchase the same item)
     * - You don't want to place on hold specific orders
     *
     * If any of these scenarios apply to your checkout process, then you have to return `false` here.
     */
    return true;
}

/*
 * This section is a more specific Aplazame flow as described in https://aplazame.dev/en/docs/api/checkout-confirmation/ or https://aplazame.dev/docs/api/checkout-confirmation/
 *
 * Feel free to adjust to the specific requirements of your checkout process. The following snippet is provided as a quick start.
 */
function response($status)
{
    header('Content-Type: application/json');

    echo json_encode(array('status' => $status));

    return null;
}

function confirm($payload, $sandbox)
{
    if (!$payload) {
        return response('Payload is malformed');
    }
    if (!isset($payload['sandbox']) || $payload['sandbox'] !== $sandbox) {
        return response('"sandbox" not provided');
    }
    if (!isset($payload['mid'])) {
        return response('"mid" not provided');
    }
    $mid = $payload['mid'];

    switch ($payload['status']) {
        case 'pending':
            switch ($payload['status_reason']) {
                case 'challenge_required':
                    if (!setOrderPaymentStatusAsPending($mid)) {
                        return response('ko');
                    }
                    break;
                case 'confirmation_required':
                    if (!setOrderPaymentStatusAsPaid($mid)) {
                        return response('ko');
                    }
                    break;
            }
            break;
        case 'ko':
            setOrderPaymentStatusFailed($mid);
            break;
    }

    return response('ok');
}

if ($_GET['access_token'] !== $privateKey) {
    return response(403);
}

confirm(
    json_decode(file_get_contents('php://input'), true),
    $environment === Aplazame\Api\Client::ENVIRONMENT_SANDBOX
);

<?php

namespace App\Service;

use App\Models\ConstantModel;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Illuminate\Support\Facades\Log;

class WooCommerceApiService
{
    const PREFIX = '/wp-json/wc/v3';
    const PREFIX_ORDER = '/wp-json/wc/v3/orders';
    const PREFIX_PRODUCT = '/wp-json/wc/v3/products';

    private $client;
    private $token;
    private $baseUriOrder;
    private $baseUriProduct;
    private $baseUri;

    public function __construct($token)
    {
        $this->baseUriOrder = $token->domain . self::PREFIX_ORDER;
        $this->baseUriProduct = $token->domain . self::PREFIX_PRODUCT;
        $this->baseUri = $token->domain . self::PREFIX;
        $this->token = array();
        $stack = HandlerStack::create();
        $middleware = new Oauth1([
            'consumer_key' => $token->consumer_key,
            'consumer_secret' => $token->consumer_secret,
            'token' => $token->access_token,
            'token_secret' => $token->access_token_secret
        ]);
        $stack->push($middleware);
        $this->client = new Client([
            'handler' => $stack
        ]);
    }

    public function authorize()
    {
        try {
            $endPoint = $this->baseUri;
            $response = $this->client->get($endPoint, ['auth' => 'oauth']);
            $status = $response->getStatusCode();
            if ($status == 200) {
                return true;
            }
        } catch (\Exception | GuzzleException $e) {
            Log::error($e->getMessage());
            return false;
        }
        return false;
    }

    public function getOrders($before, $after)
    {
        try {
            $endPoint = $this->baseUriOrder . '?status=processing, on-hold&before=' . $before . ($after ? '&after=' . $after : '');
            $response = $this->client->get($endPoint, ['auth' => 'oauth']);
            return json_decode($response->getBody());
        } catch (\Exception | GuzzleException $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    private function getStatusSameWooCommerce($orderStatus)
    {
        $orderStatuses = array_flip(ConstantModel::$STATUS);
        switch ($orderStatus) {
            case $orderStatuses['New']:
                return ConstantModel::$STATUS_WOOCOMMERCE[$orderStatuses['New']];
                break;
            case $orderStatuses['Payment']:
                return ConstantModel::$STATUS_WOOCOMMERCE[$orderStatuses['Payment']];
                break;
            case $orderStatuses['In progress']:
            case $orderStatuses['Processed']:
                return ConstantModel::$STATUS_WOOCOMMERCE[$orderStatuses['In progress']];
                break;
            case $orderStatuses['Completed']:
                return ConstantModel::$STATUS_WOOCOMMERCE[$orderStatuses['Completed']];
                break;
            case $orderStatuses['Cancel']:
                return ConstantModel::$STATUS_WOOCOMMERCE[$orderStatuses['Cancel']];
                break;
            default:
                return ConstantModel::$STATUS[$orderStatus];
        }
    }

    public function updateOrderStatus($orderId, $orderStatus)
    {
        try {
            $status = $this->getStatusSameWooCommerce($orderStatus);
            if (in_array($status, ConstantModel::$STATUS_WOOCOMMERCE)) {
                $endPoint = $this->baseUriOrder . '/' . $orderId . '?status=' . $status;
                $response = $this->client->put($endPoint, ['auth' => 'oauth']);
                return json_decode($response->getBody());
            }
            return true;
        } catch (\Exception | GuzzleException $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function deleteOrder($orderId)
    {
        try {
            $endPoint = $this->baseUriOrder . '/' . $orderId;
            $response = $this->client->delete($endPoint, ['auth' => 'oauth']);
            return json_decode($response->getBody());
        } catch (\Exception | GuzzleException $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function getProductById($productId)
    {
        try {
            $endPoint = $this->baseUriProduct . '?include=' . $productId;
            $response = $this->client->get($endPoint, ['auth' => 'oauth']);
            return json_decode($response->getBody());
        } catch (\Exception | GuzzleException $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function getOrderByIds($orderIds)
    {
        if (is_array($orderIds)) {
            $orderIds = implode(',', $orderIds);
        }
        try {
            $endPoint = $this->baseUriOrder . '?include=' . $orderIds;
            $response = $this->client->get($endPoint, ['auth' => 'oauth']);
            return json_decode($response->getBody());
        } catch (\Exception | GuzzleException $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}

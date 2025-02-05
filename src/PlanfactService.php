<?php

namespace JSPHPCoder\LaravelPlanfact;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TransferException;
use Psr\Http\Message\ResponseInterface;
use UnexpectedValueException;

/**
 * Class PlanfactService для работы с planfact.io
 */
class PlanfactService
{
    /**
     * @param string $url
     * @param array $data
     * @return array
     * @throws GuzzleException
     */
    public static function post(string $url, array $data, array $headers = [
        'Accept' => 'application/json',
        'X-ApiKey' => config('planfact.api_key')
    ]): array
    {
        $response = static::send('POST', $url, [
            'headers' => $headers,
            'json' => $data
        ]);
        if (isset($response['data'])) {
            $response = $response['data'];
        }
        return $response;
    }

    /**
     * @param string $url
     * @param array $data
     * @return array
     * @throws GuzzleException
     */
    public static function get(string $url, array $data, array $headers = [
        'Accept' => 'application/json',
        'X-ApiKey' => config('planfact.api_key')
    ]): array
    {
        $response = static::send('GET', $url, [
            'headers' => $headers,
            'query' => $data
        ]);

        if (isset($response['data'])) {
            $response = $response['data'];
        }
        return $response;
    }

    /**
     * @param string $url
     * @param array $data
     * @return array
     * @throws GuzzleException
     */
    public static function delete(string $url, array $data): array
    {
        $response = static::send('DELETE', $url, [
            'headers' => [
                'X-ApiKey' => config('planfact.api_key')
            ],
            'json' => $data
        ]);
        if (isset($response['data'])) {
            $response = $response['data'];
        }
        return $response;
    }

    /**
     * Отправка через Guzzle
     *
     * @param string $verb Метод отправки
     * @param string $urn URN ресурса
     * @param array $options Параметры запроса
     *
     * @return array
     * @throws ConnectException|ClientException|ServerException|TransferException|GuzzleException
     * @throws UnexpectedValueException Ошибка разбора ответа от сервера
     */
    private static function send(string $verb, string $urn, array $options = []): array
    {
        try {
            return static::toArray(
                (new Client(
                    [
                        'base_uri' => config('planfact.url'),
                        'connect_timeout' => config('planfact.connection_timeout'),
                        'timeout' => config('planfact.timeout'),
                        'http_errors' => true,
                        'verify' => true,
                        'headers' => [
                            'Content-Type' => 'application/json',
                        ]
                    ]
                ))->request($verb, $urn, $options)
            );
        } catch (ConnectException $exception) {
            throw new ConnectException(
                sprintf("API '%s': " . __('planfact::messages.connect_error'), config('planfact.service_name')),
                $exception->getRequest(),
                $exception,
                $exception->getHandlerContext()
            );
        } catch (ClientException $exception) {
            throw new ClientException(
                sprintf("API '%s': " . __('planfact::messages.client_error'), config('planfact.service_name')),
                $exception->getRequest(),
                $exception->getResponse(),
                $exception,
                $exception->getHandlerContext()
            );
        } catch (ServerException $exception) {
            throw new ServerException(
                sprintf("API '%s': " . __('planfact::messages.server_error'), config('planfact.service_name')),
                $exception->getRequest(),
                $exception->getResponse(),
                $exception,
                $exception->getHandlerContext()
            );
        } catch (TransferException $exception) {
            throw new TransferException(
                sprintf("API '%s': " . __('planfact::messages.unexpected_error'), config('planfact.service_name')),
                $exception->getCode(),
                $exception
            );
        }
    }

    /**
     * Преобразование в массив JSON строки из ответа
     *
     * @param ResponseInterface $response Ответ от сервера в виде JSON строки
     *
     * @return array
     * @throws UnexpectedValueException Ошибка разбора ответа от сервера
     */
    private static function toArray(ResponseInterface $response): array
    {
        if ($array = json_decode((string)$response->getBody(), true)) {
            return $array;
        } else {
            throw new UnexpectedValueException(
                sprintf("API '%s': " . __('planfact::messages.unexpected_error'), config('planfact.service_name')),
                500
            );
        }
    }
}

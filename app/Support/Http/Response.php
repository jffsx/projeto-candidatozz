<?php

namespace Candidatozz\Support\Http;

use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response as HttpStatus;

/**
 * class Response
 *
 * @package Candidatozz\Support\Http
 */
class Response
{
    /**
     * HTTP Response.
     *
     * @var \Illuminate\Http\Response
     */
    private $response;

    /**
     * HTTP Status code.
     *
     * @var int
     */
    private $statusCode = HttpStatus::HTTP_OK;

    /**
     * Create a new class instance.
     *
     * @param Illuminate\Http\Response $response
     */
    public function __construct(HttpResponse $response)
    {
        $this->response = $response;
    }

    /**
     * Return a 429 response.
     *
     * @param  string $message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function withTooManyRequests($message = 'Too Many Requests')
    {
        return $this->setStatusCode(
            HttpStatus::HTTP_TOO_MANY_REQUESTS
        )->withMessage($message);
    }

    /**
     * Return a 401 response.
     *
     * @param  string $message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function withUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(
            HttpStatus::HTTP_UNAUTHORIZED
        )->withMessage($message);
    }

    /**
     * Return a 500 response.
     *
     * @param  string $message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function withInternalServerError($message = 'Internal Server Error')
    {
        return $this->setStatusCode(
            HttpStatus::HTTP_INTERNAL_SERVER_ERROR
        )->withMessage($message);
    }

    /**
     * Return a 404 response.
     *
     * @param  string $message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function withNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(
            HttpStatus::HTTP_NOT_FOUND
        )->withMessage($message);
    }

    /**
     * Return a 422 response.
     *
     * @param  string $message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function withUnprocessableEntity($message = 'Unprocessable Entity')
    {
        return $this->setStatusCode(
            HttpStatus::HTTP_UNPROCESSABLE_ENTITY
        )->withMessage($message);
    }

    /**
     * Make a 204 response.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function withNoContent()
    {
        return $this->setStatusCode(
            HttpStatus::HTTP_NO_CONTENT
        )->json();
    }

    /**
     * Make an error response.
     *
     * @param  mixed $message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function withError($message = 'Internal Server Error')
    {
      return $this->setStatusCode(
          HttpStatus::HTTP_INTERNAL_SERVER_ERROR
      )->withMessage($message);
    }

    /**
     * Make an success response.
     *
     * @param  $message
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function withSuccess($message)
    {
        return $this->setStatusCode(
            HttpStatus::HTTP_OK
        )->withMessage($message);
    }

    /**
     * Make a message response.
     *
     * @param  $message
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function withMessage($message)
    {
        return $this->json([
            'message' => $message,
        ]);
    }

    /**
     * Make a JSON response.
     *
     * @param  mixed  $data
     * @param  array  $headers
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function json($data = [], array $headers = [])
    {
        return response()->json($data, $this->statusCode, $headers);
    }

    /**
     * Set HTTP status code.
     *
     * @param int $statusCode
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }
}

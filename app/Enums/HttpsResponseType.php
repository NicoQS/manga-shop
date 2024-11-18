<?php
declare(strict_types=1);


namespace App\Enums;

enum HttpsResponseType: int
{
    case HTTP_OK = 200;
    case HTTP_CREATED = 201;
    case HTTP_ACCEPTED = 202;
    case HTTP_NON_AUTHORITATIVE_INFORMATION = 203;
    case HTTP_NO_CONTENT = 204;
    case HTTP_RESET_CONTENT = 205;
    case HTTP_FOUND = 302;
    case HTTP_TEMPORARY_REDIRECT = 307;
    case HTTP_BAD_REQUEST = 400;
    case HTTP_UNAUTHORIZED = 401;
    case HTTP_FORBIDDEN = 403;
    case HTTP_NOT_FOUND = 404;
    case HTTP_METHOD_NOT_ALLOWED = 405;
    case HTTP_NOT_ACCEPTABLE = 406;
    case HTTP_REQUEST_TIMEOUT = 408;
    case HTTP_INTERNAL_SERVER_ERROR = 500;
}

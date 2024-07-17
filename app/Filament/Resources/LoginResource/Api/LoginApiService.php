<?php
namespace App\Filament\Resources\LoginResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\LoginResource;
use Illuminate\Routing\Router;


class LoginApiService extends ApiService
{
    protected static string | null $resource = LoginResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}

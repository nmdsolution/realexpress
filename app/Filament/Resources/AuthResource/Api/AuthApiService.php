<?php
namespace App\Filament\Resources\AuthResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\AuthResource;
use Illuminate\Routing\Router;


class AuthApiService extends ApiService
{
    protected static string | null $resource = AuthResource::class;

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

<?php
namespace App\Filament\Resources\AdminResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\AdminResource;
use Illuminate\Routing\Router;


class AdminApiService extends ApiService
{
    protected static string | null $resource = AdminResource::class;

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

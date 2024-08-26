<?php
namespace App\Filament\Resources\ExpeditionResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\ExpeditionResource;
use Illuminate\Routing\Router;


class ExpeditionApiService extends ApiService
{
    protected static string | null $resource = ExpeditionResource::class;

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

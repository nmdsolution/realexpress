<?php
namespace App\Filament\Resources\BusResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\BusResource;
use Illuminate\Routing\Router;


class BusApiService extends ApiService
{
    protected static string | null $resource = BusResource::class;

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

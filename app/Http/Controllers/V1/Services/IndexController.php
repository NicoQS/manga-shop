<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Services;

use App\Models\Service;
use Illuminate\Http\JsonResponse;

final class IndexController{

    public function __invoke()
    {
        $services = Service::query()->simplePaginate(config('app.pagination.limit'));

        return new JsonResponse(data: $services);
    }

}

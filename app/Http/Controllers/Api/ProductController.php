<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductIndexRequest;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use App\Queries\Api\Filters\ProductFilter;
use Throwable;

final class ProductController extends Controller
{
    /**
     * @throws Throwable
     */
    public function index(ProductIndexRequest $request, ProductFilter $filter)
    {
        $query = $filter->apply(Product::query()->with('category'));
        $paginator = $query->paginate($request->input('per_page', 10));

        return new ProductCollection($paginator);
    }
}

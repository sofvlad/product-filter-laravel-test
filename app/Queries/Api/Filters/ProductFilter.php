<?php

declare(strict_types=1);

namespace App\Queries\Api\Filters;

use App\Queries\Filter;
use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends Filter
{
    protected const array FILTER_MAP = [
        'q' => 'search',
        'price_from' => 'priceFrom',
        'price_to' => 'priceTo',
        'category_id' => 'categoryId',
        'in_stock' => 'inStock',
        'rating_from' => 'ratingFrom',
    ];

    protected const array ORDER_MAP = [
        'price_asc' => [
            'column' => 'price',
            'dir' => 'asc',
        ],
        'price_desc' => [
            'column' => 'price',
            'dir' => 'desc',
        ],
        'rating_desc' => [
            'column' => 'price',
            'dir' => 'desc',
        ],
        'newest' => [
            'column' => 'created_at',
            'dir' => 'desc',
        ],
    ];

    protected string $orderArgName = 'sort';

    /**
     * @inheritDoc
     */
    protected function filterMap(): array
    {
        return static::FILTER_MAP;
    }

    /**
     * @inheritDoc
     */
    protected function orderMap(): array
    {
        return static::ORDER_MAP;
    }

    /**
     * @param Builder $query
     * @param $value
     * @return void
     */
    protected function search(Builder $query, $value): void
    {
        $query->where('name', 'like', "%{$value}%");
    }

    /**
     * @param Builder $query
     * @param $value
     * @return void
     */
    protected function priceFrom(Builder $query, $value): void
    {
        $query->where('price', '>=', $value);
    }

    /**
     * @param Builder $query
     * @param $value
     * @return void
     */
    protected function priceTo(Builder $query, $value): void
    {
        $query->where('price', '<=', $value);
    }

    /**
     * @param Builder $query
     * @param $value
     * @return void
     */
    protected function categoryId(Builder $query, $value): void
    {
        $query->where('category_id', $value);
    }

    /**
     * @param Builder $query
     * @param $value
     * @return void
     */
    protected function inStock(Builder $query, $value): void
    {
        $query->where('in_stock', filter_var($value, FILTER_VALIDATE_BOOLEAN));
    }

    /**
     * @param Builder $query
     * @param $value
     * @return void
     */
    protected function ratingFrom(Builder $query, $value): void
    {
        $query->where('rating', '>=', $value);
    }
}

<?php

declare(strict_types=1);

namespace App\Queries;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filter
{
    /**
     * @param Request $request
     */
    public function __construct(
        protected Request $request
    ) {}

    protected string $orderArgName = 'order';

    /**
     * @return array
     */
    abstract protected function filterMap(): array;

    /**
     * @return array
     */
    abstract protected function orderMap(): array;

    /**
     * @param string $key
     * @return array|null
     */
    protected function getOrderData(string $key): ?array
    {
        $orderData = $this->orderMap();

        return $orderData[$key] ?? null;
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function apply(Builder $query): Builder
    {
        foreach ($this->filterMap() as $param => $method) {
            $value = $this->request->input($param);

            if ($value !== null && method_exists($this, $method)) {
                $this->$method($query, $value);
            }
        }

        $orderInput = $this->request->input($this->orderArgName);
        $orderData = null;
        if (!empty($orderInput)) {
            $orderData = $this->getOrderData($orderInput);
        }
        if ($orderData !== null) {
            $query->orderBy($orderData['column'], $orderData['dir']);
        } else {
            $this->defaultSort($query);
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @return void
     */
    protected function defaultSort(Builder $query): void
    {
        $query->orderBy('id');
    }
}

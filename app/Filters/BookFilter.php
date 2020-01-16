<?php

namespace App\Filters;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class BookFilter extends Filter
{
    const PER_PAGE = 10;

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function get(Request $request): LengthAwarePaginator
    {
        $builder = $this->getQueryBuilder($request);
        return $builder->paginate(self::PER_PAGE, ['*'], 'page');
    }

    /**
     * @param Request $request
     * @return int
     */
    public function count(Request $request): int
    {
        $builder = $this->getQueryBuilder($request);
        return $builder->count();
    }

    /**
     * @param Request $request
     * @return Builder
     */
    private function getQueryBuilder(Request $request): Builder
    {
        $builder = \DB::table('books')
            ->join('categories', 'categories.id', '=', 'books.category_id')
            ->orderBy('books.title')
            ->select([
                'books.*',
                'categories.name'
            ]);
        return $builder;
    }
}

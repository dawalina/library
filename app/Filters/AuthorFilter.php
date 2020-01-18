<?php

namespace App\Filters;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class AuthorFilter extends Filter
{
    const PER_PAGE = 10;

    /**
     * @param Request|null $request
     * @return LengthAwarePaginator
     */
    public function get(Request $request = null): LengthAwarePaginator
    {
        $builder = $this->getQueryBuilder();

        $this->filter($builder, $request);

        return $builder->paginate(self::PER_PAGE, ['*'], 'page');
    }

    public function filter(Builder $builder, Request $request) {
        $firstName = $request->get('first_name', '');
        if (!empty($firstName)) {
            $builder->where('first_name', 'LIKE', '%' . $firstName . '%');
        }

        $lastName = $request->get('last_name', '');
        if (!empty($lastName)) {
            $builder->where('last_name', 'LIKE', '%' . $lastName . '%');
        }
    }

    /**
     * @param Request|null $request
     * @return int
     */
    public function count(Request $request = null): int
    {
        $builder = $this->getQueryBuilder();
        return $builder->count();
    }

    /**
     * @return Builder
     */
    private function getQueryBuilder(): Builder
    {
        return \DB::table('authors')
            ->orderBy('last_name');
    }
}

<?php

namespace App\Filters;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class ReaderFilter extends Filter
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
        return \DB::table('readers')
            ->orderBy('last_name');
    }
}

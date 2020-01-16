<?php

namespace App\Filters;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class CopyFilter extends Filter
{
    const PER_PAGE = 10;

    protected $id;

    public function __construct($id) {
        $this->id = $id;
    }

    /**
     * @param Request|null $request
     * @return LengthAwarePaginator
     */
    public function get(Request $request = null): LengthAwarePaginator
    {
        $builder = $this->getQueryBuilder();
        return $builder->paginate(self::PER_PAGE, ['*'], 'page');
    }

    /**
     * @return int
     */
    public function count(): int
    {
        $builder = $this->getQueryBuilder();
        return $builder->count();
    }

    /**
     * @return Builder
     */
    private function getQueryBuilder(): Builder
    {
        return \DB::table('copies')
            ->where('book_id', '=', $this->id)
            ->orderBy('status');
    }
}

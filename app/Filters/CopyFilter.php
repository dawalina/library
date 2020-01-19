<?php

namespace App\Filters;

use App\Models\Copy;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class CopyFilter extends Filter
{
    const PER_PAGE = 10;

    protected $id;

    public function __construct($id = null) {
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

    public function getEnabled() {
        $builder = $this->getQueryBuilder();

        $builder->where('status', '=', Copy::STATUS_EXIST);

        $filter = new RentFilter();

        $disabledCopies = $filter->getDisabledCopies();
        if (!empty($disabledCopies)) {
            $builder->whereNotIn('id', $disabledCopies);
        }
        $builder->orderBy('book_id');

        $copies = [];
        foreach ($builder->get() as $copy) {
            $copies[$copy->book_id][] = $copy->id;
        }

        return $copies;
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
        $builder = \DB::table('copies');

        if ($this->id !== null) {
            $builder->where('book_id', '=', $this->id)
                ->orderBy('status');
        }
        return $builder;
    }
}

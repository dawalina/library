<?php

namespace App\Filters;

use App\Models\Rent;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class RentFilter extends Filter
{
    const PER_PAGE = 10;

    /**
     * @param Request|null $request
     * @return LengthAwarePaginator
     */
    public function get(Request $request = null): LengthAwarePaginator
    {
        $builder = $this->getQueryBuilder();

        $builder->join('readers', 'readers.id', '=', 'rents.reader_id')
            ->join('copies', 'copies.id', '=', 'rents.copy_id')
            ->join('books', 'books.id', '=', 'copies.book_id')
            ->join('categories', 'categories.id', '=', 'books.category_id')
            ->orderBy('rents.id', 'desc')
            ->select([
                'rents.id AS id',
                'readers.id AS reader_id',
                'readers.first_name AS reader_first_name',
                'readers.last_name AS reader_last_name',
                'readers.email AS reader_email',
                'copies.id AS copy_id',
                'books.id AS book_id',
                'books.title AS book_title',
                'categories.id AS category_id',
                'categories.name AS category_name',
                'rents.issued_at AS issued_at',
                'rents.expire_at',
                'rents.returned_at',
                'rents.status',
                'rents.created_at',
                'rents.updated_at',
            ]);

        $this->filter($builder, $request);

        $rents = $builder->paginate(self::PER_PAGE, ['*'], 'page');

        return $rents->appends($request->except('page'));
    }

    public function getDisabledCopies() {
        $builder = $this->getQueryBuilder();
        $builder->where('status', '!=', Rent::STATUS_RETURNED);
        return $builder->pluck('copy_id');
    }

    protected function filter(Builder $builder, Request $request)
    {
        $reader = $request->get('reader_id', null);
        if (!empty($reader)) {
            $builder->where('readers.id', '=', $reader);
        }

        $category = $request->get('category_id', null);
        if (!empty($category)) {
            $builder->where('categories.id', '=', $category);
        }

        $period = $request->get('period', null);
        if (!empty($period)) {
            $period = explode(' - ', $period);
            $builder->whereBetween('rents.issued_at', $period);
        } else {
            $builder->where('rents.issued_at', '>=', Carbon::now()->setTime(0,0,0));
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
        return \DB::table('rents');
    }
}

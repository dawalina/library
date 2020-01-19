<?php

namespace App\Filters;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class Filter
{
    const PER_PAGE = 10;

    protected function filter(Builder $builder, Request $request) {
        $firstName = $request->get('first_name', '');
        if (!empty($firstName)) {
            $builder->where('first_name', 'LIKE', '%' . $firstName . '%');
        }

        $lastName = $request->get('last_name', '');
        if (!empty($lastName)) {
            $builder->where('last_name', 'LIKE', '%' . $lastName . '%');
        }
    }
}

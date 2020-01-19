<?php

namespace App\Http\Controllers;

use App\Filters\CopyFilter;
use App\Filters\RentFilter;
use App\Models\Book;
use App\Models\Category;
use App\Models\Reader;
use App\Models\Rent;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display rents
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $filter = new RentFilter();

        return view('report.index', [
            'items'       => $filter->get($request),
            'readers'     => Reader::query()->orderBy('last_name')->get(),
            'categories'  => Category::query()->orderBy('name')->pluck('name', 'id'),
            'statuses'    => Rent::$statuses,
            'reader_id'   => $request->get('reader_id', 0),
            'category_id' => $request->get('category_id', 0),
            'period'      => $request->get('period', null),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Filters\CopyFilter;
use App\Filters\RentFilter;
use App\Models\Book;
use App\Models\Reader;
use App\Models\Rent;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class RentController extends Controller
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
        $filter     = new RentFilter();
        $copyFilter = new CopyFilter();

        return view('rent.index', [
            'items'         => $filter->get($request),
            'readers'       => Reader::query()->orderBy('last_name')->get(),
            'books'         => Book::query()->orderBy('title')->get(),
            'enabledCopies' => $copyFilter->getEnabled(),
            'statuses'      => Rent::$statuses
        ]);
    }

    /**
     * View rent
     * @param int $id
     * @return Factory|View
     */
    public function view($id)
    {
        $filter = new CopyFilter();

        return view('rent.view', [
            'item'          => Rent::whereId($id)->first(),
            'readers'       => Reader::query()->orderBy('last_name')->get(),
            'books'         => Book::query()->orderBy('title')->get(),
            'enabledCopies' => $filter->getEnabled(),
            'statuses'      => Rent::$statuses
        ]);
    }

    /**
     * Edit rent
     * @param int $id
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function edit($id, Request $request)
    {
        Rent::whereId($id)
            ->update([
                'reader_id'   => $request->get('reader_id'),
                'copy_id'     => $request->get('copy_id'),
                'issued_at'   => $request->get('issued_at'),
                'expire_at'   => $request->get('expire_at'),
                'returned_at' => $request->get('returned_at'),
                'status'      => $request->get('status'),
            ]);

        return redirect('rents/' . $id);
    }

    /**
     * Create rent
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function create(Request $request)
    {
        $rent = new Rent();
        $rent->reader_id = $request->get('reader_id');
        $rent->copy_id   = $request->get('copy_id');
        $rent->issued_at = now();
        $rent->expire_at = Carbon::now()
            ->addDays(30)
            ->setHours(23)
            ->setMinutes(59)
            ->setSeconds(59);

        $rent->status = Rent::STATUS_ISSUED;
        $rent->save();

        return redirect('rents/' . $rent->id);
    }
}

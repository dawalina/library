<?php

namespace App\Http\Controllers;

use App\Filters\ReaderFilter;
use App\Models\Reader;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ReaderController extends Controller
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
     * Display readers
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $filter = new ReaderFilter();
        return view('reader.index', [
            'items' => $filter->get($request)
        ]);
    }

    /**
     * View reader
     * @param int $id
     * @return Factory|View
     */
    public function view($id)
    {
        return view('reader.view', [
            'item' => Reader::whereId($id)->first(),
        ]);
    }

    /**
     * Edit reader
     * @param int $id
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function edit($id, Request $request)
    {
        Reader::whereId($id)
            ->update([
                'first_name' => $request->get('first_name'),
                'last_name'  => $request->get('last_name'),
                'email'      => $request->get('email'),
            ]);

        return redirect('readers/' . $id);
    }

    /**
     * Create reader
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function create(Request $request)
    {
        $reader = Reader::firstOrCreate([
            'first_name' => $request->get('first_name', ''),
            'last_name'  => $request->get('last_name', ''),
        ]);

        return redirect('readers/' . $reader->id);
    }
}

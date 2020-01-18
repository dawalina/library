<?php

namespace App\Http\Controllers;

use App\Filters\AuthorFilter;
use App\Models\Author;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class AuthorController extends Controller
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
     * Display authors
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $filter = new AuthorFilter();
        return view('author.index', [
            'items' => $filter->get($request)
        ]);
    }

    /**
     * View author
     * @param int $id
     * @return Factory|View
     */
    public function view($id)
    {
        return view('author.view', [
            'item' => Author::whereId($id)->first(),
        ]);
    }

    /**
     * Edit author
     * @param int $id
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function edit($id, Request $request)
    {
        Author::whereId($id)
            ->update([
                'first_name' => $request->get('first_name'),
                'last_name'  => $request->get('last_name')
            ]);

        return redirect('authors/' . $id);
    }

    /**
     * Create author
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function create(Request $request)
    {
        $author = Author::firstOrCreate([
            'first_name' => $request->get('first_name', ''),
            'last_name'  => $request->get('last_name', ''),
        ]);

        return redirect('authors/' . $author->id);
    }
}

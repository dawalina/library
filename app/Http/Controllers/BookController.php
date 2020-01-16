<?php

namespace App\Http\Controllers;

use App\Filters\BookFilter;
use App\Models\Book;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class BookController extends Controller
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
     * Display books
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $filter = new BookFilter();
        return view('book.index', [
            'items' => $filter->get($request)
        ]);
    }

    /**
     * Edit book
     * @param int $id
     * @return Factory|View
     */
    public function view($id)
    {
        return view('book.view', [
            'item' => Book::whereId($id)->first()
        ]);
    }

    /**
     * Edit book
     * @param int $id
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function edit($id, Request $request)
    {
        Book::whereId($id)
            ->update([
                'title' => $request->get('title'),
                'category_id' => $request->get('category_id')
            ]);

        return redirect('books/' . $id);
    }

    /**
     * Display books
     * @param Request $request
     * @return JsonResponse
     */
    public function getItems(Request $request)
    {
        $filter = new BookFilter();
        return response()->json([
            $filter->get($request)
        ]);
    }
}

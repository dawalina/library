<?php

namespace App\Http\Controllers;

use App\Filters\BookFilter;
use App\Filters\CopyFilter;
use App\Models\Book;
use App\Models\Copy;
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
        $filter = new CopyFilter($id);
        return view('book.view', [
            'item'     => Book::whereId($id)->first(),
            'items'    => $filter->get(),
            'statuses' => Copy::$statuses
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

    /**
     * Remove copy
     * @param int $id
     * @param int $copyId
     * @return RedirectResponse|Redirector
     */
    public function removeCopy($id, $copyId)
    {
        Copy::whereId($copyId)
            ->update([
                'status' => Copy::STATUS_NOT_EXIST
            ]);

        return redirect('books/' . $id);
    }

    /**
     * Add copy
     * @param int $id
     * @param int $copyId
     * @return RedirectResponse|Redirector
     */
    public function addCopy($id, $copyId)
    {
        Copy::whereId($copyId)
            ->update([
                'status' => Copy::STATUS_EXIST
            ]);

        return redirect('books/' . $id);
    }

    /**
     * Create copy
     * @param int $id
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function createCopy($id, Request $request)
    {
        $data = [];
        for ($i = 0; $i < $request->get('count', 1); $i++) {
            $data[] = [
                'book_id'    => $id,
                'status'     => Copy::STATUS_EXIST,
                'created_at' => now()
            ];
        }
        Copy::insert($data);

        return redirect('books/' . $id);
    }
}

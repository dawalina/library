<?php

namespace App\Http\Controllers;

use App\Filters\BookFilter;
use App\Filters\CopyFilter;
use App\Models\Author;
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

        $book = Book::whereId($id)->first();
        return view('book.view', [
            'item'           => $book,
            'items'          => $filter->get(),
            'statuses'       => Copy::$statuses,
            'authors'        => Author::query()->orderBy('first_name')->get(),
            'currentAuthors' => $book->authors->pluck('first_name', 'id')
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

    /**
     * Remove author
     * @param int $id
     * @param int $authorId
     * @return RedirectResponse|Redirector
     */
    public function removeAuthor($id, $authorId)
    {
        \DB::table('books_authors')
            ->where('book_id', '=', $id)
            ->where('author_id', '=', $authorId)
            ->delete();

        return redirect('books/' . $id);
    }

    /**
     * Add author
     * @param int $id
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function addAuthor($id, Request $request)
    {
        $authorId = $request->get('author_id');

        $author = \DB::table('books_authors')
            ->where('book_id', '=', $id)
            ->where('author_id', '=', $authorId)
            ->first();

        if (!$author) {
            \Db::table('books_authors')
                ->insert([
                    'book_id' => $id,
                    'author_id' => $authorId,
                ]);
        }

        return redirect('books/' . $id);
    }
}

<?php

namespace App\Http\Controllers\Api\v1;

use App\Filters\AuthorFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthorController extends Controller
{

    /**
     * Display authors
     * @param AuthorRequest $request
     * @return LengthAwarePaginator
     */
    public function index(AuthorRequest $request)
    {
        $filter = new AuthorFilter();
        return $filter->get($request);
    }

    /**
     * View author
     * @param int $id
     * @return ResponseFactory|Response
     */
    public function show($id)
    {
        $author = Author::whereId($id)->first();

        if ($author) {
            return response(['author' => $author], 200);
        }
        return response(['message' => 'Author does not exist'], 422);
    }

    /**
     * Edit author
     * @param int $id
     * @param AuthorRequest $request
     * @return ResponseFactory|Response
     */
    public function edit($id, AuthorRequest $request)
    {
        $author = Author::whereId($id)->first();

        if ($author) {
            $author->fill($request->validated());
            $author->save();
            return response(['author' => $author], 200);
        }

        return response(['message' => 'Author does not exist'], 422);
    }

    /**
     * Create author
     * @param AuthorRequest $request
     * @return ResponseFactory|Response
     */
    public function create(AuthorRequest $request)
    {
        return response(['author' => Author::firstOrCreate($request->validated())], 200);
    }

    /**
     * Delete author
     * @param int $id
     * @return ResponseFactory|Response
     */
    public function delete($id)
    {
        $author = Author::whereId($id)->first();

        if ($author) {
            $author->delete();
            return response(['message' => 'Author is deleted'], 200);
        }

        return response(['message' => 'Author does not exist'], 422);
    }
}

<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\Library\LibrarySearchRequest;
use App\Models\Library\Library;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LibraryController extends Controller
{
    /**
     * Create a new library resource.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer|unique:libraries',
            'code' => 'required|regex:/[A-Z]{3}\d{3}/|unique:libraries',
            'name' => 'required',
            'abbr' => 'required',
            'url' => 'required|url',
        ]);

        try {
            Library::create($request->all());
            return response('', 201);
        } catch (\Exception $ex) {
            return response('', 500);
        }
    }

    /**
     * Retrieve the library model for the given ID.
     *
     * @param  LibrarySearchRequest $request
     * @param  int $id
     * @return Response
     */
    public function show(LibrarySearchRequest $request, $id)
    {
        try {
            $result = $request->findById($id);
            return response()->json($result);
        } catch (NotFoundHttpException $ex) {
            return response('', 404);
        }
    }
}

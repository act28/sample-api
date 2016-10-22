<?php

namespace App\Http\Requests\Library;

use App\Http\Transformers\Library\LibraryTransformer;
use App\Models\Library\Library;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use League\Fractal;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LibrarySearchRequest extends Request
{
    /**
     * @var Fractal\Manager
     */
    protected $fractal;

    /**
     * LibrarySearchRequest constructor.
     *
     * @param array $query
     * @param array $request
     * @param array $attributes
     * @param array $cookies
     * @param array $files
     * @param array $server
     * @param null $content
     */
    public function __construct($query = [], $request = [], $attributes = [], $cookies = [], $files = [], $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $this->fractal = new Fractal\Manager();
    }

    /**
     * Find resource by id.
     *
     * @param $id
     * @return string
     */
    public function findById($id)
    {
        try {
            $library = Library::where('id', 'LIKE', $id)->firstOrFail();
            $resource = new Fractal\Resource\Item($library, new LibraryTransformer());
            return $this->fractal->createData($resource)->toArray();
        } catch (ModelNotFoundException $ex) {
            throw new NotFoundHttpException();
        }

        return 'Not Found';
    }
}
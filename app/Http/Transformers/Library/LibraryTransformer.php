<?php

namespace App\Http\Transformers\Library;

use App\Models\Library\Library;
use League\Fractal;

class LibraryTransformer extends Fractal\TransformerAbstract
{
    /**
     * List of resources to automatically include.
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * List of resources possible to include.
     *
     * @var array
     */
    protected $availableIncludes = [];

    /**
     * Turn this item object into a generic array.
     *
     * @return array
     */
    public function transform(Library $library)
    {
        return [
            'id' => (int)$library->id,
            'code' => $library->code,
            'name' => $library->name,
            'abbr' => $library->abbr,
            'links' => [
                [
                    'rel' => 'self',
                    'uri' => '/api/library/' . $library->id,
                ],
                [
                    'rel' => 'homepage',
                    'uri' => $library->url,
                ]
            ],
        ];
    }
}
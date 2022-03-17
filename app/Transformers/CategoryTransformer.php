<?php

namespace App\Transformers;

use App\Models\book;
use App\Models\category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(category $category)
    {
        return [
            'id'=> $category->id,
            'name'=>$category->name,
        ];
    }
}

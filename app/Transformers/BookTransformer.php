<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\book;
use App\Transformers\CategoryTransformer;

class BookTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(book $book)
    {
        return [
            'id'=>$book->id,
            'bookname'=>$book->bookname,
            'description'=>$book->description,
        ];
    }
    public function includeCategory(book $book)
    {
        $category = $book->category();

        return $this->item($category,new CategoryTransformer());
    }
}

<?php

namespace App\Data\Dto;

use App\Data\Contracts\Protectable;
use Illuminate\Contracts\Support\Arrayable;

/**
 *
 */
class Page implements Arrayable
{


    /**
     * @param string $route
     * @param string $title
     */
    public function __construct(
        public string $route,
        public string $title
    )
    {
    }



    public function toArray():array
    {
        return [
            'route'=>$this->route,
            'title'=>$this->title,
         ];
    }
}

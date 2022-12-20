<?php

namespace App\Data\Dto;

use App\Foundation\DataViewer\Dto\Search;

/**
 *
 */
class SearchAdmin extends Search
{

    /**
     * @param string|null $search
     * @param int|null $id
     * @param int|null $excludeId
     * @param int|null $perPage
     */
    public function __construct(
        public string|null $search = null,
        public int|null $id = null,
        public string|null $email = null,
        public string|null $name = null,
        public int|null $excludeId = null,
        public int|null $perPage = 10,
    )
    {
    }

}

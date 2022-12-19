<?php

namespace App\Foundation\Modules\Data\Factory;

use App\Data\Contracts\Protectable;
use App\Foundation\Modules\Data\Enums\ProtectableCategory;
use Illuminate\Support\Str;

/**
 *
 */
class Action implements Protectable
{


    /**
     * @param ProtectableCategory $type
     * @param string $label
     * @param string $route
     * @param string $slug
     */
    private function __construct(
        public   ProtectableCategory $type,
        public   string              $label,
        public   string              $route,
        public   string              $slug,
    ) {
    }

    /**
     * @param string $route
     * @param string|null $slug
     * @return static
     */
    public static function redirect(string $route, string $label, ?string $slug = null ):self {
        return new  self(ProtectableCategory::REDIRECT, $label, $route, $slug?: Str::slug(str_replace('.','-',$route)));
    }

    public function getSlugPermission(): string
    {
        return  $this->slug;
    }

    public function getLabel(): string
    {
        return  $this->label;
    }

}

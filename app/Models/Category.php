<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property string $name
 * @property string $deep
 * @property string $slug
 */
class Category extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'deep',
        'slug'
    ];


    /**
     * @return HasMany
     */
    public function subCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class, 'sub_category_id');
    }

    /**
     * @return HasMany
     */
    public function childCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class, 'child_category_id');
    }
}

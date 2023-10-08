<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property-read int|null $sub_category_id
 * @property-read int|null $child_category_id
 * @property-read int|null $category_id
 */
class SubCategory extends Model
{
    use HasFactory;


    /**
     * @var string[]
     */
    protected $fillable = [
        'category_id',
        'sub_category_id',
        'child_category_id'
    ];

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * @return BelongsTo
     */
    public function sub(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * @return BelongsTo
     */
    public function child(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'child_category_id');
    }
}

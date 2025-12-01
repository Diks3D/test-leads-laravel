<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\TaskStatusEnum;
use App\Models\User;
use App\Models\Category;
use App\Traits\Uuid;

/**
 * @property int $user_id
 * @property int $category_id
 * @property TaskStatusEnum $status
 * @property string $title
 * @property string $content
 * @property Carbon|null $expired_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property-read User $user
 * @property-read Category $category
 *
 * @method static Builder<static>|UserBalance newModelQuery()
 * @method static Builder<static>|UserBalance newQuery()
 * @method static Builder<static>|UserBalance query()
 * @method static Builder<static>|UserBalance whereCategoryId($value)
 * @method static Builder<static>|UserBalance whereUserId($value)
 *
 * @mixin Eloquent
 */
class Task extends Model
{
    use Uuid;

    protected $casts = [
        'status' => TaskStatusEnum::class,
        'expired_at' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'status',
        'expired_at',
        'close_at',
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Category, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

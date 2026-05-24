<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'content',
        'image_path',
        'status',
        'user_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'todo_id', 'user_id')->withTimestamps();
    }

    public function scopeCategorySearch($query, $category_id)
    {
        if (! empty($category_id)) {
            $query->where('category_id', $category_id);
        }

        return $query;
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (! empty($keyword)) {
            $query->where('content', 'like', '%'.$keyword.'%');
        }

        return $query;
    }

    public function scopeStatusSearch($query, $status)
    {
        if ($status !== null && $status !== '') {
            $query->where('status', $status);
        }

        return $query;
    }
}

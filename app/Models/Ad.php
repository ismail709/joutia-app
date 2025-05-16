<?php

namespace App\Models;

use App\Enums\AdStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Ad extends Model
{
    use SoftDeletes, Searchable, HasFactory;

    protected $fillable = [
        'title', 
        'description', 
        'price', 
        'status', 
        'city', 
        'address', 
        'category_id', 
        'user_id'
    ];

    protected $casts = [
        'status' => AdStatusEnum::class,
    ];

    protected function scopeApproved(Builder $query)
    {
        return $query->where('status',AdStatusEnum::APPROVED->value);
    }

    protected function scopePending(Builder $query)
    {
        return $query->where('status',AdStatusEnum::PENDING->value);
    }

    protected function scopeRefused(Builder $query)
    {
        return $query->where('status',AdStatusEnum::REFUSED->value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function views()
    {
        return $this->hasMany(AdView::class);
    }

    public function toSearchableArray(): array
    {
        $this->loadCount('views');
        $this->load(['user','category']);
        return array_merge($this->toArray(), [
            "id" => (string) $this->id,
            "created_at" => $this->created_at->timestamp,
            "views_count" => $this->views_count,
            "user" => $this->user->name,
            "category" => $this->category->name
        ]);
    }
}

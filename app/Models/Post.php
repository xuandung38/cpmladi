<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'posts';

    protected $fillable = [
    	'title',
	    'slug',
	    'thumbnail',
	    'description',
	    'content',
	    'is_active',
	    'blog_category_id'
    ];


    public function category()
    {
    	return $this->hasOne(BlogCategory::class, 'id','blog_category_id');
    }

    public function resolveRouteBinding($value, $field = null)
    {
	    return $this->where('slug', $value)->firstOrFail();
    }
}

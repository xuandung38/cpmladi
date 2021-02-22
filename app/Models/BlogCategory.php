<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;

    protected $table = 'blog_categories';

    protected $fillable = [
    	'title',
	    'slug',
	    'icon',
	    'description',
	    'parent_id',
	    'is_active'
    ];


	public function posts()
    {
    	return $this->belongsTo(Post::class);
    }

    public function parent()
    {
	    return $this->belongsTo(BlogCategory::class, 'parent_id', 'id')->withDefault('title');
    }

	public function resolveRouteBinding($value, $field = null)
	{
		return $this->where('slug', $value)->firstOrFail();
	}

}

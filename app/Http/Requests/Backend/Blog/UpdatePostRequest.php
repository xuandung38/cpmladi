<?php

namespace App\Http\Requests\Backend\Blog;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends BaseRequest
{
	public function rules()
	{
		return array_merge(parent::rules(), [
			'blog_category_id' => 'required|exists:blog_categories,id',
			'title' => [
				'required',
				'max:255',
				Rule::unique('posts', 'title')
					->whereNot('id', $this->input('id')),
			],
			'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			'description' => 'required|max:255',
			'content' => 'required',
		]);
	}

	/**
	 * Prepare parameters from Form Request.
	 *
	 * @return array
	 */
	public function parameters()
	{

		return [
			'blog_category_id'  => $this->input('blog_category_id'),
			'title' => $this->input('title'),
			'thumbnail' => $this->input('thumbnail'),
			'description' => $this->input('description'),
			'content' => $this->input('content'),
			'is_active' => $this->has('is_active')
		];
	}
}

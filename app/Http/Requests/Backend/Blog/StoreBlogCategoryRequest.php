<?php

namespace App\Http\Requests\Backend\Blog;

use App\Http\Requests\BaseRequest;
use Str;

class StoreBlogCategoryRequest extends BaseRequest
{
	public function rules()
	{
		return array_merge(parent::rules(), [
			'parent_id' => 'nullable|exists:blog_categories,id',
			'title' => 'required|max:45|unique:blog_categories',
			'icon' => 'required',
			'description' => 'required|max:255',
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
			'parent_id'  => $this->input('parent_id'),
			'title' => $this->input('title'),
			'icon' => $this->input('icon'),
			'description' => $this->input('description'),
			'is_active' => $this->has('is_active')
		];
	}
}

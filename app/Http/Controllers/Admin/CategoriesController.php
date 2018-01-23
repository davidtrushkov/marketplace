<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\FileCategoryRequest;

class CategoriesController extends Controller {


	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index() {

		$categories = Category::orderBy('name', 'asc')->paginate(50);

		return view('admin.categories.index', compact ('categories'));
	}


	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create() {
		return view('admin.categories.create');
	}


	/**
	 * @param $slug
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit($slug) {

		$category = Category::where('slug', $slug)->first();

		return view('admin.categories.edit', compact('category'));
	}


	/**
	 * @param Request $request
	 *
	 * @return mixed
	 */
	public function store(Request $request) {

		$this->validate($request,[
			'name' => 'required|string|max:25|unique:categories,name'
		]);

		Category::create([
			'name' => $request->name,
			'slug' => str_slug($request->name)
		]);

		return redirect(route('admin.categories'))->withSuccess("Category created.");
	}


	/**
	 * @param FileCategoryRequest $request
	 * @param $id
	 *
	 * @return mixed
	 */
	public function update(FileCategoryRequest $request, $id) {

		$category = Category::find($id);

		$category->update([
			'name' => $request->name,
			'slug' => str_slug($request->name)
		]);

		return redirect(route('admin.categories'))->withSuccess("Category updated.");
	}

}
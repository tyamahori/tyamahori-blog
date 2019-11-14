<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * CategoryController constructor.
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * カテゴリ一覧ページ画面
     * @return Factory|View
     */
    public function index()
    {
        return view('auth.category.index', [
            'categories' => $this->categoryService->getAllCategories(),
        ]);
    }

    /**
     * カテゴリの登録処理
     * @param CategoryRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryService->createCategoryData($request);
        return redirect(route('admin.category.index'));
    }

    /**
     * カテゴリ編集画面
     * @param Category $category
     * @return Factory|View
     */
    public function edit(Category $category)
    {
        return view('auth.category.edit', [
            'category' => $category,
        ]);
    }

    /**
     * カテゴリ更新処理
     * @param CategoryRequest $request
     * @return RedirectResponse|Redirector
     */
    public function update(CategoryRequest $request)
    {
        $this->categoryService->updateCategoryData($request);
        return redirect(route('admin.category.index'));
    }

    /**
     * カテゴリの削除画面
     * @param Category $category
     * @return Factory|View
     */
    public function delete(Category $category)
    {
        return view('auth.category.delete', [
            'category' => $category,
        ]);
    }

    /**
     * カテゴリの削除処理
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function destroy(Request $request)
    {
        $this->categoryService->deleteCategoryData($request);
        return redirect(route('admin.category.index'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\Category\Add as AddCategoryService;
use App\Services\Category\Delete as DeleteCategoryService;
use App\Services\Category\Lists as ListCategoryService;
use App\Services\Category\Show as ShowCategoryService;
use App\Services\Category\Update as UpdateCategoryService;
use App\ValueObject\CategoryId;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * カテゴリ一覧ページ画面
     * @param ListCategoryService $service
     * @return Factory|View
     */
    public function index(ListCategoryService $service)
    {
        return view('auth.category.index', [
            'categories' => $service->__invoke(),
        ]);
    }

    /**
     * カテゴリの登録処理
     * @param CategoryRequest $request
     * @param AddCategoryService $service
     * @return RedirectResponse|Redirector
     */
    public function store(CategoryRequest $request, AddCategoryService $service)
    {
        $service->__invoke($request->all());
        return redirect(route('admin.category.index'));
    }

    /**
     * カテゴリ編集画面
     * @param Request $request
     * @param ShowCategoryService $service
     * @return Factory|View
     */
    public function edit(Request $request, ShowCategoryService $service)
    {
        return view('auth.category.edit', [
            'category' => $service->__invoke(CategoryId::of($request->id)),
        ]);
    }

    /**
     * カテゴリ更新処理
     * @param CategoryRequest $request
     * @param UpdateCategoryService $service
     * @return RedirectResponse|Redirector
     */
    public function update(CategoryRequest $request, UpdateCategoryService $service)
    {
        $service->__invoke($request->all());
        return redirect(route('admin.category.index'));
    }

    /**
     * カテゴリの削除画面
     * @param Request $request
     * @param ShowCategoryService $service
     * @return Factory|View
     */
    public function delete(Request $request, ShowCategoryService $service)
    {
        return view('auth.category.delete', [
            'category' => $service->__invoke(CategoryId::of($request->id)),
        ]);
    }

    /**
     * カテゴリの削除処理
     * @param Request $request
     * @param DeleteCategoryService $service
     * @return RedirectResponse|Redirector
     */
    public function destroy(Request $request, DeleteCategoryService $service)
    {
        $service->__invoke(CategoryId::of($request->id));
        return redirect(route('admin.category.index'));
    }
}

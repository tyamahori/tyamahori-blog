<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditPostRequest;
use App\Http\Requests\NewPostRequest;
use App\Services\Category\Lists as ListCategoryService;
use App\Services\Post\Delete as DeletePostService;
use App\Services\Post\Lists as ListPostService;
use App\Services\Post\Show as ShowPostService;
use App\Services\Post\Add as AddPostService;
use App\Services\Tag\Lists as ListTagService;
use App\Services\Post\Update as UpdatePostService;
use App\ValueObject\PostId;
use App\ValueObject\PostIsPublic;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * 管理画面場で全ての投稿を表示するエンドポイント
     * @param ListPostService $service
     * @return Factory|View
     */
    public function index(ListPostService $service)
    {
        return view('auth.post.index', [
            'posts' => $service->__invoke(PostIsPublic::of(false), 100),
        ]);
    }

    /**
     * 投稿ページの表示
     * @param int $id
     * @param ShowPostService $service
     * @return Factory|View
     */
    public function show(int $id, ShowPostService $service)
    {
        return view('front.post', [
            'post' => $service->showAdmin(PostId::of($id)),
        ]);
    }

    /**
     * 新規作成画面
     * @param Request $request
     * @param ListCategoryService $categoryService
     * @param ListTagService $tagService
     * @return Factory|View
     */
    public function create(Request $request, ListCategoryService $categoryService, ListTagService $tagService)
    {
        return view('auth.post.create', [
            'categories'   => $categoryService->__invoke(),
            'tags'         => $tagService->__invoke(),
            'selectedTags' => $request->old('tags') ?? [],
        ]);
    }

    /**
     * @param NewPostRequest $request
     * @param AddPostService $service
     * @return RedirectResponse|Redirector
     */
    public function store(NewPostRequest $request, AddPostService $service)
    {
        $service->__invoke($request->all());
        return redirect(route('admin.post.index'));
    }

    /**
     * @param Request $request
     * @param ShowPostService $postService
     * @param ListCategoryService $categoryService
     * @param ListTagService $tagService
     * @return Factory|View
     */
    public function edit(Request $request, ShowPostService $postService, ListCategoryService $categoryService, ListTagService $tagService)
    {
        return view('auth.post.edit', [
            'post'               => $postService->showAdmin(PostId::of($request->id)),
            'categories'         => $categoryService->__invoke(),
            'tags'               => $tagService->__invoke(),
            'selectedCategoryId' => collect($request->old('category_id')),
            'selectedTagIds'     => collect($request->old('tags')),
        ]);
    }

    /**
     * 投稿の更新処理
     * @param EditPostRequest $request
     * @param UpdatePostService $service
     * @return RedirectResponse|Redirector
     */
    public function update(EditPostRequest $request, UpdatePostService $service)
    {
        $service->__invoke($request->all());
        return redirect(route('admin.post.edit', ['id' => $request->id]));
    }

    /**
     * 削除確認画面
     * @param int $id
     * @param ShowPostService $service
     * @return Factory|View
     */
    public function delete(int $id, ShowPostService $service)
    {
        return view('auth.post.delete', [
            'post' => $service->showAdmin(PostId::of($id)),
        ]);
    }

    /**
     * 投稿の削除処理
     * @param Request $request
     * @param DeletePostService $service
     * @return RedirectResponse|Redirector
     */
    public function destroy(Request $request, DeletePostService $service)
    {
        $service->__invoke(PostId::of($request->id));
        return redirect(route('admin.post.index'));
    }
}

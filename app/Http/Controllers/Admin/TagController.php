<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class TagController extends Controller
{
    /**
     * TagController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * タグ一覧ページ
     * @param Tag $tag
     * @return Factory|View
     */
    public function index(Tag $tag)
    {
        return view('auth.tag.index', [
            'tags' => $tag->all(),
        ]);
    }

    /**
     * タグの新規登録処理
     * @param TagRequest $request
     * @param Tag $tag
     * @return RedirectResponse|Redirector
     */
    public function store(TagRequest $request, Tag $tag)
    {
        $tag->nameColumnData = $request->tag;
        $tag->save();
        return redirect(route('admin.tag.index'));
    }

    /**
     * タグの編集画面表示
     * @param Tag $tag
     * @return Factory|View
     */
    public function edit(Tag $tag)
    {
        return view('auth.tag.edit', [
            'tag' => $tag,
        ]);
    }

    /**
     * タグの編集更新処理
     * @param TagRequest $request
     * @param Tag $tag
     * @return RedirectResponse|Redirector
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $tag->nameColumnData = $request->tag;
        $tag->save();
        return redirect(route('admin.tag.index'));
    }

    /**
     * タグの削除確認画面表示
     * @param Tag $tag
     * @return Factory|View
     */
    public function delete(Tag $tag)
    {
        return view('auth.tag.delete', [
            'tag' => $tag,
        ]);
    }

    /**
     * タグの削除処理
     * @param Tag $tag
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect(route('admin.tag.index'));
    }
}

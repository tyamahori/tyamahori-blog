<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Post\Lists as ListPostService;
use App\Services\Post\Show as ShowPostService;
use App\Services\SiteMap\Lists as ListSiteMapService;
use App\ValueObject\PostId;
use App\ValueObject\PostIsPublic;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Laravelium\Sitemap\Sitemap;

class HomeController extends Controller
{
    /**
     * トップーページの表示
     * @param ListPostService $service
     * @return Factory|View
     */
    public function index(ListPostService $service)
    {
        return view('front.welcome', [
            'posts' => $service->__invoke(PostIsPublic::of(true), 5),
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
            'post' => $service->showClient(PostId::of($id)),
        ]);
    }

    /**
     * profile page向けのエンドポイント
     * @param ShowPostService $service
     * @return Factory|View
     */
    public function profile(ShowPostService $service)
    {
        return view('front.post', [
            'post' => $service->__invoke(PostId::of(1)),
        ]);
    }

    /**
     * サイトマップ表示のためのエンドポイント
     * @param Sitemap $sitemap
     * @param ListSiteMapService $service
     * @return \Laravelium\Sitemap\View
     */
    public function sitemap(Sitemap $sitemap, ListSiteMapService $service)
    {
        $now = Carbon::now();

        $sitemap->add(url('/'), $now, '1.0', 'daily');
        $sitemap->add(url('/profile'), $now, '0.9', 'monthly');

        $posts = $service->__invoke();

        foreach ($posts as $post) {
            $sitemap->add(url($post->getId()->getValue()), $post->getUpdatedAt()->getValue(), 0.9, 'daily');
        }

        $sitemap->store('xml', 'sitemap');
        return $sitemap->render('sitemapindex');
    }
}

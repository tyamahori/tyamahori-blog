<?php

namespace App\Console\Commands;

use App\Services\SiteMap\Lists as ListSiteMapService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Laravelium\Sitemap\Sitemap;

class SiteMaps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SiteMap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create SiteMap';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param Sitemap $sitemap
     * @param ListSiteMapService $service
     * @return mixed
     */
    public function handle(Sitemap $sitemap, ListSiteMapService $service)
    {
        $sitemap->add(url('/'), Carbon::now(), '1.0', 'daily');
        $sitemap->add(url('/profile'), Carbon::now(), '0.9', 'monthly');

        $posts = $service->__invoke();

        foreach ($posts as $post) {
            $sitemap->add(url($post->getId()->getValue()), $post->getUpdatedAt()->getValue(), 0.9, 'daily');
        }

        $sitemap->store('xml', 'sitemap');
    }
}

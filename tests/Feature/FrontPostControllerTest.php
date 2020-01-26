<?php

namespace Tests\Feature;

use App\Eloquent\PostOrm;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class FrontPostControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
        $this->seed('DatabaseSeeder');
    }

    public function tearDown(): void
    {
        Artisan::call('migrate:refresh');
        parent::tearDown();
    }

    /**
     * @test
     * TOPページにアクセスをして200が返却されることを確認
     */
    public function isTopPageDisplayed(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function isProfilePageDisplayed(): void
    {
        $response = $this->get('/profile');
        $response->assertStatus(200);
    }

    /**
     * ログイン周りのテスト
     * @test
     */
    public function canLogin(): void
    {
        $user = factory(User::class)->create([
            'email'    => 'email@email.com',
            'password' => bcrypt('test0987'),
        ]);

        $this->assertFalse(Auth::check());

        $response = $this->post(route('login'), [
            'email'    => $user->email,
            'password' => 'test0987',
        ]);

        $this->assertTrue(Auth::check());

        $response->assertRedirect(route('admin.home'));
    }

    /**
     * ログインができないテスト
     * @test
     */
    public function cannotLogin(): void
    {
        factory(User::class)->create([
            'email'    => 'email@email.com',
            'password' => bcrypt('test0987'),
        ]);

        $this->assertFalse(Auth::check());

        $response = $this->post(route('login'), [
            'email'    => 'email@email.jp',
            'password' => 'test1234',
        ]);

        $this->assertFalse(Auth::check());

        $response->assertSessionHasErrors(['email']);
    }

    /**
     * @test
     * TOPページにてDBに登録されているコンテンツが見れるかのテスト
     */
    public function canSeePostDataOnTop(): void
    {
        $post = (new PostOrm())->latest()->first();

        $response = $this->get(route('home'));

        $response->assertSee($post->title_data);
        $response->assertSee($post->category_name);
    }
}

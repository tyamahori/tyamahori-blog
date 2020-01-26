<?php

namespace Tests\Unit;

use App\Eloquent\PostOrm;
use App\Entities\PostEntity;
use App\Interfaces\Repository\PostRepositoryInterface;
use App\Services\Post\Lists;
use App\ValueObject\PostIsPublic;
use Illuminate\Support\Facades\Artisan;
use Mockery;
use Tests\TestCase;

class ListsServiceTest extends TestCase
{
    /**
     * @var
     */
    private $mockEntity;
    private $mockRepository;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:refresh');

        // エンティティのモックを作成
        $this->mockEntity = factory(PostOrm::class, 'publicMockPostData', 50)
            ->make()
            ->map(static function (PostOrm $postOrm) {
                return new PostEntity($postOrm);
            });

        // リポジトリクラスのモック化
        $this->mockRepository = Mockery::mock(PostRepositoryInterface::class);
        $this->mockRepository
            ->shouldReceive('list')
            ->andReturn($this->mockEntity);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * ページネーションのテスト
     * @dataProvider getCanPaginateData
     * @test
     * @param bool $isPublic
     * @param int $perPage
     * @param int $total
     */
    public function canPaginate(bool $isPublic, int $perPage, int $total): void
    {
        $listService = new Lists($this->mockRepository);

        $paginate = $listService->__invoke(PostIsPublic::of($isPublic), $perPage);

        $this->assertSame($perPage, $paginate->perPage());
        $this->assertSame($total, $paginate->total());
    }

    /**
     * @return array
     */
    public function getCanPaginateData(): array
    {
        return [
            '非公開' => [false, 1, 50],
            '公開'  => [true, 1, 50],
        ];
    }
}

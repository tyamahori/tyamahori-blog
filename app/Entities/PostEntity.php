<?php


namespace App\Entities;

use App\Eloquent\PostOrm;
use App\Eloquent\TagOrm;
use App\Exceptions\ValueObjectError;
use App\Interfaces\Entity\PostInterface;
use App\ValueObject\CategoryId;
use App\ValueObject\CategoryName;
use App\ValueObject\Date;
use App\ValueObject\PostContent;
use App\ValueObject\PostDescription;
use App\ValueObject\PostId;
use App\ValueObject\PostIsPublic;
use App\ValueObject\PostTitle;
use Exception;
use Illuminate\Support\Collection;

class PostEntity implements PostInterface
{
    private $postOrm;

    /**
     * PostEntity constructor.
     * @param PostOrm $postOrm
     */
    public function __construct(PostOrm $postOrm)
    {
        $this->postOrm = $postOrm;
    }

    /**
     * IDを取得する
     * @return PostId
     */
    public function getId(): PostId
    {
        return PostId::of($this->postOrm->primary_key_data);
    }

    /**
     * タイトルを取得する
     * @return PostTitle
     * @throws ValueObjectError
     */
    public function getTitle(): PostTitle
    {
        return PostTitle::of($this->postOrm->title_data);
    }

    /**
     * 投稿のディスクリプションを取得する
     * @return PostDescription
     * @throws ValueObjectError
     */
    public function getDescription(): PostDescription
    {
        return PostDescription::of($this->postOrm->description_data);
    }

    /**
     * htmlにパースされた投稿を取得する
     * @return PostContent
     * @throws ValueObjectError
     */
    public function getParsedContent(): PostContent
    {
        return PostContent::of($this->postOrm->parsed_content_data);
    }

    /**
     * @return CategoryId
     */
    public function getCategoryId(): CategoryId
    {
        return CategoryId::of($this->postOrm->category_id_data);
    }

    /**
     * @return Collection
     */
    public function getTags(): Collection
    {
        return $this->postOrm->tags
            ->map(static function (TagOrm $tagOrm) {
                return new TagEntity($tagOrm);
            });
    }

    /**
     * 投稿が公開かどうかを確認する
     * @return PostIsPublic
     */
    public function isPublic(): PostIsPublic
    {
        return PostIsPublic::of($this->postOrm->published_flag_data);
    }

    /**
     * カテゴリ名を取得する
     * @return CategoryName
     * @throws ValueObjectError
     */
    public function getCategoryName(): CategoryName
    {
        return CategoryName::of($this->postOrm->category->name_data);
    }

    /**
     * 更新日時を取得する
     * @return Date
     */
    public function getUpdatedAt(): Date
    {
        return Date::of($this->postOrm->updated_at_data);
    }

    /**
     * 作成日時を取得する
     * @return Date
     */
    public function getCreatedAt(): Date
    {
        return Date::of($this->postOrm->created_at_data);
    }

    /**
     * マークダウン形式の本文を取得する
     * @return PostContent
     * @throws ValueObjectError
     */
    public function getMarkdownContent(): PostContent
    {
        return PostContent::of($this->postOrm->mark_down_content_data);
    }

    /**
     * 選択されているタグIDのみを配列で取得する
     */
    public function getTagIds(): Collection
    {
        return $this->postOrm->tags
            ->map(static function (TagOrm $tagOrm) {
                return $tagOrm->primary_key_data;
            });
    }

    /**
     * タグの紐付け設定の処理
     * @param array $tags
     */
    public function syncTags(array $tags): void
    {
        $this->postOrm->tags()->sync($tags);
    }

    /**
     * タイトルを格納するメソッド
     * @param PostTitle $title
     */
    public function setTitle(PostTitle $title): void
    {
        $this->postOrm->title_data = $title->getValue();
    }

    /**
     * ディスクリプションを格納するメソッド
     * @param PostDescription $description
     */
    public function setDescription(PostDescription $description): void
    {
        $this->postOrm->description_data = $description->getValue();
    }

    /**
     * カテゴリIDを設定するメソッド
     * @param CategoryId $categoryId
     */
    public function setCategoryId(CategoryId $categoryId): void
    {
        $this->postOrm->category_id_data = $categoryId->getValue();
    }

    /**
     * 投稿本文を格納するメソッド
     * @param PostContent $content
     */
    public function setBody(PostContent $content): void
    {
        $this->postOrm->body_data = $content->getValue();
    }

    /**
     * 公開フラグを設定するメソッド
     * @param PostIsPublic $isPublic
     */
    public function setPublished(PostIsPublic $isPublic): void
    {
        $this->postOrm->published_data = $isPublic->getValue();
    }

    /**
     * Entityに内包されているORMを取得する
     * @return PostOrm
     */
    public function getPostOrm(): PostOrm
    {
        return $this->postOrm;
    }

    /**
     * 削除するメソッド
     * @throws Exception
     */
    public function delete(): void
    {
        $this->postOrm->delete();
    }
}
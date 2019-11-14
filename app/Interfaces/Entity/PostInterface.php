<?php


namespace App\Interfaces\Entity;


use App\Eloquent\PostOrm;
use App\ValueObject\CategoryId;
use App\ValueObject\CategoryName;
use App\ValueObject\Date;
use App\ValueObject\PostContent;
use App\ValueObject\PostDescription;
use App\ValueObject\PostId;
use App\ValueObject\PostIsPublic;
use App\ValueObject\PostTitle;
use Illuminate\Support\Collection;

interface PostInterface
{
    /**
     * IDを取得する
     * @return PostId
     */
    public function getId(): PostId;

    /**
     * titleを取得する
     * @return PostTitle
     */
    public function getTitle(): PostTitle;

    /**
     * @return PostDescription
     */
    public function getDescription(): PostDescription;

    /**
     * カテゴリIDを取得する
     * @return CategoryId
     */
    public function getCategoryId(): CategoryId;

    /**
     * カテゴリ名を取得する
     * @return CategoryName
     */
    public function getCategoryName(): CategoryName;

    /**
     * @return Collection
     */
    public function getTags(): Collection;

    /**
     * 更新日時を取得する
     * @return Date
     */
    public function getUpdatedAt(): Date;

    /**
     * 作成日時を取得する
     * @return Date
     */
    public function getCreatedAt(): Date;

    /**
     * 投稿の本文を取得する
     * @return PostContent
     */
    public function getParsedContent(): PostContent;

    /**
     * マークダウン形式の本文を取得する
     * @return PostContent
     */
    public function getMarkdownContent(): PostContent;

    /**
     * 選択されているタグIDのみを配列で取得する
     *
     */
    public function getTagIds(): Collection;

    /**
     * Entityに内包されているORMを取得する
     * @return PostOrm
     */
    public function getPostOrm(): PostOrm;

    /**
     * タグの紐付け設定の処理
     * @param array $tags
     */
    public function syncTags(array $tags): void;

    /**
     * タイトルを格納するメソッド
     * @param PostTitle $title
     */
    public function setTitle(PostTitle $title): void;

    /**
     * ディスクリプションを格納するメソッド
     * @param PostDescription $description
     */
    public function setDescription(PostDescription $description): void;

    /**
     * カテゴリIDを格納するメソッド
     * @param CategoryId $categoryId
     */
    public function setCategoryId(CategoryId $categoryId): void;

    /**
     * 投稿本文を格納するメソッド
     * @param PostContent $content
     */
    public function setBody(PostContent $content): void;

    /**
     * 公開フラグを設定するメソッド
     * @param PostIsPublic $isPublic
     */
    public function setPublished(PostIsPublic $isPublic): void;


    /**
     * 削除するメソッド
     */
    public function delete(): void;
}
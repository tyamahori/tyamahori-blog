<?php

namespace App\Eloquent;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Parsedown;

class PostOrm extends Model
{
    /**
     * 論理削除の利用設定
     */
    use SoftDeletes;

    /**
     * テーブル名との紐付け
     * @var string
     */
    protected $table = 'posts';

    /**
     * データの入力を受け付けるカラムを設定
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'post',
        'published',
        'category_id',
    ];

    /**
     * primary key として使うカラム名
     */
    protected const PRIMARY_KEY_COLUMN = 'id';

    /**
     * タイトルとして使うカラム名
     */
    protected const TITLE_COLUMN = 'title';

    /**
     * ブログの要約部分に使うカラム名
     */
    protected const DESCRIPTION_COLUMN = 'description';

    /**
     * ブログの本文に使うカラム名
     */
    protected const BODY_COLUMN = 'post';

    /**
     * ブログの公開非公開に使用する判定フラグのカラム名
     */
    protected const PUBLISHED_COLUMN = 'published';

    /**
     * カテゴリのIDを設定するカラム名
     */
    protected const CATEGORY_COLUMN = 'category_id';

    /**
     * deleted_at を設定するカラム名
     */
    protected const DELETED_AT_COLUMN = 'deleted_at';

    protected const CREATED_AT_COLUMN = 'created_at';

    protected const UPDATED_AT_COLUMN = 'updated_at';

    /**
     * primary key のカラム名を返すメソッド
     * @return string
     */
    public static function getPrimaryKeyColumn(): string
    {
        return self::PRIMARY_KEY_COLUMN;
    }

    /**
     * ブログのタイトルに使われるカラム名を返すメソッド
     * @return string
     */
    public static function getTitleColumn(): string
    {
        return self::TITLE_COLUMN;
    }

    /**
     * ブログのディスクリプションに使われるカラム名を返すメソッド
     * @return string
     */
    public static function getDescriptionColumn(): string
    {
        return self::DESCRIPTION_COLUMN;
    }

    /**
     * ブログの公開非公開フラグに使われるカラム名を返すメソッド
     * @return string
     */
    public static function getPublishedColumn(): string
    {
        return self::PUBLISHED_COLUMN;
    }

    /**
     * カテゴリidを格納するカラム名を返すメソッド
     * @return string
     */
    public static function getCategoryColumn(): string
    {
        return self::CATEGORY_COLUMN;
    }

    /**
     * ブログの本文を格納するカラム名を返すメソッド
     * @return string
     */
    public static function getBodyColumn(): string
    {
        return self::BODY_COLUMN;
    }

    /**
     * created_atカラムを返す
     * @return string
     */
    public static function getCreatedAtColumnName(): string
    {
        return self::CREATED_AT_COLUMN;
    }

    /**
     * deleted_atカラムを返す
     * @return string
     */
    public static function getDeletedAtColumn(): string
    {
        return self::DELETED_AT_COLUMN;
    }

    /**
     * カテゴリテーブルとのリレーション
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->BelongsTo(CategoryOrm::class, self::getCategoryColumn(), CategoryOrm::getPrimaryKeyColumn())->withDefault();
    }

    /**
     * タグテーブルとのリレーション
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(TagOrm::class, 'post_tag', 'post_id', 'tag_id');
    }

    /**
     * 公開されてい投稿を取得する
     * @param $query
     * @return mixed
     */
    public function scopeOfPublic($query)
    {
        return $query->where(self::getPublishedColumn(), true);
    }

    /**
     * primary key を取得するアクセサ
     * @return int
     */
    public function getPrimaryKeyDataAttribute(): int
    {
        return (int) $this->attributes[self::getPrimaryKeyColumn()];
    }

    /**
     * titleを取得するアクセサ
     * @return string
     */
    public function getTitleDataAttribute(): string
    {
        return $this->attributes[self::getTitleColumn()];
    }

    /**
     * ディスクリプションを取得するアクセサ
     * @return string
     */
    public function getDescriptionDataAttribute(): string
    {
        return $this->attributes[self::getDescriptionColumn()];
    }

    /**
     * 投稿本文をパースした状態で取得するアクセサ
     * @return string
     */
    public function getParsedContentDataAttribute(): string
    {
        return Parsedown::instance()->text($this->attributes[self::getBodyColumn()]);
    }

    /**
     * Markdown形式のまま投稿データを取得するアクセサ
     * @return string
     */
    public function getMarkDownContentDataAttribute(): string
    {
        return $this->attributes[self::getBodyColumn()];
    }

    /**
     * categoryのidデータを取得するアクセサ
     * @return int
     */
    public function getCategoryIdDataAttribute(): int
    {
        return (int) $this->attributes[self::getCategoryColumn()];
    }

    /**
     * 公開非公開フラグの値を取得するアクセサ
     * @return bool
     */
    public function getPublishedFlagDataAttribute(): bool
    {
        return (bool) $this->attributes[self::getPublishedColumn()];
    }

    /**
     * created_at のデータを返すアクセサ
     * @return Carbon
     * @throws \Exception
     */
    public function getCreatedAtDataAttribute(): Carbon
    {
        return new Carbon($this->attributes[$this->getCreatedAtColumn()]);
    }

    /**
     * updated_at のデータを返すアクセサ
     * @return Carbon
     * @throws \Exception
     */
    public function getUpdatedAtDataAttribute(): Carbon
    {
        return new Carbon($this->attributes[$this->getUpdatedAtColumn()]);
    }

    /**
     * deleted_at のデータを返すアクセサ
     * @return string|null
     */
    public function getDeletedAtDataAttribute(): ?string
    {
        return $this->attributes[self::getDeletedAtColumn()];
    }

    /**
     * タイトルを設定するミューテタ
     * @param $value
     */
    public function setTitleDataAttribute($value): void
    {
        $this->attributes[self::getTitleColumn()] = $value;
    }

    /**
     * ディスクリプションを設定するミューテタ
     * @param $value
     */
    public function setDescriptionDataAttribute($value): void
    {
        $this->attributes[self::getPublishedColumn()] = $value;
    }

    /**
     * category_idを格納するミューテタ
     * @param $value
     */
    public function setCategoryIdDataAttribute($value): void
    {
        $this->attributes[self::getCategoryColumn()] = $value;
    }

    /**
     * bodyカラムを格納するミューテタ
     * @param $value
     */
    public function setBodyDataAttribute($value): void
    {
        $this->attributes[self::getBodyColumn()] = $value;
    }

    /**
     * 公開非公開フラグのデータを格納するミューテタ
     * @param $value
     */
    public function setPublishedDataAttribute($value): void
    {
        $this->attributes[self::getPublishedColumn()] = $value;
    }
}

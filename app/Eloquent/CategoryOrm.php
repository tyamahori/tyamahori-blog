<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryOrm extends Model
{
    /**
     * 論理削除の利用設定
     */
    use SoftDeletes;

    /**
     * テーブル名との紐付け
     * @var string
     */
    protected $table = 'categories';

    /**
     * created_at, updated_atを利用しない設定
     * @var bool
     */
    public $timestamps = false;

    /**
     * date型を利用する設定
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * データの挿入を受け付けるカラム設定
     * @var array
     */
    protected $fillable = [
        'category'
    ];

    /**
     * primary keyのカラム名
     */
    protected const PRIMARY_KEY_COLUMN = 'id';

    /**
     * カテゴリ名を設定するカラム名
     */
    protected const NAME_COLUMN = 'category';

    /**
     * 論理削除に使用するカラム名
     */
    protected const DELETED_AT_COLUMN = 'deleted_at';

    /**
     * postsテーブルとのリレーション
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(PostOrm::class);
    }

    /**
     * primary key のカラム名を返す
     * @return string
     */
    public static function getPrimaryKeyColumn(): string
    {
        return self::PRIMARY_KEY_COLUMN;
    }

    /**
     * カテゴリ名を設定しているカラムを取得する
     * @return string
     */
    public static function getNameColumn(): string
    {
        return self::NAME_COLUMN;
    }

    /**
     * 論理削除に使用しているカラム名を取得する
     * @return string
     */
    public static function getDeletedAtColumn(): string
    {
        return self::DELETED_AT_COLUMN;
    }

    /**
     * primary keyのデータを取得するアクセサ
     * @return int
     */
    public function getPrimaryKeyDataAttribute(): int
    {
        return (int) $this->attributes[self::getPrimaryKeyColumn()];
    }

    /**
     * カテゴリ名を取得するアクセサ
     * @return string
     */
    public function getNameDataAttribute(): string
    {
        return $this->attributes[self::getNameColumn()];
    }

    /**
     * カテゴリ名を設定するミューテタ
     * @param $value
     */
    public function setNameDataAttribute($value): void
    {
        $this->attributes[self::getNameColumn()] = $value;
    }
}

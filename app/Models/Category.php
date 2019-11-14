<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    /**
     * 論理削除の利用設定
     */
    use SoftDeletes;

    /**
     * created_at, updated_atを利用しない設定
     * @var bool
     */
    public $timestamps = false;

    /**
     * date型を利用する設定
     * @var array
     */
    protected $dates = [];

    /**
     * データの挿入を受け付けるカラム設定
     * @var array
     */
    protected $fillable = [];

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
     * Category constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setFillable();
        $this->setDates();
    }

    /**
     * $fillableを定義する関数
     * constructor内部で使用する
     */
    public function setFillable(): void
    {
        $this->fillable = [
            self::getNameColumn(),
        ];
    }

    /**
     * $datesを定義する関数
     * constructor内部で使用する
     */
    public function setDates(): void
    {
        $this->dates = [
            self::getDeletedAtColumn(),
        ];
    }

    /**
     * Postモデルとのリレーション
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * primary key のカラム名を返す
     * @return string
     */
    public static function getPrimaryKeyColumnName(): string
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
     * @return mixed
     */
    public function getPrimaryKeyDataAttribute()
    {
        return $this->attributes[self::getPrimaryKeyColumnName()];
    }

    /**
     * カテゴリ名を取得するアクセサ
     * @return mixed
     */
    public function getNameColumnDataAttribute()
    {
        return $this->attributes[self::getNameColumn()];
    }

    /**
     * カテゴリ名を登録するミューテタ
     * @param $value
     */
    public function setNameColumnDataAttribute($value): void
    {
        $this->attributes[self::getNameColumn()] = $value;
    }
}

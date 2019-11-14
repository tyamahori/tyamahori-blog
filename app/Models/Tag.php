<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    /**
     * 論理削除の利用設定
     */
    use SoftDeletes;

    /**
     * タグテーブルのプライマリーキーを格納するカラム名を定義
     */
    protected const ID_COLUMN = 'id';

    /**
     * タグ名の格納するカラム名を定義
     */
    protected const NAME_COLUMN = 'name';

    /**
     * 論理削除用のカラム名を定義
     */
    protected const DELETED_AT_COLUMN = 'deleted_at';

    /**
     * created_at, updated_atを使用しない設定
     * @var bool
     */
    public $timestamps = false;

    /**
     * date型を使用する設定
     * @var array
     */
    protected $dates = [];

    /**
     * データ挿入可能なカラムを配列で設定
     * @var array
     */
    protected $fillable = [];

    /**
     * Tag constructor.
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
     * Postテーブルとのリレーション
     *
     * @return BelongsToMany
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * タグテーブルのプライマリーキーのカラム名を返す
     * @return string
     */
    public static function getIdColumn(): string
    {
        return self::ID_COLUMN;
    }

    /**
     * タグテーブルのnameを設定しているカラム名を返す
     * @return string
     */
    public static function getNameColumn(): string
    {
        return self::NAME_COLUMN;
    }

    /**
     * タグデーブルのdeleted_atのカラム名を返す
     *
     * @return string
     */
    public static function getDeletedAtColumn(): string
    {
        return self::DELETED_AT_COLUMN;
    }

    /**
     * primary keyカラムのデータを取得するアクセサ
     * @return mixed
     */
    public function getPrimaryKeyColumnDataAttribute()
    {
        return $this->attributes[self::getIdColumn()];
    }

    /**
     * nameカラムのデータを取得するアクセサ
     * @return string
     */
    public function getNameColumnDataAttribute(): string
    {
        return $this->attributes[self::getNameColumn()];
    }

    /**
     * nameカラムにデータを格納するミューテタ
     * @param $value
     */
    public function setNameColumnDataAttribute($value): void
    {
        $this->attributes[self::getNameColumn()] = $value;
    }
}

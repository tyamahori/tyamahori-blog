<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagOrm extends Model
{
    protected $table = 'tags';

    /**
     * 論理削除の利用設定
     */
    use SoftDeletes;

    /**
     * タグテーブルのプライマリーキーを格納するカラム名を定義
     */
    protected const PRIMARY_KEY_COLUMN = 'id';

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
     * データ挿入可能なカラムを配列で設定
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Postテーブルとのリレーション
     *
     * @return BelongsToMany
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(PostOrm::class);
    }

    /**
     * primary key のカラム名を返すメソッド
     * @return string
     */
    public static function getPrimaryKeyColumn(): string
    {
        return self::PRIMARY_KEY_COLUMN;
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
     * @return string|null
     */
    public static function getDeletedAtColumn(): ?string
    {
        return self::DELETED_AT_COLUMN;
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
     * タグ名を取得するアクセサ
     * @return string
     */
    public function getNameDataAttribute(): string
    {
        return $this->attributes[self::getNameColumn()];
    }

    /**
     * deleted_atを取得するアクセサ
     * @return string|null
     */
    public function getDeletedAtAttribute(): ?string
    {
        return $this->attributes[self::getDeletedAtColumn()];
    }
}

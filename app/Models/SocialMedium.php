<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialMedium extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const TYPE_SELECT = [
        'FACEBOOK'      => 'Facebook',
        'INSTAGRAM'     => 'Instagram',
        'WHATSAPP'      => 'Whatsapp',
        'WECHAT'        => 'Wechat',
        'YOUTUBE'       => 'YouTube',
        'DOUYIN'        => 'Douyin',
        'TIKTOK'        => 'Tiktok',
        'XIAO_HONG_SHU' => 'Xiao Hong Shu',
    ];

    public $table = 'social_media';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'contact_card_id',
        'type',
        'link',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function contact_card()
    {
        return $this->belongsTo(ContactCard::class, 'contact_card_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

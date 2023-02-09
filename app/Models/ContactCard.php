<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ContactCard extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public $table = 'contact_cards';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'banner_image',
        'profile_image',
        'gallery',
    ];

    protected $fillable = [
        'url_slug',
        'first_name',
        'last_name',
        'company_name',
        'company_position',
        'company_website',
        'email',
        'handphone_number',
        'office_phone_number',
        'facebook_url',
        'instagram_url',
        'whatsapp_number',
        'wechat',
        'youtube_url',
        'tiktok',
        'douyin',
        'xiao_hong_shu',
        'slogan',
        'mission',
        'vision',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function contactCardSocialMedia()
    {
        return $this->hasMany(SocialMedium::class, 'contact_card_id', 'id');
    }

    public function getBannerImageAttribute()
    {
        $file = $this->getMedia('banner_image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getProfileImageAttribute()
    {
        $file = $this->getMedia('profile_image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getGalleryAttribute()
    {
        return $this->getMedia('gallery');
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

<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                           => 'ID',
            'id_helper'                    => ' ',
            'name'                         => 'Name',
            'name_helper'                  => ' ',
            'email'                        => 'Email',
            'email_helper'                 => ' ',
            'email_verified_at'            => 'Email verified at',
            'email_verified_at_helper'     => ' ',
            'password'                     => 'Password',
            'password_helper'              => ' ',
            'roles'                        => 'Roles',
            'roles_helper'                 => ' ',
            'remember_token'               => 'Remember Token',
            'remember_token_helper'        => ' ',
            'created_at'                   => 'Created at',
            'created_at_helper'            => ' ',
            'updated_at'                   => 'Updated at',
            'updated_at_helper'            => ' ',
            'deleted_at'                   => 'Deleted at',
            'deleted_at_helper'            => ' ',
            'approved'                     => 'Approved',
            'approved_helper'              => ' ',
            'verified'                     => 'Verified',
            'verified_helper'              => ' ',
            'verified_at'                  => 'Verified at',
            'verified_at_helper'           => ' ',
            'verification_token'           => 'Verification token',
            'verification_token_helper'    => ' ',
            'two_factor'                   => 'Two-Factor Auth',
            'two_factor_helper'            => ' ',
            'two_factor_code'              => 'Two-factor code',
            'two_factor_code_helper'       => ' ',
            'two_factor_expires_at'        => 'Two-factor expires at',
            'two_factor_expires_at_helper' => ' ',
        ],
    ],
    'auditLog' => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'contactCard' => [
        'title'          => 'Contact Card',
        'title_singular' => 'Contact Card',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'first_name'                 => 'First Name',
            'first_name_helper'          => ' ',
            'last_name'                  => 'Last Name',
            'last_name_helper'           => ' ',
            'company_name'               => 'Company Name',
            'company_name_helper'        => ' ',
            'company_position'           => 'Company Position',
            'company_position_helper'    => ' ',
            'company_website'            => 'Company Website',
            'company_website_helper'     => ' ',
            'email'                      => 'Email',
            'email_helper'               => ' ',
            'handphone_number'           => 'Handphone Number',
            'handphone_number_helper'    => ' ',
            'office_phone_number'        => 'Office Phone Number',
            'office_phone_number_helper' => ' ',
            'facebook_url'               => 'Facebook Url',
            'facebook_url_helper'        => ' ',
            'instagram_url'              => 'Instagram Url',
            'instagram_url_helper'       => ' ',
            'whatsapp_number'            => 'Whatsapp Number',
            'whatsapp_number_helper'     => ' ',
            'wechat'                     => 'Wechat',
            'wechat_helper'              => ' ',
            'youtube_url'                => 'Youtube Url',
            'youtube_url_helper'         => ' ',
            'tiktok'                     => 'Tiktok',
            'tiktok_helper'              => ' ',
            'xiao_hong_shu'              => 'Xiao Hong Shu',
            'xiao_hong_shu_helper'       => ' ',
            'slogan'                     => 'Slogan',
            'slogan_helper'              => ' ',
            'mission'                    => 'Mission',
            'mission_helper'             => ' ',
            'vision'                     => 'Vision',
            'vision_helper'              => ' ',
            'banner_image'               => 'Banner Image',
            'banner_image_helper'        => ' ',
            'profile_image'              => 'Profile Image',
            'profile_image_helper'       => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
            'created_by'                 => 'Created By',
            'created_by_helper'          => ' ',
            'gallery'                    => 'Gallery',
            'gallery_helper'             => ' ',
            'url_slug'                   => 'Url Slug',
            'url_slug_helper'            => ' ',
            'douyin'                     => 'Douyin',
            'douyin_helper'              => ' ',
        ],
    ],
    'socialMedium' => [
        'title'          => 'Social Media',
        'title_singular' => 'Social Medium',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'contact_card'        => 'Contact Card',
            'contact_card_helper' => ' ',
            'type'                => 'Type',
            'type_helper'         => ' ',
            'link'                => 'Link',
            'link_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'created_by'          => 'Created By',
            'created_by_helper'   => ' ',
        ],
    ],
    'photo' => [
        'title'          => 'Photo',
        'title_singular' => 'Photo',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'contact_card'        => 'Contact Card',
            'contact_card_helper' => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'created_by'          => 'Created By',
            'created_by_helper'   => ' ',
            'photo'               => 'Photo',
            'photo_helper'        => ' ',
        ],
    ],
];

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyContactCardRequest;
use App\Http\Requests\StoreContactCardRequest;
use App\Http\Requests\UpdateContactCardRequest;
use App\Models\ContactCard;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ContactCardController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('contact_card_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ContactCard::with(['created_by'])->select(sprintf('%s.*', (new ContactCard())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'contact_card_show';
                $editGate = 'contact_card_edit';
                $deleteGate = 'contact_card_delete';
                $crudRoutePart = 'contact-cards';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : '';
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : '';
            });
            $table->editColumn('company_name', function ($row) {
                return $row->company_name ? $row->company_name : '';
            });
            $table->editColumn('company_position', function ($row) {
                return $row->company_position ? $row->company_position : '';
            });
            $table->editColumn('company_website', function ($row) {
                return $row->company_website ? $row->company_website : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('handphone_number', function ($row) {
                return $row->handphone_number ? $row->handphone_number : '';
            });
            $table->editColumn('office_phone_number', function ($row) {
                return $row->office_phone_number ? $row->office_phone_number : '';
            });
            $table->editColumn('facebook_url', function ($row) {
                return $row->facebook_url ? $row->facebook_url : '';
            });
            $table->editColumn('instagram_url', function ($row) {
                return $row->instagram_url ? $row->instagram_url : '';
            });
            $table->editColumn('whatsapp_number', function ($row) {
                return $row->whatsapp_number ? $row->whatsapp_number : '';
            });
            $table->editColumn('wechat', function ($row) {
                return $row->wechat ? $row->wechat : '';
            });
            $table->editColumn('youtube_url', function ($row) {
                return $row->youtube_url ? $row->youtube_url : '';
            });
            $table->editColumn('tiktok', function ($row) {
                return $row->tiktok ? $row->tiktok : '';
            });
            $table->editColumn('xiao_hong_shu', function ($row) {
                return $row->xiao_hong_shu ? $row->xiao_hong_shu : '';
            });
            $table->editColumn('slogan', function ($row) {
                return $row->slogan ? $row->slogan : '';
            });
            $table->editColumn('mission', function ($row) {
                return $row->mission ? $row->mission : '';
            });
            $table->editColumn('vision', function ($row) {
                return $row->vision ? $row->vision : '';
            });
            $table->editColumn('banner_image', function ($row) {
                if ($photo = $row->banner_image) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('profile_image', function ($row) {
                if ($photo = $row->profile_image) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('gallery', function ($row) {
                if (!$row->gallery) {
                    return '';
                }
                $links = [];
                foreach ($row->gallery as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'banner_image', 'profile_image', 'gallery']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.contactCards.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('contact_card_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contactCards.create');
    }

    public function store(StoreContactCardRequest $request)
    {
        $contactCard = ContactCard::create($request->all());

        if ($request->input('banner_image', false)) {
            $contactCard->addMedia(storage_path('tmp/uploads/' . basename($request->input('banner_image'))))->toMediaCollection('banner_image');
        }

        if ($request->input('profile_image', false)) {
            $contactCard->addMedia(storage_path('tmp/uploads/' . basename($request->input('profile_image'))))->toMediaCollection('profile_image');
        }

        foreach ($request->input('gallery', []) as $file) {
            $contactCard->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $contactCard->id]);
        }

        return redirect()->route('admin.contact-cards.index');
    }

    public function edit(ContactCard $contactCard)
    {
        abort_if(Gate::denies('contact_card_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactCard->load('created_by');

        return view('admin.contactCards.edit', compact('contactCard'));
    }

    public function update(UpdateContactCardRequest $request, ContactCard $contactCard)
    {
        $contactCard->update($request->all());

        if ($request->input('banner_image', false)) {
            if (!$contactCard->banner_image || $request->input('banner_image') !== $contactCard->banner_image->file_name) {
                if ($contactCard->banner_image) {
                    $contactCard->banner_image->delete();
                }
                $contactCard->addMedia(storage_path('tmp/uploads/' . basename($request->input('banner_image'))))->toMediaCollection('banner_image');
            }
        } elseif ($contactCard->banner_image) {
            $contactCard->banner_image->delete();
        }

        if ($request->input('profile_image', false)) {
            if (!$contactCard->profile_image || $request->input('profile_image') !== $contactCard->profile_image->file_name) {
                if ($contactCard->profile_image) {
                    $contactCard->profile_image->delete();
                }
                $contactCard->addMedia(storage_path('tmp/uploads/' . basename($request->input('profile_image'))))->toMediaCollection('profile_image');
            }
        } elseif ($contactCard->profile_image) {
            $contactCard->profile_image->delete();
        }

        if (count($contactCard->gallery) > 0) {
            foreach ($contactCard->gallery as $media) {
                if (!in_array($media->file_name, $request->input('gallery', []))) {
                    $media->delete();
                }
            }
        }
        $media = $contactCard->gallery->pluck('file_name')->toArray();
        foreach ($request->input('gallery', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $contactCard->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery');
            }
        }

        return redirect()->route('admin.contact-cards.index');
    }

    public function show(ContactCard $contactCard)
    {
        abort_if(Gate::denies('contact_card_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactCard->load('created_by');

        return view('admin.contactCards.show', compact('contactCard'));
    }

    public function destroy(ContactCard $contactCard)
    {
        abort_if(Gate::denies('contact_card_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactCard->delete();

        return back();
    }

    public function massDestroy(MassDestroyContactCardRequest $request)
    {
        ContactCard::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('contact_card_create') && Gate::denies('contact_card_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ContactCard();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPhotoRequest;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Models\ContactCard;
use App\Models\Photo;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PhotoController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('photo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Photo::with(['contact_card', 'created_by'])->select(sprintf('%s.*', (new Photo())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'photo_show';
                $editGate = 'photo_edit';
                $deleteGate = 'photo_delete';
                $crudRoutePart = 'photos';

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
            $table->addColumn('contact_card_email', function ($row) {
                return $row->contact_card ? $row->contact_card->email : '';
            });

            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'contact_card', 'photo']);

            return $table->make(true);
        }

        $contact_cards = ContactCard::get();
        $users         = User::get();

        return view('admin.photos.index', compact('contact_cards', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('photo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact_cards = ContactCard::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.photos.create', compact('contact_cards'));
    }

    public function store(StorePhotoRequest $request)
    {
        $photo = Photo::create($request->all());

        if ($request->input('photo', false)) {
            $photo->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $photo->id]);
        }

        return redirect()->route('admin.photos.index');
    }

    public function edit(Photo $photo)
    {
        abort_if(Gate::denies('photo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact_cards = ContactCard::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $photo->load('contact_card', 'created_by');

        return view('admin.photos.edit', compact('contact_cards', 'photo'));
    }

    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        $photo->update($request->all());

        if ($request->input('photo', false)) {
            if (!$photo->photo || $request->input('photo') !== $photo->photo->file_name) {
                if ($photo->photo) {
                    $photo->photo->delete();
                }
                $photo->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($photo->photo) {
            $photo->photo->delete();
        }

        return redirect()->route('admin.photos.index');
    }

    public function show(Photo $photo)
    {
        abort_if(Gate::denies('photo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $photo->load('contact_card', 'created_by');

        return view('admin.photos.show', compact('photo'));
    }

    public function destroy(Photo $photo)
    {
        abort_if(Gate::denies('photo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $photo->delete();

        return back();
    }

    public function massDestroy(MassDestroyPhotoRequest $request)
    {
        Photo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('photo_create') && Gate::denies('photo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Photo();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Http\Resources\Admin\PhotoResource;
use App\Models\Photo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PhotoApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('photo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PhotoResource(Photo::with(['contact_card', 'created_by'])->get());
    }

    public function store(StorePhotoRequest $request)
    {
        $photo = Photo::create($request->all());

        if ($request->input('photo', false)) {
            $photo->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new PhotoResource($photo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Photo $photo)
    {
        abort_if(Gate::denies('photo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PhotoResource($photo->load(['contact_card', 'created_by']));
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

        return (new PhotoResource($photo))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Photo $photo)
    {
        abort_if(Gate::denies('photo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $photo->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

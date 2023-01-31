<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreContactCardRequest;
use App\Http\Requests\UpdateContactCardRequest;
use App\Http\Resources\Admin\ContactCardResource;
use App\Models\ContactCard;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactCardApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('contact_card_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContactCardResource(ContactCard::with(['created_by'])->get());
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

        return (new ContactCardResource($contactCard))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ContactCard $contactCard)
    {
        abort_if(Gate::denies('contact_card_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContactCardResource($contactCard->load(['created_by']));
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

        return (new ContactCardResource($contactCard))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ContactCard $contactCard)
    {
        abort_if(Gate::denies('contact_card_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactCard->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

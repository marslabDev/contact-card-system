<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSocialMediumRequest;
use App\Http\Requests\UpdateSocialMediumRequest;
use App\Http\Resources\Admin\SocialMediumResource;
use App\Models\SocialMedium;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SocialMediaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('social_medium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SocialMediumResource(SocialMedium::with(['contact_card', 'created_by'])->get());
    }

    public function store(StoreSocialMediumRequest $request)
    {
        $socialMedium = SocialMedium::create($request->all());

        return (new SocialMediumResource($socialMedium))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SocialMedium $socialMedium)
    {
        abort_if(Gate::denies('social_medium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SocialMediumResource($socialMedium->load(['contact_card', 'created_by']));
    }

    public function update(UpdateSocialMediumRequest $request, SocialMedium $socialMedium)
    {
        $socialMedium->update($request->all());

        return (new SocialMediumResource($socialMedium))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SocialMedium $socialMedium)
    {
        abort_if(Gate::denies('social_medium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $socialMedium->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

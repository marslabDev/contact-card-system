<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySocialMediumRequest;
use App\Http\Requests\StoreSocialMediumRequest;
use App\Http\Requests\UpdateSocialMediumRequest;
use App\Models\ContactCard;
use App\Models\SocialMedium;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SocialMediaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('social_medium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SocialMedium::with(['contact_card', 'created_by'])->select(sprintf('%s.*', (new SocialMedium())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'social_medium_show';
                $editGate = 'social_medium_edit';
                $deleteGate = 'social_medium_delete';
                $crudRoutePart = 'social-media';

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

            $table->editColumn('type', function ($row) {
                return $row->type ? SocialMedium::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'contact_card']);

            return $table->make(true);
        }

        $contact_cards = ContactCard::get();
        $users         = User::get();

        return view('admin.socialMedia.index', compact('contact_cards', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('social_medium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact_cards = ContactCard::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.socialMedia.create', compact('contact_cards'));
    }

    public function store(StoreSocialMediumRequest $request)
    {
        $socialMedium = SocialMedium::create($request->all());

        return redirect()->route('admin.social-media.index');
    }

    public function edit(SocialMedium $socialMedium)
    {
        abort_if(Gate::denies('social_medium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact_cards = ContactCard::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $socialMedium->load('contact_card', 'created_by');

        return view('admin.socialMedia.edit', compact('contact_cards', 'socialMedium'));
    }

    public function update(UpdateSocialMediumRequest $request, SocialMedium $socialMedium)
    {
        $socialMedium->update($request->all());

        return redirect()->route('admin.social-media.index');
    }

    public function show(SocialMedium $socialMedium)
    {
        abort_if(Gate::denies('social_medium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $socialMedium->load('contact_card', 'created_by');

        return view('admin.socialMedia.show', compact('socialMedium'));
    }

    public function destroy(SocialMedium $socialMedium)
    {
        abort_if(Gate::denies('social_medium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $socialMedium->delete();

        return back();
    }

    public function massDestroy(MassDestroySocialMediumRequest $request)
    {
        SocialMedium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

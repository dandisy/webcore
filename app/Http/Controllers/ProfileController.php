<?php

namespace App\Http\Controllers;

use App\DataTables\ProfileDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\ProfileRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Illuminate\Http\Request;
use App\User;

class ProfileController extends AppBaseController
{
    /** @var  ProfileRepository */
    private $profileRepository;

    public function __construct(ProfileRepository $profileRepo)
    {
        $this->middleware('auth');
        $this->profileRepository = $profileRepo;
    }

    /**
     * Display a listing of the Profile.
     *
     * @param ProfileDataTable $profileDataTable
     * @return Response
     */
    public function index(ProfileDataTable $profileDataTable)
    {
        return $profileDataTable->render('profiles.index');
    }

    /**
     * Show the form for creating a new Profile.
     *
     * @return Response
     */
    public function create()
    {
        if(Auth::user()->hasRole(['superadministrator'])) {
            $user = User::all();

            return view('profiles.create')
                ->with('user', $user);
        }

        return view('profiles.create');
    }

    /**
     * Store a newly created Profile in storage.
     *
     * @param CreateProfileRequest $request
     *
     * @return Response
     */
    public function store(CreateProfileRequest $request)
    {
        $input = $request->all();

        // handling edit profile non superadmin
        if(Auth::user()->hasRole(['administrator','user'])) {
            $input['user_id'] = Auth::user()->id;
        }

        $input['created_by'] = Auth::user()->id;

        $profile = $this->profileRepository->create($input);

        Flash::success('Profile saved successfully.');

        // handling edit profile non superadmin
        if(Auth::user()->hasRole(['administrator','user'])) {
            return redirect(url('dashboard'));
        }

        return redirect(route('profiles.index'));
    }

    /**
     * Display the specified Profile.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $profile = $this->profileRepository->findWithoutFail($id);

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('profiles.index'));
        }

        return view('profiles.show')->with('profile', $profile);
    }

    /**
     * Show the form for editing the specified Profile.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $profile = NULL;
        if(Auth::user()->hasRole(['administrator','user'])) {            
            $profile = $this->profileRepository->findWhere(['user_id' => Auth::user()->id])->first();
        }
        if(Auth::user()->hasRole(['superadministrator'])) {
            $profile = $this->profileRepository->findWithoutFail($id);
        }

        if (empty($profile)) {
            // handling edit profile non superadmin
            if (Auth::user()->hasRole(['superadministrator','administrator','user'])) {
                return redirect(url('profiles/create'));
            }

            Flash::error('Profile not found');

            return redirect(route('profiles.index'));
        }
        
        if(Auth::user()->hasRole(['superadministrator'])) {   
            $user = User::all();

            return view('profiles.edit')
                ->with('user', $user)
                ->with('profile', $profile);
        }
        
        return view('profiles.edit')
            ->with('profile', $profile);
    }

    /**
     * Update the specified Profile in storage.
     *
     * @param  int              $id
     * @param UpdateProfileRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProfileRequest $request)
    {
        $input = $request->all();

        $input['updated_by'] = Auth::user()->id;

        $profile = NULL;
        if(Auth::user()->hasRole(['administrator','user'])) {            
            $profile = $this->profileRepository->findWhere(['user_id' => Auth::user()->id])->first();
        }
        if(Auth::user()->hasRole(['superadministrator'])) {
            $profile = $this->profileRepository->findWithoutFail($id);
        }

        if (empty($profile)) {
            Flash::error('Profile not found');
            
            // handling edit profile non superadmin
            if(Auth::user()->hasRole(['administrator','user'])) {
                return redirect(url('dashboard'));
            }

            return redirect(route('profiles.index'));
        }

        $profile = $this->profileRepository->update($input, $profile->id);

        Flash::success('Profile updated successfully.');

        // handling edit profile non superadmin
        if(Auth::user()->hasRole(['administrator','user'])) {
            return redirect(url('dashboard'));
        }

        return redirect(route('profiles.index'));
    }

    /**
     * Remove the specified Profile from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $profile = $this->profileRepository->findWithoutFail($id);

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('profiles.index'));
        }

        $this->profileRepository->delete($id);

        Flash::success('Profile deleted successfully.');

        return redirect(route('profiles.index'));
    }
}

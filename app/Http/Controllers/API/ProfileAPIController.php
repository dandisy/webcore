<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProfileAPIRequest;
use App\Http\Requests\API\UpdateProfileAPIRequest;
use App\Models\Profile;
use App\Repositories\ProfileRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ProfileController
 * @package App\Http\Controllers\API
 */

class ProfileAPIController extends AppBaseController
{
    /** @var  ProfileRepository */
    private $profileRepository;

    public function __construct(ProfileRepository $profileRepo)
    {
        $this->profileRepository = $profileRepo;
    }

    /**
     * Display a listing of the Profile.
     * GET|HEAD /profiles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->profileRepository->pushCriteria(new RequestCriteria($request));
        $this->profileRepository->pushCriteria(new LimitOffsetCriteria($request));
        $profiles = $this->profileRepository->all();

        return $this->sendResponse($profiles->toArray(), 'Profiles retrieved successfully');
    }

    /**
     * Store a newly created Profile in storage.
     * POST /profiles
     *
     * @param CreateProfileAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProfileAPIRequest $request)
    {
        $input = $request->all();

        $profiles = $this->profileRepository->create($input);

        return $this->sendResponse($profiles->toArray(), 'Profile saved successfully');
    }

    /**
     * Display the specified Profile.
     * GET|HEAD /profiles/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Profile $profile */
        $profile = $this->profileRepository->findWithoutFail($id);

        if (empty($profile)) {
            return $this->sendError('Profile not found');
        }

        return $this->sendResponse($profile->toArray(), 'Profile retrieved successfully');
    }

    /**
     * Update the specified Profile in storage.
     * PUT/PATCH /profiles/{id}
     *
     * @param  int $id
     * @param UpdateProfileAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProfileAPIRequest $request)
    {
        $input = $request->all();

        /** @var Profile $profile */
        $profile = $this->profileRepository->findWithoutFail($id);

        if (empty($profile)) {
            return $this->sendError('Profile not found');
        }

        $profile = $this->profileRepository->update($input, $id);

        return $this->sendResponse($profile->toArray(), 'Profile updated successfully');
    }

    /**
     * Remove the specified Profile from storage.
     * DELETE /profiles/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Profile $profile */
        $profile = $this->profileRepository->findWithoutFail($id);

        if (empty($profile)) {
            return $this->sendError('Profile not found');
        }

        $profile->delete();

        return $this->sendResponse($id, 'Profile deleted successfully');
    }
}

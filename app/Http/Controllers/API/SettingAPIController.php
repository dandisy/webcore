<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSettingAPIRequest;
use App\Http\Requests\API\UpdateSettingAPIRequest;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SettingController
 * @package App\Http\Controllers\API
 */

class SettingAPIController extends AppBaseController
{
    /** @var  SettingRepository */
    private $settingRepository;

    public function __construct(SettingRepository $settingRepo)
    {
        $this->settingRepository = $settingRepo;
    }

    /**
     * Display a listing of the Setting.
     * GET|HEAD /settings
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->settingRepository->pushCriteria(new RequestCriteria($request));
        $this->settingRepository->pushCriteria(new LimitOffsetCriteria($request));
        $settings = $this->settingRepository->all();

        return $this->sendResponse($settings->toArray(), 'Settings retrieved successfully');
    }

    /**
     * Store a newly created Setting in storage.
     * POST /settings
     *
     * @param CreateSettingAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSettingAPIRequest $request)
    {
        $input = $request->all();

        $settings = $this->settingRepository->create($input);

        return $this->sendResponse($settings->toArray(), 'Setting saved successfully');
    }

    /**
     * Display the specified Setting.
     * GET|HEAD /settings/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Setting $setting */
        $setting = $this->settingRepository->findWithoutFail($id);

        if (empty($setting)) {
            return $this->sendError('Setting not found');
        }

        return $this->sendResponse($setting->toArray(), 'Setting retrieved successfully');
    }

    /**
     * Update the specified Setting in storage.
     * PUT/PATCH /settings/{id}
     *
     * @param  int $id
     * @param UpdateSettingAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSettingAPIRequest $request)
    {
        $input = $request->all();

        /** @var Setting $setting */
        $setting = $this->settingRepository->findWithoutFail($id);

        if (empty($setting)) {
            return $this->sendError('Setting not found');
        }

        $setting = $this->settingRepository->update($input, $id);

        return $this->sendResponse($setting->toArray(), 'Setting updated successfully');
    }

    /**
     * Remove the specified Setting from storage.
     * DELETE /settings/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Setting $setting */
        $setting = $this->settingRepository->findWithoutFail($id);

        if (empty($setting)) {
            return $this->sendError('Setting not found');
        }

        $setting->delete();

        return $this->sendResponse($id, 'Setting deleted successfully');
    }
}

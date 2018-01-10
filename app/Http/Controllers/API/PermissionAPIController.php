<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePermissionAPIRequest;
use App\Http\Requests\API\UpdatePermissionAPIRequest;
use App\Models\Permission;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PermissionController
 * @package App\Http\Controllers\API
 */

class PermissionAPIController extends AppBaseController
{
    /** @var  PermissionRepository */
    private $permissionRepository;

    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->permissionRepository = $permissionRepo;
    }

    /**
     * Display a listing of the Permission.
     * GET|HEAD /permissions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->permissionRepository->pushCriteria(new RequestCriteria($request));
        $this->permissionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $permissions = $this->permissionRepository->all();

        return $this->sendResponse($permissions->toArray(), 'Permissions retrieved successfully');
    }

    /**
     * Store a newly created Permission in storage.
     * POST /permissions
     *
     * @param CreatePermissionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePermissionAPIRequest $request)
    {
        $input = $request->all();

        $permissions = $this->permissionRepository->create($input);

        return $this->sendResponse($permissions->toArray(), 'Permission saved successfully');
    }

    /**
     * Display the specified Permission.
     * GET|HEAD /permissions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Permission $permission */
        $permission = $this->permissionRepository->findWithoutFail($id);

        if (empty($permission)) {
            return $this->sendError('Permission not found');
        }

        return $this->sendResponse($permission->toArray(), 'Permission retrieved successfully');
    }

    /**
     * Update the specified Permission in storage.
     * PUT/PATCH /permissions/{id}
     *
     * @param  int $id
     * @param UpdatePermissionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePermissionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Permission $permission */
        $permission = $this->permissionRepository->findWithoutFail($id);

        if (empty($permission)) {
            return $this->sendError('Permission not found');
        }

        $permission = $this->permissionRepository->update($input, $id);

        return $this->sendResponse($permission->toArray(), 'Permission updated successfully');
    }

    /**
     * Remove the specified Permission from storage.
     * DELETE /permissions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Permission $permission */
        $permission = $this->permissionRepository->findWithoutFail($id);

        if (empty($permission)) {
            return $this->sendError('Permission not found');
        }

        $permission->delete();

        return $this->sendResponse($id, 'Permission deleted successfully');
    }
}

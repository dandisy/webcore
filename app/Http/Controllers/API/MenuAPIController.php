<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMenuAPIRequest;
use App\Http\Requests\API\UpdateMenuAPIRequest;
use App\Models\Menu;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MenuController
 * @package App\Http\Controllers\API
 */

class MenuAPIController extends AppBaseController
{
    /** @var  MenuRepository */
    private $menuRepository;

    public function __construct(MenuRepository $menuRepo)
    {
        $this->menuRepository = $menuRepo;
    }

    /**
     * Display a listing of the Menu.
     * GET|HEAD /menus
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->menuRepository->pushCriteria(new RequestCriteria($request));
        $this->menuRepository->pushCriteria(new LimitOffsetCriteria($request));
        $menus = $this->menuRepository->all();

        return $this->sendResponse($menus->toArray(), 'Menus retrieved successfully');
    }

    /**
     * Store a newly created Menu in storage.
     * POST /menus
     *
     * @param CreateMenuAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMenuAPIRequest $request)
    {
        $input = $request->all();

        $menus = $this->menuRepository->create($input);

        return $this->sendResponse($menus->toArray(), 'Menu saved successfully');
    }

    /**
     * Display the specified Menu.
     * GET|HEAD /menus/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Menu $menu */
        $menu = $this->menuRepository->findWithoutFail($id);

        if (empty($menu)) {
            return $this->sendError('Menu not found');
        }

        return $this->sendResponse($menu->toArray(), 'Menu retrieved successfully');
    }

    /**
     * Update the specified Menu in storage.
     * PUT/PATCH /menus/{id}
     *
     * @param  int $id
     * @param UpdateMenuAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMenuAPIRequest $request)
    {
        $input = $request->all();

        /** @var Menu $menu */
        $menu = $this->menuRepository->findWithoutFail($id);

        if (empty($menu)) {
            return $this->sendError('Menu not found');
        }

        $menu = $this->menuRepository->update($input, $id);

        return $this->sendResponse($menu->toArray(), 'Menu updated successfully');
    }

    /**
     * Remove the specified Menu from storage.
     * DELETE /menus/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Menu $menu */
        $menu = $this->menuRepository->findWithoutFail($id);

        if (empty($menu)) {
            return $this->sendError('Menu not found');
        }

        $menu->delete();

        return $this->sendResponse($id, 'Menu deleted successfully');
    }
}

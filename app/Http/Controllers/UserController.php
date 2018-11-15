<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\RoleUser;
use App\User;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Auth; // added by dandisy

class UserController extends Controller
{
    /** @var  UserRepository */
    private $userRepository;
    private $roleRepository;

    public function __construct(UserRepository $userRepo, RoleRepository $roleRepo)
    {
        $this->userRepository = $userRepo;
        $this->roleRepository = $roleRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('users.index');
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $role = $this->roleRepository->all();

        return view('users.create')->with('role', $role);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        if($request->password === $request->confirm_password) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            $user->roles()->attach([$request->role]);

            Flash::success('User saved successfully.');
        } else {
            Flash::error('Password not match.');
        }

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // handling edit profile non superadmin
        if(Auth::user()->hasRole(['administrator','user']) && Auth::user()->id != $id) {
            return abort(404);
        }

        $user = $this->userRepository->findWithoutFail($id);
        $role = $this->roleRepository->all();

        $user['role'] = isset($user->roles()->first()->id) ? $user->roles()->first()->id : NULL;

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user)->with('role', $role);
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        // handling edit profile non superadmin
        if(Auth::user()->hasRole(['administrator','user']) && Auth::user()->id != $id) {
            return abort(404);
        }
        
        $user = $this->userRepository->findWithoutFail($id);
        // dd($user->roles()->sync([$user->with('role')->find($id)->role->role_id]));
        // dd($user->with('role')->find($id)->role->role_id);

        if (empty($user)) {
            Flash::error('User not found');
            
            // handling edit profile non superadmin
            if(Auth::user()->hasRole(['administrator','user'])) {
                return redirect(url('dashboard'));
            }

            return redirect(route('users.index'));
        }

        if($request->role) {
            $user->roles()->sync([$request->role]);
        }

        $input = $request->all();
        if($request->password) {
            if($request->password === $request->confirm_password) {
                $input['password'] = bcrypt($request->password);
            } else {
                Flash::success('Password not match.');

                // handling edit profile non superadmin
                if(Auth::user()->hasRole(['administrator','user'])) {
                    return redirect(url('dashboard'));
                }

                return redirect(route('users.index'));
            }
        } else {
            $input['password'] = $user->password;
        }

        $user = $this->userRepository->update($input, $id);

        Flash::success('User updated successfully.');

        // handling edit profile non superadmin
        if(Auth::user()->hasRole(['administrator','user'])) {
            return redirect(url('dashboard'));
        }

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }
}

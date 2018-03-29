<?php

namespace App\Http\Controllers\Admin;

//use App\DataTables\Admin\UserDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Admin\Distribuidor;
use App\Repositories\Admin\UserRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use InfyOm\Generator\Controller\AppBaseController;
use Response;
use App\Models\Admin\User;
use App\Models\Admin\Ciudad;
use App\Models\Admin\Compania;
use App\Role;
use DB;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(Request $request)
    {

        $users = DB::table('users')

       ->select('users.*');

        $users = $users->paginate(15);
//        dd(DB::getQueryLog());


        return view('admin.users.index')
            ->with('users', $users)
            ->with('filtro', $request->all());
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'cliente')->where('name', '!=', 'vendedor')->orderBy('name', 'ASC')->lists('name', 'id');
//        $ciudades = Ciudad::orderBy('nombre', 'ASC')->lists('nombre', 'id');
//        $companias = Compania::orderBy('nombre', 'ASC')->lists('nombre', 'id');
//        $distribuidores = Distribuidor::orderBy('nombre', 'ASC')->lists('nombre', 'id');
        return view('admin.users.create')
//            ->with('ciudades', $ciudades)
//            ->with('companias', $companias)
//            ->with('distribuidores', $distribuidores)
            ->with('roles', $roles);
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
        $input = $request->all();
        $input['password'] = bcrypt('123456');
        $input['compania_id'] = ($input['compania_id'] == "") ? null : $input['compania_id'];
        $input['distribuidor_id'] = ($input['distribuidor_id'] == "") ? null : $input['distribuidor_id'];
        $user = $this->userRepository->create($input);
        $user->roles()->sync($input['roles']);
        Flash::success('Usuario guardado con exito.');

        return redirect(route('admin.users.index'));
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
//        dd('dfrfre');
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('admin.users.index'));
        }

        return view('admin.users.show')->with('user', $user);
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
        $user = $this->userRepository->findWithoutFail($id);
//dd($user->roles);
        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('admin.users.index'));
        }
        $roles = Role::where('name', '!=', 'cliente')->orderBy('name', 'ASC')->lists('name', 'id');
        $ciudades = Ciudad::orderBy('nombre', 'ASC')->lists('nombre', 'id');
        $companias = Compania::orderBy('nombre', 'ASC')->lists('nombre', 'id');
        $distribuidores = Distribuidor::orderBy('nombre', 'ASC')->lists('nombre', 'id');

        return view('admin.users.edit')
            ->with('user', $user)
            ->with('ciudades', $ciudades)
            ->with('companias', $companias)
            ->with('distribuidores', $distribuidores)
            ->with('roles', $roles);
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('admin.users.index'));
        }
        $request['compania_id'] = ($request->compania_id == "") ? null : $request->compania_id;
        $request['distribuidor_id'] = ($request->distribuidor_id == "") ? null : $request->distribuidor_id;
        $user = $this->userRepository->update($request->all(), $id);

        Flash::success('Usuario guardado con exito.');

        return redirect(route('admin.users.index'));
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

            return redirect(route('admin.users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('admin.users.index'));
    }


    public function editPassword(Request $request)
    {
        return view('admin.users.editPassword');
    }


    /**
     * Update the specified User in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function updatePassword(Request $request)
    {
        if ($request['password_nuevo1'] != $request['password_nuevo2']) {
            Flash::error('Los password ingresados no coinciden');
            return redirect(route('admin.users.editPassword'));
        }
        $user = User::find(Auth::user()->id);
        if (Hash::check(trim($request['password_actual']), $user->password)) {
            $user->password = bcrypt(trim($request['password_nuevo1']));
            $user->save();
            Flash::success('El password fue actualizado con éxito.');
            return redirect(route('admin.users.editPassword'));
//            return redirect('/home');
        } else {
            Flash::error('El password ingresado no es correcto');
            return redirect(route('admin.users.editPassword'));
        }
    }


}

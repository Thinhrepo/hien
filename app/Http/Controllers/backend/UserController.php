<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $author_code;
    protected $student_code;
    protected $admin_code;

    public function __construct()
    {
        $this->author_code = $this->getRoleIdByCode('AT');
        $this->student_code = $this->getRoleIdByCode('ST');
        $this->admin_code = $this->getRoleIdByCode('AD');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->type_user();
        $user_author = $user['user_author'];
        $user_student = $user['user_student'];
        $user_admin = $user['user_admin'];

        return view('backend.users.index', compact('user_author', 'user_student', 'user_admin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $id = 1;
        $validator = Validator::make($data, [
            'name' => 'required',
            'address' => 'required',
            'contact_name' => 'required',
            'telephone' => 'required',
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return redirect('/school/' . $id . '/edit')->withErrors($validator)->withInput();
        }
        Session::flash('message', 'Xóa trường thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user_id = $request->all();
        $user = User::whereId($user_id)->with('roles')->first();

        if (count($user) != 1) {
            return response()->json([
                'code' => 404,
                'message' => 'Không tìm thấy người dùng!',
            ]);
        }
        $roles = $user->roles()->get();

        if (!isset($roles)) {
            return response()->json([
                'code' => 404,
                'message' => 'Không thực hiện được hành động này!',
            ]);
        }

        $roles_ids = [];
        foreach ($roles as $rol) {
            $roles_ids[] = $rol->id;
        }

        $user->roles()->detach($roles_ids);
        $user->delete();

        $user = $this->type_user();
        $user_author = $user['user_author'];
        $user_student = $user['user_student'];
        $user_admin = $user['user_admin'];

        return view('backend.users.table-index', compact('user_author', 'user_student', 'user_admin'));
    }

    public function type_user()
    {
        $users = User::with('roles', 'classes')->get();

        $user_author = $users->filter(function ($user) {
            return $user->type == $this->author_code;
        })->all();

        $user_student = $users->filter(function ($user) {
            return $user->type == $this->student_code;
        })->all();

        $user_admin = $users->filter(function ($user) {
            return $user->type == $this->admin_code;
        })->all();

        return ['user_author' => $user_author, 'user_student' => $user_student, 'user_admin' => $user_admin];
    }

    public function getRoleIdByCode($code_role)
    {
        $role = Role::where(['code' => $code_role])->first();

        return $role->id;
    }


}

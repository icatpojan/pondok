<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Api;
use App\Models\PimUser;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Api
{
    public function listUser(Request $request)
    {
        $offset = $request->input('offset', 0);
        $length = $request->input('length', 10);
        $username = $request->input('username');
        $email = $request->input('email');

        $users = $this->selectUser();

        if (!is_null($username)) {
            $users->where('pu.username', 'LIKE', "%$username%");
        }

        if (!is_null($email)) {
            $users->where('pu.email', 'LIKE', "%$email%");
        }

        $total = $users->count();

        $users->skip($offset);
        $users->take($length);

        return $this->responseJSON([
            'total' => $total,
            'offset' => $offset,
            'length' => $length,
            'users' => $users->get()
        ], TRUE, 200);
    }

    private function selectUser()
    {
        return DB::table('pim_users', 'pu')
            ->select([
                'pu.id', 'pu.username', 'pu.fullname', 'pu.email', 'pu.signature',
                'pr.name AS role_name'
            ])
            ->leftJoin('pim_model_has_roles AS pm', 'pu.id', '=', 'pm.model_id')
            ->leftJoin('pim_roles AS pr', 'pr.id', '=', 'pm.role_id');
    }

    public function createUser(Request $request)
    {
        $inputCreateUser = $this->getInputCreateUser($request);
        $allowedCreateUser = $this->allowedCreateUser($request, $inputCreateUser);

        if ($allowedCreateUser['result'] === TRUE) {
            $newUser = new PimUser($allowedCreateUser['user']);

            if ($newUser->save()) {
                $newUser->assignRole($allowedCreateUser['role']['name']);

                return $this->responseJSON(NULL, TRUE, 200, trans('message.user_create_success'));
            } else {
                return $this->responseJSON(NULL, FALSE, 400, trans('message.user_create_failed'));
            }
        } else {
            return $this->responseJSON(NULL, FALSE, 400, $allowedCreateUser['message']);
        }
    }

    private function getInputCreateUser($request)
    {
        $this->validate($request, [
            'role_name' => 'required',
            'signature' => 'required',
            'username' => 'required',
            'fullname' => 'required',
            'email' => 'nullable',
            'password' => 'required',
            're_password' => 'required|same:password'
        ]);

        return [
            'user' => [
                'role_name' => $request->input('role_name'),
                'signature' => $request->file('signature'),
                'username' => $request->input('username'),
                'fullname' => $request->input('fullname'),
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ],
            'role' => [
                'name' => $request->input('role_name')
            ]
        ];
    }

    private function allowedCreateUser(Request $request, $inputUser)
    {
        $result = [
            'result' => FALSE,
            'user' => NULL,
            'role' => NULL,
            'message' => NULL
        ];

        $user = $request->user();

        if ($user->hasPermissionTo('user.create')) {
            $selectedRole = Role::where('name', $inputUser['role']['name'])->get();

            if (is_null($selectedRole)) {
                $result['message'] = trans('message.role_not_found');

                return $result;
            }

            if (!empty($inputUser['user']['email'])) {
                $userRegistered = PimUser::where('email', $inputUser['user']['email'])->get();

                if (is_null($userRegistered)) {
                    $result['message'] = trans('message.email_registered');

                    return $result;
                }
            }
            if ($inputUser['user']['signature']) {
                $file = $inputUser['user']['signature'];
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('img'), $filename);
            }

            $result['result'] = TRUE;
            $result['user'] = [
                'username' => $inputUser['user']['username'],
                'signature' =>  $filename,
                'fullname' => $inputUser['user']['fullname'],
                'email' => $inputUser['user']['email'],
                'password' => bcrypt($inputUser['user']['password'])
            ];
            $result['role'] = [
                'name' => $inputUser['user']['role_name']
            ];
        } else {
            $result['message'] = trans('message.access_denied');
        }

        return $result;
    }

    public function updateUser(String $userId, Request $request)
    {
        $inputUpdateUser = $this->getInputUpdateUser($request);
        $allowedUpdateUser = $this->allowedUpdateUser($userId, $request, $inputUpdateUser);

        if ($allowedUpdateUser['result'] === TRUE) {
            PimUser::where('id', $userId)->update($allowedUpdateUser['user']);

            $allowedUpdateUser['current_user']->syncRoles($allowedUpdateUser['role']['name']);

            return $this->responseJSON(NULL, TRUE, 200, trans('message.user_update_success'));
        } else {
            return $this->responseJSON(NULL, FALSE, 400, $allowedUpdateUser['message']);
        }
    }

    private function getInputUpdateUser($request)
    {
        $this->validate($request, [
            'role_name' => 'required',
            'username' => 'required',
            'fullname' => 'required',
            'email' => 'nullable'
        ]);

        return [
            'user' => [
                'role_name' => $request->input('role_name'),
                'username' => $request->input('username'),
                'fullname' => $request->input('fullname'),
                'email' => $request->input('email'),
                'signature' => $request->file('signature'),
            ],
            'role' => [
                'name' => $request->input('role_name')
            ]
        ];
    }

    private function allowedUpdateUser(String $userId, Request $request, $inputUser)
    {
        $result = [
            'result' => FALSE,
            'user' => NULL,
            'role' => NULL,
            'current_user' => NULL,
            'message' => NULL
        ];

        $user = $request->user();

        // if ($user->hasPermissionTo('user.update')) {
        $currentUser = PimUser::find($userId);

        if (is_null($currentUser)) {
            $result['message'] = trans('message.user_not_found');

            return $result;
        }

        $selectedRole = Role::where('name', $inputUser['role']['name'])->get();

        if (is_null($selectedRole)) {
            $result['message'] = trans('message.role_not_found');

            return $result;
        }

        if (
            !empty($inputUser['user']['email'])
            and $inputUser['user']['email'] !== $currentUser->email
        ) {
            $userRegistered = PimUser::where('email', $inputUser['user']['email'])->get();

            if (is_null($userRegistered)) {
                $result['message'] = trans('message.email_registered');

                return $result;
            }
        }

        $filename = $currentUser->signature;
        if ($inputUser['user']['signature']) {
            $file = $inputUser['user']['signature'];
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
        }

        $result['result'] = TRUE;
        $result['user'] = [
            'username' => $inputUser['user']['username'],
            'fullname' => $inputUser['user']['fullname'],
            'email' => $inputUser['user']['email'],
            'signature' => $filename,
        ];
        $result['role'] = [
            'name' => $inputUser['user']['role_name']
        ];
        $result['current_user'] = $currentUser;
        // } else {
        //     $result['message'] = trans('message.access_denied');
        // }

        return $result;
    }

    public function DeleteUser(String $userId, Request $request)
    {
        $allowedDeleteUser = $this->allowedDeleteUser($userId, $request);

        if ($allowedDeleteUser['result'] === TRUE) {
            PimUser::where('id', $userId)->delete();

            return $this->responseJSON(NULL, TRUE, 200, trans('message.user_delete_success'));
        } else {
            return $this->responseJSON(NULL, FALSE, 400, $allowedDeleteUser['message']);
        }
    }

    private function allowedDeleteUser(String $userId, Request $request)
    {
        $result = [
            'result' => FALSE,
            'user' => NULL,
            'role' => NULL,
            'current_user' => NULL,
            'message' => NULL
        ];

        $user = $request->user();

        if ($user->hasPermissionTo('user.update')) {
            $currentUser = PimUser::find($userId);

            if (is_null($currentUser)) {
                $result['message'] = trans('message.user_not_found');

                return $result;
            }


            $result['result'] = TRUE;
            $result['current_user'] = $currentUser;
        } else {
            $result['message'] = trans('message.access_denied');
        }

        return $result;
    }
}

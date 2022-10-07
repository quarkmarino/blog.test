<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;

class UserController extends Controller
{

    public function show(User $user)
    {
        return strpos(request()->headers->get('Content-Type'), 'text/html') === 0
            ? view('partials.users.table._row')->with('user', $user)
            : $user->append('supervisor_ids');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Users\CreateRequest $request)
    {
        $this->authorize('create', User::class);

        $user = User::make($request->input())
            ->forceFill([
                'password' => $request->password,
                'user_type' => $request->user_type
            ]);

        return $user->save()
            ? $user
            : response('resource update failed', 400);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Users\UpdateRequest $request, User $model)
    {
        $user = Auth::user();

        $this->authorize('manage', $model);

        $model->fill($request->input());

        if ($user->is_admin) {
            $model->forceFill($request->only('user_type'));
        }

        return $model->save()
            ? $model
            : response('resource updated failed', 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('manage', $user);

        return $user->delete()
            ? $user
            : response('resource delete failed', 400);
    }
}

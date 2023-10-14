<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Yajra\Datatables\Datatables;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function dataTable()
    {
        $users = User::all();
        
        return Datatables::of($users)
            ->addColumn('action', function ($user){
                if($user->type == 'user'){
                    return '<div><button class="btn btn-danger" onclick="confirmDelete(' . $user->id . ')"><i class="fas fa-trash"></i></button></div>';
                }
            })
            ->editColumn('id', function () {
                static $i = 0;
                $i++;
                return $i;
            })
            ->rawColumns(['action'])
            ->toJson();    
    }

    public function destroy($id)
    {
        $Feedback = User::find($id);
        $Feedback->delete();
        return new JsonResponse(['message' => 'User deleted successfully']);
    }
}

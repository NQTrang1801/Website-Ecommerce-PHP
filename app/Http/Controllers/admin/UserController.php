<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

use function Laravel\Prompts\alert;

class UserController extends Controller
{
    public function indexStaff(Request $request) {
        $users = User::where('usertype', 1)->latest();

        if (!empty($request->get('keyword'))){
            $keyword = $request->get('keyword');
            $users = $users->where(function ($query) use ($keyword) {
                            $query->where('id', 'like', '%' . $keyword . '%')
                                  ->orWhere('FirstName', 'like', '%' . $keyword . '%')
                                  ->orWhere('LastName', 'like', '%' . $keyword . '%')
                                  ->orWhere('email', 'like', '%' . $keyword . '%')
                                  ->orWhere('created_at', 'like', '%' . $keyword . '%');
            });
        }

        $users = $users->paginate(10);
        
        return view('admin.user.users', compact('users'));
    }

    public function indexCustomer(Request $request) {
        $users = User::where('usertype', 0)->latest();

        if (!empty($request->get('keyword'))){
            $keyword = $request->get('keyword');
            $users = $users->where(function ($query) use ($keyword) {
                            $query->where('id', 'like', '%' . $keyword . '%')
                                  ->orWhere('FirstName', 'like', '%' . $keyword . '%')
                                  ->orWhere('LastName', 'like', '%' . $keyword . '%')
                                  ->orWhere('email', 'like', '%' . $keyword . '%')
                                  ->orWhere('created_at', 'like', '%' . $keyword . '%');
            });
        }

        $users = $users->paginate(10);
        
        return view('admin.user.users', compact('users'));
    }

    public function destroy($userId, Request $request)
    {
        $user = User::find($userId);
        if (empty($user))
        {
            alert("user not found");
            return response()->json([
                'status' => false,
                'message' => 'user not found'
            ]);
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'user deleted successfully'
        ]);
    }

}
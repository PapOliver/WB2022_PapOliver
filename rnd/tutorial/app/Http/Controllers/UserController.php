<?php   
    namespace App\Http\Controllers;

    use App\User;
    use Exception;
    use Illuminate\Database\QueryException;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    

    class UserController
    {
        public function changePassword(Request $request)
        {
            $validatedData = $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:6|confirmed',
                'new_password_confirmation' => 'required|same:new_password',
            ]);
            $user = auth()->user();
            $user->password = Hash::make($validatedData['new_password']);
            $user->save();

            return redirect('/profile')->with('success', 'Password changed successfully.');
        }
    }
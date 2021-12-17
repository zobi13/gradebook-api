<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Gradebook;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->query('name', '');
        $per_page = $request->query('per_page', 10);
        $teachers = User::searchByName($name)->paginate($per_page);

        return response()->json($teachers);
    }

    public function show(User $teacher)
    {
        // $gradebook = User::gradebook()->load();
        $gradebook = Gradebook::where('user_id', $teacher['id'])->get();

        return response()->json([$teacher, $gradebook]);
    }
}

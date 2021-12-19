<?php

namespace App\Http\Controllers;

use App\Models\Gradebook;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CreateGradebookRequest;
use App\Http\Requests\UpdateGradebookRequest;

class GradebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) 
    {
        // $gradebooks = Gradebook::all();
        $name = $request->query('name', '');
        // $user_id = $request->query('user_id', '');
        $per_page = $request->query('per_page', 10);
        $gradebooks = Gradebook::searchByName($name)->paginate($per_page);

        $teachers = User::all(); 

        return response()->json([$gradebooks, $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $availableTeachers = User::where('is_teacher', 0)->get();

        return response()->json($availableTeachers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGradebookRequest $request)
    {
        $data = $request->validated();
        // $testTeacher = User::find($data['user_id']);
        // return response()->json($temporaryTeacher);

        // if (!$testTeacher['is_teacher']) {
        //     $gradebook = Gradebook::create($data);
        //     $teacher = User::find($gradebook['user_id']);
        //     $teacher['is_teacher'] = 1;
        //     User::where('id', $teacher['id'])->update(['is_teacher' => 1]);

        //     return response()->json([$gradebook, $teacher], 201);
        // }
        // else return response()->json('Nesto nije u redu. Verovatno je user_id vec uzet');

        $gradebook = Gradebook::create($data);
        $teacher = User::find($gradebook['user_id']);
        $teacher['is_teacher'] = 1;
        User::where('id', $teacher['id'])->update(['is_teacher' => 1]);

        return response()->json([$gradebook, $teacher], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gradebook  $gradebook
     * @return \Illuminate\Http\Response
     */
    public function show(Gradebook $gradebook)
    {
        $teacher = User::find($gradebook['user_id']);
        $comments = Comment::where('gradebook_id', $gradebook['id'])->get();;

        return response()->json([
            'gradebook' => $gradebook, 
            'teacher' => $teacher, 
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gradebook  $gradebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Gradebook $gradebook)
    {
        $availableTeachers = User::where('is_teacher', 0)->get();
        $gradebookTeacher = User::find($gradebook['user_id']);

        return response()->json([
            'gradebook_teacher' => $gradebookTeacher,
            'available_teachers' => $availableTeachers,
            'gradebook' => $gradebook
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gradebook  $gradebook
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGradebookRequest $request, Gradebook $gradebook)
    {
        $data = $request->validated();
        $gradebook->update($data);
        // Gradebook::where('id', $gradebook['id'])->update($data);
        // $gradebook['name'] = $data['name'];
        // $gradebook['user_id'] = $data['user_id'];
        // $gradebook->save();
        $teacher = User::find($gradebook['user_id']);

        // if ($gradebook['user_id']) {
        //     $teacher = User::find($gradebook['user_id']);
        //     User::where('id', $teacher['id'])->update(['is_teacher' => 1]);      
        //     $teacher['is_teacher'] = 1;

        //     return response()->json([$gradebook, $teacher]);
        // }

        return response()->json([$gradebook, $teacher]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gradebook  $gradebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gradebook $gradebook)
    {
        $teacher = User::find($gradebook['user_id']);
        User::where('id', $teacher['id'])->update(['is_teacher' => 0]);
        $teacher['is_teacher'] = 0; 
        $gradebook->delete();
        
        return response()->json([$gradebook, $teacher]);
    }
}

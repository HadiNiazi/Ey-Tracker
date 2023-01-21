<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClassRequest;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = StudentClass::all();
        return view('admin.classes.index', ['classes' => $classes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.classes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassRequest $request)
    {
        $request->validated();
        
        try {

            StudentClass::create([
                'name' => $request->name
            ]);

            $request->session()->flash('alert-success', 'Class Added Successfully');
        }
        catch(\Exception $ex) {
            return back()->withErrors($ex->getMessage());
        }

        return to_route('admin.classes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentClass $class)
    {
        return view('admin.classes.edit', ['class' => $class]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClassRequest $request, StudentClass $class)
    {
        $request->validated();

        try {

            $class->update([
                'name' => $request->name
            ]);

            $request->session()->flash('alert-success', 'Class Updated Successfully');
        }
        catch(\Exception $ex) {
            return back()->withErrors($ex->getMessage());
        }

        return to_route('admin.classes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentClass $class)
    {
        try {
            if ($class->student) {
                return back()->withErrors('Class have some students, please delete those students and then try it again.');
            }
            else {
                $class->delete();
                request()->session()->flash('alert-success', 'Class Deleted Successfully');
            }
        }
        catch(\Exception $ex) {
            return back()->withErrors($ex->getMessage());
        }

        return to_route('admin.classes.index');
    }
}

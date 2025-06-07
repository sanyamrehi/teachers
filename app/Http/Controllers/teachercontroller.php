<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use Illuminate\Http\Request;
use DataTables;


class teachercontroller extends Controller
{
    /*
    show the create form for new profile

    @return \Illuminate\Http\Request
    */
    public function create()
    {
        return view('create');//blade file for creating
    }
     /*
    shows the profile index

    @param \Illuminate\Http\Request $request
    @return \Illuminate\Http\Request
    */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Teacher::where('status','!=', 'Deleted')->orderBy('id','Desc')->get();//display the active records

            return DataTables::of($data)//data is displayed in index

                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="' . route('teachers.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>
                    <form action="' . route('teachers.delete', $row->id) . '" style="display:inline-block;" onsubmit="return confirmDelete(event)">

                        <button type="submit" class="delete btn btn-danger btn-sm">Delete</button>
                    </form>';
                return $btn;
                })//edit and delete buttons

                ->addColumn('image', function ($row) {
                    $imageUrl = asset('/teachers_images/' . $row->image); // Assuming the image path is stored in DB
                    return '<img src="' . $imageUrl . '" alt="Image" style="width:70px; height:70px; border-radius:5px;">';
                })

                ->rawColumns(['action', 'image'])//columns are shown in index page

                ->make(true);

        }

        return view('index'); // Blade view for listing profiles

    }
    /*
    store the new profile into the database

    @param \Illuminate\Http\Request $request
    @return \Illuminate\Http\Request
    */
    public function store(Request $request)
    {
        $input = $request->all();//store the record in db Table



        if (isset($input['image']) && !empty($input['image'])) {
            if ($logoImage = $request->file('image')) {
                $destinationPath = public_path() . '/teachers_images/';//assuming the path

                $originalName = pathinfo($logoImage->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $logoImage->getClientOriginalExtension();
                $imagePath = $originalName . '.' . $extension;//detailing about the path

                $logoImage->move($destinationPath, $imagePath);//image moved and stored in folder

            }
        }
        if ($request->status == 'Active') {
            $status = 'Active';
        } else {
            $status = 'InActive';
        }//status is active or not

        Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'experience' => $request->experience,
            'qualification' => $request->qualification,
            'image' => $imagePath,
            'status' => $status,
        ]);//new record is created in table

        return redirect()->route('teachers.index')->with('success', 'teachers created successfully.');//data is stored and displayed in index
    }
    /*
    edit the profile page

    @param int $id
    @return \Illuminate\Http\Request
    */
    public function edit($id)
    {
        $data = Teacher::findOrFail($id);//data is available or not
        return view('edit', compact('data'));//after the data is found, edit page is displayed
    }
    /*
    update the profile into the database

    @param \Illuminate\Http\Request $request
    @param int $id
    @return \Illuminate\Http\Request
    */
    public function update(Request $request, $id)
    {

        $input = $request->all();//checks the record in db Table

        $profile = Teacher::findOrFail($id);//finds the data in db


        $imagePath = "";
        if ($request->file('image') && !empty($request->file('image'))) {
            if ($logoImage = $request->file('image')) {
                $destinationPath = public_path() . '/teachers_images';// stored the image path is stored in DB

                $originalName = pathinfo($logoImage->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $logoImage->getClientOriginalExtension();
                $imagePath = $originalName . '.' . $extension;//detailing about the path

                $logoImage->move($destinationPath, $imagePath);//image moved and stored in folder

            }
        }else{
            if (isset($input['hdnimage']) && !empty($input['hdnimage']))
            $imagePath = $input['hdnimage'];//display the image after update
        }
        if ($request->status == 'Active') {
            $status = 'Active';
        } else {
            $status = 'InActive';
        }//checks the data is Active or InActive

        $profile->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'experience' => $request->experience,
            'qualification' => $request->qualification,
            'image' => $imagePath,
            'status' => $status,
        ]);//new record is updated in table


        return redirect()->route('teachers.index')->with('success', 'Teachers updated successfully.');//After the updation process index page
    }
    /*
    delete the profile in database with status

    @param int $id
    @return \Illuminate\Http\Request
    */
    public function delete($id)
    {
        // dd($id);
        Teacher::findOrFail($id)->update(['status' => 'Deleted']);//display the record deleted in db table
        // {{$profile = ProfilesModel::where('id', $id)->update([
        //     'status' => 'Deleted'
        // ]);}}

        return redirect()->route('teachers.index')->with('success', 'Teachers deleted successfully.');//After the deletion process index page
        // if($profile){
        // }

    }

}

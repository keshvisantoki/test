<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::latest()->get();
            return DataTables::of($data)
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        
        return view('admin-home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'fname'    =>  'required',
            'lname'     =>  'required',
            'email'     =>  'required',
            'phone'     =>  'required',
            'password'     =>  'required',
            'confirmpassword'     =>  'required',
            'hobbies'     =>  'required',
            'city'     =>  'required',
            'gender'     =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'fname'        =>  $request->fname,
            'lname'         =>  $request->lname,
            'email'         =>  $request->email,
            'phone'         =>  $request->phone,
            'password'         =>  $request->password,
            'confirmpassword'         =>  $request->confirmpassword,
            'hobbies'         =>  $request->hobbies,
            'city'         =>  $request->city,
            'gender'         =>  $request->gender
        );

        User::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
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
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = User::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $rules = array(
            'fname'    =>  'required',
            'lname'     =>  'required',
            'email'     =>  'required',
            'phone'     =>  'required',
            'password'     =>  'required',
            'confirmpassword'     =>  'required',
            'hobbies'     =>  'required',
            'city'     =>  'required',
            'gender'     =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'fname'        =>  $request->fname,
            'lname'         =>  $request->lname,
            'email'         =>  $request->email,
            'phone'         =>  $request->phone,
            'password'         =>  $request->password,
            'confirmpassword'         =>  $request->confirmpassword,
            'hobbies'         =>  $request->hobbies,
            'city'         =>  $request->city,
            'gender'         =>  $request->gender
        );

        User::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::where('id', $id)->delete();
 
        return Response::json($data);
    }
}

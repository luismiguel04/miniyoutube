<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\video;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //carga la pagina de inicio del objeto(videos segun el controlador)
          return view('videos.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('videos.create');
        //solamente abre el formulario para insertar(capturar)
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //guarda el registro capturado(no editado solo nuevo)
        $validaData = $this ->validate($request,[
            'title'=>'required|min:5',
            'description'=>'required',
            'videos'=>'mimes:mp4'
        ]);
        $video= new video();
        $user=\Auth::user();
        $video->user_id = $user->id;
        $video->title =$request->input('title');
        /* $image= $file('image'); */
        $video->description =$request->input ('description');

        $image = $request->file('image');
if($image){
   $image_path = time().$image->getClientOriginalName();
   \Storage::disk('images')->put($image_path, \File::get($image));

   $video->image =$image_path;

}
//subir video
            $video_file = $request->file('video');
            if($video_file){
               $video_path = time().$video_file->getClientOriginalName();
               \Storage::disk('videos')->put($video_path,
               \File::get($video_file));
               $video->video_path = $video_path;
            }


        $video ->save();
        return redirect()->route('videos.index')
         ->with(array(
            'message'=>'El video se ha subido correctamente'
        ));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //muestra un registro indibidual
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // muesto lo que tengoabre el formulario para edicion
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //guarda la informacion modificada del edit
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //borrar
    }
}

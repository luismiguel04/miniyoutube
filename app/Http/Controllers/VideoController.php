<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\video;
use App\Models\vsvideos;

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

        $vs_videos = vsvideos::where('status','=',1)->get();
        $videos = $this->cargarDT($vs_videos );
        return view('videos.index')->with('videos',$videos);
    }

    public function cargarDT($consulta)
    {
        $videos = [];

        foreach ($consulta as $key => $value){
/*
            $ruta = "eliminar".$value['id'];
            $eliminar = route('delete-area', $value['id']);
            $actualizar =  route('areas.edit', $value['id']);


            $acciones = '
                <div class="btn-acciones">
                    <div class="btn-circle">
                        <a href="'.$actualizar.'" role="button" class="btn btn-success" title="Actualizar">
                            <i class="far fa-edit"></i>
                        </a>
                        <a href="#'.$ruta.'" role="button" class="btn btn-danger" data-toggle="modal" title="Eliminar">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </div>
                </div>
                <div class="modal fade" id="'.$ruta.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar este curso?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p class="text-primary">
                        <small>
                            '.$value['id'].', '.$value['descripcion'].'                 </small>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <a href="'.$eliminar.'" type="button" class="btn btn-danger">Eliminar</a>
                    </div>
                  </div>
                </div>
              </div>
            ';
*/
            $videos[$key] = array(
               // $acciones,
                $value['id'],
                $value['title'],
                $value['description'],
                $value['image'],
                $value['video_path'],
                $value['name'],
                $value['email']

            );

        }

        return $videos;
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

@extends('layouts.app')
@section('content')

Video 3
    @if(Storage::disk('images')->has($video->image))
        <div class="video-imagen-thumb col-md-3 pull-left">
            <div class="video-image-mask">
                <img src="{{ url('/miniatura/'.$video->image) }}" class="video-image">
            </div>
        </div>
    @endif
    <h3>Video</h3>
    {{$video->title}}
    <br>
    @if(Storage::disk('videos')->has($video->video_path))
    <video controls id="video-player">
        <source src="{{route('fileVideo',['filename' =>$video->video_path])}}"></source>
        Tu navegador no es compatible con HTML5
     </video>
     @endif


@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach ($repositories as $repository)
                        <div class="card-body border-bottom">
                            <div class="btn btn-outline-secondary favorite repositories delete" id="{{$repository["id"]}}"> DELETE

                            </div>

                            <h3><a class="resourse" href="{{$repository["url"]}}">  {{$repository["name"]}} </a>
                                - <span class="owner-login">{{$repository["owner_login"]}} </span> ( <span
                                    class="stargazers_count">{{$repository["stargazers_count"]}}</span> )</h3>
                            <p> {{$repository["description"]}}</p>

                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <form method="GET" action="/search/">
                            <input name="q" type="text" value="{{$q}}"
                                   class="col-md-9 @error('title') is-invalid @enderror">
                            <button type="submit" class="col-md-2 btn btn-success">Search</button>
                        </form>
                    </div>

                    @foreach ($data as $repository)

                        <div class="card-body border-bottom result">
                            <div class="favorite save btn btn-xs btn-outline-primary">
                                <span>Save</span>
                            </div>
                            <div class="favorite search delete btn btn-xs btn-outline-primary">
                                <span>Delete</span>
                            </div>


                            <h3><a class="resourse" href="{{$repository["html_url"]}}">  {{$repository["name"]}} </a>
                                - <span class="owner-login">{{$repository["owner"]["login"]}} </span> ( <span
                                    class="stargazers_count">{{$repository["stargazers_count"]}}</span> )</h3>
                            <p> {{$repository["description"]}}</p>

                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection

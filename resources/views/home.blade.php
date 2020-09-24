@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <form  method="GET" action="repositories/search/">
                        <input name="q" type="text" class="col-md-9 @error('title') is-invalid @enderror">
                        <button type="submit" class="col-md-2 btn btn-success">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

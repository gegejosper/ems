@extends('layouts.admin')

@section('content')


<div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                
                  <div class="clearfix"></div>
                    <div class="x_content">
                    @if(Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                    @php
                                    Session::forget('success');
                                    @endphp
                                </div>
                                @endif
                        <form action="{{ route('importmembers') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" class="form-control">
                            <br>
                            <button class="btn btn-success">Import Member</button>
                        </form>
                    </div>
                </div>
           
        </div>
        
</div>
@endsection

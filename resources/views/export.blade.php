@extends('layouts.admin')

@section('content')


<div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="no-print">
                  <div class="col-lg-4"><a class="btn btn-success" href="/admin/downloadExcel/csv">Download ALL</a></div>
                
                </div>
                  <div class="clearfix"></div>
                    <div class="x_content">
                        <form method="post" action="/admin/export/custom"> 
                            @csrf

                            <div class="col-lg-4">
                                <label for="Club">Club</label>
                                <input type="hidden" value="club" name="type">
                                <select name="importtype" class="form-control">
                            
                                @foreach($dataClub as $Club  => $ClubDetails)
                                <option value="{{$Club}}">{{$Club}}</option>
                                @endforeach
                                </select>

                            </div>
                            <div class="col-lg-4">
                            <label for="Club">&nbsp;</label>
                            <button type="submit" class="form-control btn btn-success" >Download CSV</button>
                            </div>
                        </form>
                        <hr>
                        <form method="post" action="/admin/export/custom"> 
                            @csrf
                            <div class="col-lg-4">
                                <label for="Region"> Region</label>
                                <input type="hidden" value="region" name="type">
                                <select name="importtype" class="form-control">
                                
                                @foreach($dataRegion as $Region => $RegionDetails)
                                <option value="{{$Region}}">{{$Region}}</option>
                                @endforeach
                                </select>
                                
                            </div>
                            
                            <div class="col-lg-4">
                            <label for="Club">&nbsp;</label>
                            <button type="submit" class="form-control btn btn-success" >Download CSV</button>
                            </div>
                        </form>
                    </div>
                </div>
           
        </div>
        
</div>
@endsection

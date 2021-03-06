@extends('layouts.admin')

@section('content')
<div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Members</span>
              <div class="count">{{$Member}}</div>   
            </div>
          
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-bank"></i> Total Regions</span>
              <div class="count">{{$Region}}</div>    
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-puzzle-piece"></i> Total Clubs</span>
              <div class="count">{{$Club}}</div>
              
            </div>
            
          </div>

          <div class="row">
            
              <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>Recent Regions </h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-striped members">
                      <thead>
                        <tr>
                            <th>#</th>  
                            <th>Region Name</th>
                            <th>Members</th>
                            <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($dataRegion as $Region)
                        <tr>
                            <td scope="row">{{$Region->id}}. </td>
                            <th >{{ucwords($Region->regioname)}}</th>
                            <td>{{$Region->members->count()}} </td>
                            <td><a href="/admin/regions/{{$Region->regioname}}" class="pull-right btn btn-success btn-xs"><i class="fa fa-search"></i> View</a></td> 
                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                  </div>
                </div>
              </div><!--End Col-->
          </div> <!-- End Row-->
          <!-- /top tiles -->

</div>
@endsection
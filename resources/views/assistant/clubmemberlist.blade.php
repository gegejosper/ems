@extends('layouts.assistant')

@section('content')
<script src="{{ asset('js/jquery.js') }}"></script>
<div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="no-print">
                  <h4>Members Lists</h4>
                </div>
                  <div class="clearfix"></div>
                  <div class="x_content">
                  <form method="get">         
                      <div class="input-group col-lg-6 no-print">
                         <select class="form-control" name="club" id="club">
                            @foreach($dataClub as $Club)
                            <option value="{{$Club->clubname}}">{{$Club->clubname}}</option>
                            @endforeach
                         </select>
                         
                        </div>
                      {{ csrf_field() }}
                      </span>
                  </form>
                    <div class="row">
                      <div class="col-lg-6 memberlistview no-print">
                                <table class="table table-striped members">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Personal ID</th>
                                      <th>Full Name</th>
                                      <th>Club</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody  class="memberresult">
                                  <?php 
                                  $num = 1;
                                  ?>
                                  @foreach($dataMember as $Member)
                                  <tr class="member{{$Member->id}}">
                                      <td>{{$num}}.</td>
                                      <td>{{$Member->personalidnumber}}</td>
                                      <td>{{ucwords($Member->lname)}}, {{ucwords($Member->fname)}} {{ucwords($Member->mname)}}</td>
                                      <td>{{ucwords($Member->club)}}</td>
                                      <?php if(empty($Member->pic)){
                                          $pic = '/img/logo.png';
                                        }
                                        else {
                                          $pic = '/member/'.$Member->pic;
                                        }?>
                                      <td class="quickviewcol"><a href="javascript:;" 
                                        class="quickview btn btn-xs btn-info no-print" 
                                        data-id="{{$Member->id}}"
                                        data-pic="{{$pic}}"
                                        data-personalid="{{$Member->personalidnumber}}"
                                        data-clubnumber="{{$Member->clubidnumber}}"
                                        data-regnumber="{{$Member->regionalidnumber}}" 
                                        data-club="{{ucwords($Member->club)}}"
                                        data-region="{{ucwords($Member->region)}}"
                                        data-position="{{ucwords($Member->position)}}"
                                        data-address="{{ucwords($Member->address)}}"
                                        data-contactnum="{{$Member->personalcontact}}" 
                                        data-bloodtype="{{$Member->bloodtype}}"
                                        data-contactperson="{{ucwords($Member->contactperson)}}"
                                        data-contactpersonnum="{{$Member->contactpersonnumber}}"
                                        data-relation="{{ucwords($Member->relation)}}"
                                        data-email="{{$Member->email}}" 
                                        data-website="{{$Member->website}}"
                                        data-tin="{{$Member->tin}}"
                                        data-birthdate="{{$Member->bdate}}"
                                        data-philhealth="{{$Member->philhealth}}"
                                        data-sssgsis="{{$Member->sssgsis}}" 
                                        data-pagibig="{{$Member->pagibig}}" 
                                        data-religion="{{$Member->pagibig}}"
                                        data-name="{{ucwords($Member->lname)}}, {{ucwords($Member->fname)}} {{ucwords($Member->mname)}}"
                                        data-fname="{{ucwords($Member->fname)}}"
                                        data-lname="{{ucwords($Member->lname)}}"
                                        data-mname="{{ucwords($Member->mname)}}">
                                          <i class="fa fa-search"> </i> Quick View</a>
                                      </td>
                    
                                    </tr>
                                    <?php $num += 1;?>
                                  @endforeach
                                  </tbody>
                                </table>
                            <a class="btn btn-print btn-primary hidden-print noprint btn-xs print" onclick="myFunction()"><i class="fa fa-print" ></i> Print</a>
                            <a class="btn btn-print btn-primary hidden-print noprint btn-xs prepareprint" onclick="clearPrint()"><i class="fa fa-print" ></i> Prepare to Print</a>
                            <script>
                            $('.print').hide();
                            function myFunction() {
                              window.print();
                            }
                            function clearPrint() {
                              $('.print').show();
                              $('.prepareprint').hide();
                              $('.quickviewcol').hide();
                              
                              $('.memberlistview').removeClass('no-print');
                              $('.memberlistview').removeClass('col-lg-6');
                              $('.memberlistview').addClass('col-lg-12');
                              
                            }
                            </script>
                          </div>
                          <div class="col-lg-6 memberdetails hidedetails content invoice">
                            <img src="{{ asset('img/logo.png') }}" alt="" class="memberpic">
                            <h4><span class="name"></span></h4>
                            <div class="memberdetail">
                            
                            <h6>Personal ID: <span class="personalid"></span></h6>
                            <h6>Club Number: <span class="clubnumber"></span></h6>
                            <h6>Regional Number: <span class="regnumber"></span></h6>
                            <h6>Club: <span class="club"></span></h6>
                            <h6>Region <span class="region"></span></h6>
                            <h6>Position: <span class="position"></span></h6>
                            <h6>Address: <span class="address"></span> </h6>
                            <h6>Contact Number: <span class="contactnum"></span> </h6>
                            <h6>Blood Type: <span class="bloodtype"></span></h6>
                            <h6>Contact Person: <span class="contactperson"></span></h6>
                            <h6>Contact Person #: <span class="contactpersonnum"></span></h6>
                            <h6>Relation: <span class="relation"></span></h6>
                            <h6>Email: <span class="email"></span></h6>
                            <h6>Website: <span class="website"></span></h6>
                            <h6>TIN: <span class="tin"></span></h6>
                            <h6>Birthdate: <span class="birthdate"></span></h6>
                            <h6>Philhealth: <span class="philhealth"></span></h6>
                            <h6>SSS/GSIS: <span class="sssgsis"></span></h6>
                            <h6>Pag-ibig: <span class="pagibig"></span></h6>
                            <h6>Religion: <span class="religion"></span></h6>
                            </div>
                            <div class="buttons no-print">
                            <a href="javascript:;"  class="edit-modal btn btn-xs btn-success" > <i class="fa fa-pencil"> </i> Edit </a>
                            
                            <a class="btn btn-print btn-primary hidden-print noprint btn-xs" onclick="myFunction()"><i class="fa fa-print" ></i> Print</a>
                            <script>
                            function myFunction() {
                              
                            window.print();}
                            </script>
                            </div>
                            
                          </div>
                    </div>
                  
                  </div>
                </div>
           
        </div>
</div>
<div id="myModal" class="modal fade " role="dialog">
  		<div class="modal-dialog modal-lg">
  			<!-- Modal content-->
  			<div class="modal-content">
  				<div class="modal-header">
  					<button type="button" class="close" data-dismiss="modal">&times;</button>
  					<h4 class="modal-title"></h4>
  				</div>
  				<div class="modal-body">
  					<form class="form-horizontal" role="form">
              @csrf	
              <input type="hidden" class="form-control" id="fid">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-4">
                    <label for="First Name"> First Name</label>
                    <input type="text" class="form-control" id="fname">
                  </div>
                  <div class="col-lg-4">
                    <label for="Middle Name"> Middle Name</label>
                    <input type="text" class="form-control" id="mname">
                  </div>
                  <div class="col-lg-4">
                    <label for="Last Name"> Last Name</label>
                    <input type="text" class="form-control" id="lname">
                  </div>
                </div>
              </div>      
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-4">
                    <label for="Personal ID"> Personal ID</label>
                    <input type="text" class="form-control" id="personalid">
                  </div>
                  <div class="col-lg-4">
                    <label for="Club Number"> Club Number</label>
                    <input type="text" class="form-control" id="clubnumber">
                  </div>
                  <div class="col-lg-4">
                    <label for="Regional Number"> Regional Number</label>
                    <input type="text" class="form-control" id="regnumber">
                  </div>
                </div>
              </div>        
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-4">
                    <label for="Position"> Position</label>
                    <select name="position" class="form-control">
                      <option id="position"></option>
                      @foreach($dataPosition as $Position)
                      <option value="{{$Position->positionname}}">{{$Position->positionname}}</option>
                      @endforeach
                    </select>
                    
                  </div>
                  <div class="col-lg-4">
                    <label for="Club">Club</label>
                    <select name="club" class="form-control">
                      <option id="club"></option>
                      @foreach($dataClub as $Club)
                      <option value="{{$Club->clubname}}">{{$Club->clubname}}</option>
                      @endforeach
                    </select>
                    
                  </div>
                  <div class="col-lg-4">
                    <label for="Region"> Region</label>
                    <select name="region" class="form-control">
                      <option id="region"></option>
                      @foreach($dataRegion as $Region)
                      <option value="{{$Region->regioname}}">{{$Region->regioname}}</option>
                      @endforeach
                    </select>
                    
                  </div>
                  
                </div>
              </div>     
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-4">
                    <label for="Address"> Address</label>
                    <input type="text" class="form-control" id="address">
                  </div>
                  <div class="col-lg-4">
                    <label for="Contact Number">Contact Number</label>
                    <input type="text" class="form-control" id="contactnum">
                  </div>
                  <div class="col-lg-4">
                    <label for="Blood Type"> Blood Type</label>
                    <select name="bloodtype" class="form-control">
                      <option id="bloodtype"></option>
                      <option value="A+">A+</option>
                      <option value="A-">A-</option>
                      <option value="B+">B+</option>
                      <option value="B-">B-</option>
                      <option value="O+">O+</option>
                      <option value="O-">O-</option>
                      <option value="AB+">AB+</option>
                      <option value="AB-">AB-</option>
                    </select>
                  </div>
                  
                </div>
              </div>     
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-4">
                    <label for="Contact Person"> Contact Person</label>
                    <input type="text" class="form-control" id="contactperson">
                  </div>
                  <div class="col-lg-4">
                    <label for="Contact Person #">Contact Person #</label>
                    <input type="text" class="form-control" id="contactpersonnum">
                  </div>
                  <div class="col-lg-4">
                    <label for="Relation"> Relation</label>
                    <input type="text" class="form-control" id="relation">
                  </div>
                  
                </div>
              </div>     
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-4">
                    <label for="Email"> Email</label>
                    <input type="text" class="form-control" id="email">
                  </div>
                  <div class="col-lg-4">
                    <label for="Website">Website</label>
                    <input type="text" class="form-control" id="website">
                  </div>
                  <div class="col-lg-4">
                    <label for="TIN"> TIN</label>
                    <input type="text" class="form-control" id="tin">
                  </div>
                  
                </div>
              </div>     
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-4">
                    <label for="Philhealth"> Philhealth</label>
                    <input type="text" class="form-control" id="philhealth">
                  </div>
                  <div class="col-lg-4">
                    <label for="SSS/GSIS:">SSS/GSIS</label>
                    <input type="text" class="form-control" id="sssgsis">
                  </div>
                  <div class="col-lg-4">
                    <label for="Pag-ibig"> Pag-ibig</label>
                    <input type="text" class="form-control" id="pagibig">
                  </div>
                  
                </div>
              </div>       
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-4">
                    <label for="Birthdate"> Birthdate</label>
                    <input type="text" class="form-control" id="birthdate">
                  </div>
                  <div class="col-lg-4">
                    <label for="Religion">Religion</label>
                    <input type="text" class="form-control" id="religion">
                  </div>
                  
                </div>
  						</div>            
  					</form>
  					<div class="deleteContent">
  						Are you sure you want to delete this member<span class="dname"></span> ? <span
  							class="hidden did"></span>
  					</div>
  					<div class="modal-footer">
  						<button type="button" class="btn actionBtn" data-dismiss="modal">
              <i class="fa fa-pencil" id="actionicon">  </i> <span id="footer_action_button"> </span>
  						</button>
  						<button type="button" class="btn btn-warning" data-dismiss="modal">
              <i class="fa fa-times"> </i> Close
  						</button>
  					</div>
  				</div>
  			</div>
		  </div>
  <!-- /.row -->
</div>

<script type="text/javascript">
$('#club').on('change',function(){
  $value=$(this).val();
  $.ajax({
    type : 'get',
    url : '{{URL::to("/assistant/clubsearch")}}',
    data:{'search':$value},
    success:function(data){
      $('.memberresult').html(data);
    } 
  });
  $('.print').hide();
  $('.prepareprint').show();
})
</script> 
<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/assitantquickview.js') }}"></script>
@endsection

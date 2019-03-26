<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Position;
use App\Club;
use App\Region;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dataPosition = Position::all();
        $Club = Club::count();
        $Region = Region::count();
        $Member = Member::count();
        $dataMember = Member::take(10)->get();
        $dataClub = Club::take(10)->with('members')->get();
        $dataRegion = Region::take(10)->with('members')->get();
        return view('home', compact('dataClub','dataRegion','dataMember','Club', 'Region', 'Member'));
    }
    public function regions()
    {
        $dataPosition = Position::all();
        $Club = Club::count();
        $Region = Region::count();
        $Member = Member::count();
        $dataRegion = Region::with('members')->get();
        return view('region', compact('dataRegion','Club', 'Region', 'Member'));
    }
    public function clubs()
    {
        $dataPosition = Position::all();
        $Club = Club::count();
        $Region = Region::count();
        $Member = Member::count();  
        $dataClub = Club::with('members')->get();
        return view('clubs', compact('dataClub','Club', 'Region', 'Member'));
    }

    public function about()
    {
        return("About");
    }

    public function members(){
        $dataPosition = Position::all();
        $dataClub = Club::all();
        $dataRegion = Region::all();
        $dataMember = Member::paginate(50);
        return view('members',compact('dataMember','dataPosition', 'dataClub', 'dataRegion'));
    }
    public function viewregions($regionname){
        $dataPosition = Position::all();
        $dataClub = Club::all();
        $dataRegion = Region::all();
        $dataMember = Member::where('region','=', $regionname)
                ->get();
        return view('regionmemberlist',compact('dataMember','dataPosition', 'dataClub', 'dataRegion'));
    }

    public function editmembers(Request $request) {
        
        //dd($request);
        $data = Member::find($request->id);
        $data->fname = $request->fname;
        $data->mname = $request->mname; 
        $data->lname = $request->lname; 
        $data->personalidnumber = $request->personalid; 
        $data->clubidnumber = $request->clubnumber; 
        $data->regionalidnumber = $request->regnumber;
        $data->position = $request->position; 
        $data->club = $request->club; 
        $data->region = $request->region; 
        $data->address = $request->address; 
        $data->personalcontact = $request->contactnum;
        $data->bloodtype = $request->bloodtype; 
        $data->contactperson = $request->contactperson; 
        $data->contactpersonnumber = $request->contactpersonnum; 
        $data->relation = $request->relation; 
        $data->email = $request->email;
        $data->website = $request->website; 
        $data->tin = $request->tin; 
        $data->philhealth = $request->philhealth; 
        $data->sssgsis = $request->sssgsis; 
        $data->pagibig = $request->pagibig;
        $data->bdate = $request->birthdate; 
        $data->religion = $request->religion; 
        $data->save();

        return response()->json($data);

    }

    public function memberssearch (Request $request){
        if($request->ajax())
        {
            $dataMember = Member::where('fname','LIKE','%'.$request->search."%")
                ->orWhere('lname','LIKE','%'.$request->search."%")
                ->orWhere('mname','LIKE','%'.$request->search."%")
                ->orWhere('personalidnumber','LIKE','%'.$request->search."%")
                ->orWhere('clubidnumber','LIKE','%'.$request->search."%")
                ->orWhere('regionalidnumber','LIKE','%'.$request->search."%")
                ->get();
            $output="";
            if($dataMember)
            {
                
                foreach ($dataMember as $key => $Member) {
                   
                        $output.='<tr>
                        <td>'.$Member->personalidnumber.'</td>
                        <td>'.ucwords($Member->lname).', '.ucwords($Member->fname).' '.ucwords($Member->mname).'</td>
                        <td>'.ucwords($Member->region).'</td>
                        <td><a href="javascript:;" 
                          class="quickview btn btn-xs btn-info" 
                          data-id="'.$Member->id.'"
                          data-personalid="'.$Member->personalidnumber.'"
                          data-clubnumber="'.$Member->clubidnumber.'"
                          data-regnumber="'.$Member->regionalidnumber.'" 
                          data-club="'.ucwords($Member->club).'"
                          data-region="'.ucwords($Member->region).'"
                          data-position="'.ucwords($Member->position).'"
                          data-address="'.ucwords($Member->address).'"
                          data-contactnum="'.$Member->personalcontact.'" 
                          data-bloodtype="'.$Member->bloodtype.'"
                          data-contactperson="'.ucwords($Member->contactperson).'"
                          data-contactpersonnum="'.$Member->contactpersonnumber.'"
                          data-relation="'.ucwords($Member->relation).'"
                          data-email="'.$Member->email.'" 
                          data-website="'.$Member->website.'"
                          data-tin="'.$Member->tin.'"
                          data-birthdate="'.$Member->bdate.'"
                          data-philhealth="'.$Member->philhealth.'"
                          data-sssgsis="'.$Member->sssgsis.'" 
                          data-pagibig="'.$Member->pagibig.'" 
                          data-religion="'.$Member->pagibig.'"
                          data-name="'.ucwords($Member->lname).', '.ucwords($Member->fname).' '.ucwords($Member->mname).'"
                          data-fname="'.ucwords($Member->fname).'"
                          data-lname="'.ucwords($Member->lname).'"
                          data-mname="'.ucwords($Member->mname).'">
                            <i class="fa fa-search"> </i> Quick View</a>
                        </td>';
                        $output .='</tr>';
                    
                }
                return Response($output);
            }
        }
    }
}

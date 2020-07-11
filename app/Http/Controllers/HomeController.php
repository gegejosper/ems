<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Position;
use App\Club;
use App\Region;
use App\User;
use App\Exports\MemberExport;
use App\Exports\CustomMemberExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Imports\MembersImport;


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
        $dataMember = Member::all(); 
        $dataRegion = $dataMember->groupBy('region');
        //$dataRegion = Region::with('members')->get();
        return view('region', compact('dataRegion','Club', 'Region', 'Member'));
    }
    public function clubs()
    {
        $dataPosition = Position::all();
        $Club = Club::count();
        $Region = Region::count();
        $Member = Member::count();  
        $dataMember = Member::all();  
        //$dataClub = Club::with('members')->get();
        $dataClub = $dataMember->groupBy('club');
        return view('clubs', compact('dataClub','Club', 'Region', 'Member'));
    }

    public function about()
    {
        return("About");
    }
    public function updateaccount(Request $req)
    {
        $data = User::find($req->id);
        $data->name = $req->name;
        $data->email = $req->email;
        $data->password = Hash::make($req->password);
        $data->save();

        return response()->json($data);
    }

    public function members(){
        $dataPosition = Position::all();
        $dataClub = Club::all();
        $dataRegion = Region::all();
        $dataMember = Member::latest()->paginate(50);
        return view('members',compact('dataMember','dataPosition', 'dataClub', 'dataRegion'));
    }

    public function deletemember(Request $req){
        Member::find($req->id)->delete(); 
        return response()->json();
      }
    public function viewregions($regionname){
        $dataPosition = Position::all();
        
        $dataMembers = Member::all(); 
        $dataClub = $dataMembers->groupBy('club');
        $dataRegion = $dataMembers->groupBy('region');
        $dataMember = Member::where('region','=', $regionname)
                ->latest()
                ->get();
        return view('regionmemberlist',compact('dataMember','dataPosition', 'dataClub', 'dataRegion'));
    }
    public function viewclub($clubname){
        $dataPosition = Position::all();
        $dataMembers = Member::all(); 
        $dataClub = $dataMembers->groupBy('club');
        $dataRegion = $dataMembers->groupBy('region');
        $dataMember = Member::where('club','=', $clubname)
            ->latest()    
            ->get();
        return view('clubmemberlist',compact('dataMember','dataPosition', 'dataClub', 'dataRegion'));
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

    public function addmembers(Request $request) {
        
        //dd($request->positionadd);
        
        $data = new Member();
        $data->fname = $request->fnameadd;
        $data->mname = $request->mnameadd; 
        $data->lname = $request->lnameadd; 
        $data->personalidnumber = $request->personalidadd; 
        $data->clubidnumber = $request->clubnumberadd; 
        $data->regionalidnumber = $request->regnumberadd;
        $data->position = $request->positionadd; 
        $image = $request->file('input_img');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/member');
        $image->move($destinationPath, $name);
        $data->pic =  $name;
        $data->club = $request->clubadd; 
        $data->region = $request->regionadd; 
        $data->address = $request->addressadd; 
        $data->personalcontact = $request->contactnumadd;
        $data->bloodtype = $request->bloodtypeadd; 
        $data->contactperson = $request->contactpersonadd; 
        $data->contactpersonnumber = $request->contactpersonnumadd; 
        $data->relation = $request->relationadd; 
        $data->email = $request->emailadd;
        $data->website = $request->websiteadd; 
        $data->tin = $request->tinadd; 
        $data->philhealth = $request->philhealthadd; 
        $data->sssgsis = $request->sssgsisadd; 
        $data->pagibig = $request->pagibigadd;
        $data->bdate = $request->birthdateadd; 
        $data->religion = $request->religionadd; 
        $data->save();

        $dataPosition = Position::where('positionname', '=', $request->positionadd)->count();
            if($dataPosition == 0 ){
                $position = new Position();
                $position->positionname = $request->positionadd;
                $position->save(); 
            }
        $dataClub = Club::where('clubname', '=',$request->clubadd)->count();
            if($dataClub == 0 ){
                $Club = new Club();
                $Club->clubname = $request->clubadd;
                $Club->save(); 
            }
        $dataRegion = Region::where('regioname', '=',$request->regionadd);
            if($dataRegion == 0 ){
                $Region = new Region();
                $Region->regioname = $request->regionadd;
                $Region->save(); 
            }
        return redirect()->back()->with('success','Member Successfully Added!');
        //return response()->json($data);

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
                ->latest()
                ->get();
            $output="";
            if($dataMember)
            {
                
                foreach ($dataMember as $key => $Member) {
                        if(empty($Member->pic)){
                            $pic = '/img/logo.png';
                        }
                        else {
                            $pic = '/member/'.$Member->pic;
                        }
                        $output.='<tr>
                        <td>'.$Member->personalidnumber.'</td>
                        <td>'.ucwords($Member->lname).', '.ucwords($Member->fname).' '.ucwords($Member->mname).'</td>
                        <td>'.ucwords($Member->region).'</td>
                        <td><a href="javascript:;" 
                          class="quickview btn btn-xs btn-info" 
                          data-id="'.$Member->id.'"
                          data-pic="'.$pic.'"
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
    public function regionsearch (Request $request){
        //dd($request);
        if($request->ajax())
        {
            $dataMember = Member::where('region','LIKE','%'.$request->search."%")
                ->latest()
                ->get();
            $output="";
            if($dataMember)
            {
                $num = 1;
                foreach ($dataMember as $key => $Member) {
                   
                        $output.='<tr>
                        <td>'.$num.'</td>
                        <td>'.$Member->personalidnumber.'</td>
                        <td>'.ucwords($Member->lname).', '.ucwords($Member->fname).' '.ucwords($Member->mname).'</td>
                        <td>'.ucwords($Member->club).'</td>
                        <td class="quickviewcol"><a href="javascript:;" 
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
                 $num += 1;   
                }
                return Response($output);
            }
        }
    }
    public function clubsearch (Request $request){
        //dd($request);
        if($request->ajax())
        {
            $dataMember = Member::where('club','LIKE','%'.$request->search."%")
                ->latest()
                ->get();
            $output="";
            if($dataMember)
            {
                $num = 1;
                foreach ($dataMember as $key => $Member) {
                   
                        $output.='<tr>
                        <td>'.$num.'</td>
                        <td>'.$Member->personalidnumber.'</td>
                        <td>'.ucwords($Member->lname).', '.ucwords($Member->fname).' '.ucwords($Member->mname).'</td>
                        <td>'.ucwords($Member->club).'</td>
                        <td class="quickviewcol"><a href="javascript:;" 
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
                 $num += 1;   
                }
                return Response($output);
            }
        }
    }
    use Exportable;
    public function downloadExcel($type)
    { 
        return Excel::download(new MemberExport, 'members.csv');
    }
    public function exportcustom(Request $request){
        return (new CustomMemberExport($request->type,$request->importtype))->download($request->importtype.'.csv');
    }
    public function export(){
        $dataMember = Member::all();
        $dataClub = $dataMember->groupBy('club');
        $dataRegion = $dataMember->groupBy('region');
        //dd($dataClub);
        return view('export', compact('dataClub','dataRegion'));
    }
    public function import(){
        return view('import');
    }
    public function uploads(){
        return view('upload');
    }
    public function prouploads(Request $request){
        //$image = $request->file('img_file');
        //$name = time().'.'.$image->getClientOriginalExtension();
        foreach($request->file('img_file') as $imagefile){
            $imgname = $imagefile->getClientOriginalName();
            $destinationPath = public_path('/member');
            $imagefile->move($destinationPath, $imgname);
        }
        return redirect()->back()->with('success','Images succesfully uploaded!');
        
    }
    public function importmembers(){
        Excel::import(new MembersImport,request()->file('file'));
        return redirect()->back()->with('success','Members succesfully imported!');
        return back();
    }
}

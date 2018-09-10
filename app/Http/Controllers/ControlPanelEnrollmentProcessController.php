<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateEnrollmentFlowRequest;
use App\Http\Requests;

use App\EfsVersion;
use App\EnrollmentFlowSource;
use App\EnrollmentModule;
use Carbon\Carbon;
use Response;

class ControlPanelEnrollmentProcessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('access')->only('index');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('c_panel.enrollment_process.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEnrollmentFlowRequest $request)
    {
        $steps = $request->input('steps');
        
        $request['status'] = 'deactive';
        $version = EfsVersion::create($request->all());
        $count = 0;

        foreach ($steps as $step) {
            $image = $step['img_path'];
            $count++;

            if ($image != '../images/control-panel/enroll-thread-prev/admission.fw.png') {
                $filteredData = explode(',', $image);
                
                if (count($filteredData) > 1) {
                    $unencoded = base64_decode($filteredData[1]);

                    $string = str_replace('/', '-', $step['steps_title']); // Replaces all spaces with hyphens.
                    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
                    $name = time() . $string . $count;
                    $path = 'public/images/control-panel/enroll-thread-prev/'. $name.'.png';

                    $fp = fopen($path, 'w+');
                    fwrite($fp, $unencoded);
                    fclose($fp); 

                    $step['img_path'] = '../'.$path;
                }
                
            }
            
            $enrollment_flow = EnrollmentFlowSource::create($step);
            $version->classifications()->attach($enrollment_flow->ef_id);
        }

        return ['message' => 'Successfully Added'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateEnrollmentFlowRequest $request, $id)
    {
        $steps = $request->input('steps');
        
        $request['version'] = (double) $request['version'] + 0.1;
        $request['version'] = (String) $request['version'];
        $version = EfsVersion::find($id);
        $version->update($request->all());
        $count = 0;
        // $version->classifications()->detach();

        foreach ($steps as $step) {
            $image = $step['img_path'];
            $count++;
            $filteredData = explode(',', $image);

            if ($step['ef_id']) {

                if (count($filteredData) > 1) {
                    if ($image != '../images/control-panel/enroll-thread-prev/admission.fw.png') {
                        $unencoded = base64_decode($filteredData[1]);
                        $string = str_replace('/', '-', $step['steps_title']); // Replaces all spaces with hyphens.
                        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
                        $name = time() . $string . $count;
                        $path = 'public/images/control-panel/enroll-thread-prev/'. $name.'.png';

                        $fp = fopen($path, 'w+');
                        fwrite($fp, $unencoded);
                        fclose($fp); 

                        $step['img_path'] = '../'.$path;
                    }
                }
                $enrollment_flow = EnrollmentFlowSource::find($step['ef_id'])->update($step);
            } else {
                if (count($filteredData) > 1) {
                    if ($image != '../images/control-panel/enroll-thread-prev/admission.fw.png') {
                        $unencoded = base64_decode($filteredData[1]);
                        $string = str_replace('/', '-', $step['steps_title']); // Replaces all spaces with hyphens.
                        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
                        $name = time() . $string . $count;
                        $path = 'public/images/control-panel/enroll-thread-prev/'. $name.'.png';

                        $fp = fopen($path, 'w+');
                        fwrite($fp, $unencoded);
                        fclose($fp); 

                        $step['img_path'] = '../'.$path;
                    }
                }

                $enrollment_flow = EnrollmentFlowSource::create($step);
                $version->classifications()->attach($enrollment_flow->ef_id);
            }
        }

        return ['message' => 'Successfully Updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $step = EnrollmentFlowSource::find($id);

        $path_primary = $step->img_path;
        $new_path = explode('../', $path_primary);

        if (file_exists($new_path[1])) {
            unlink($new_path[1]);
        }
        $step->delete();

        return ['message' => 'Successfully Deleted'];
    }

    public function getVersion()
    {
       $level = $_GET['level'];

       $versions = EfsVersion::where('level', $level)->with('classifications')->get();

       return Response::json($versions);
    }

    public function active(Request $request)
    {
        $id = $request->input('id');
        $level = $request->input('level');
        $student_type = $request->input('student_type');

        EfsVersion::where('efv_id', $id)->where('student_type', $student_type)->update(['status' => 'active']);
        EfsVersion::where('efv_id', '!=', $id)->where('student_type', $student_type)->where('level', $level)
        ->update(['status' => 'deactive']);

    }

    public function getModules()
    {
        $modules = EnrollmentModule::all();

       return Response::json($modules);
    }
}

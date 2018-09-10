<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'HomeController@index');

Route::get('/datatable',[
	'as'	=>	'datatable.data',
	'uses'	=>	'DataTableController@allData'
]);

Route::get('/requirements-all',[
    'as'    =>  'requirements.data',
    'uses'  =>  'DashboardController@allReqData'
]);

Auth::routes();

Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
});
// Route::get('/home', 'HomeController@index')->name('home');

Route::get('address-city',[
    'as'    =>  'address_city',
    'uses'  =>  'HomeController@city'
]);


/*
|-----------------------------------------------------------------------------------------------------------
| Grade Overide
|-----------------------------------------------------------------------------------------------------------
*/

Route::resource('grade-override', 'GradeOverideController');

// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| Grade Evaluation
|-----------------------------------------------------------------------------------------------------------
*/

Route::resource('grade-evaluation', 'GradeEvaluationController');

Route::post('grade-eval-verify',[
    'as'    =>  'grade-eval-verify',
    'uses'  =>  'GradeEvaluationController@verifyEval'
]);

// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| Instructor Master List
|-----------------------------------------------------------------------------------------------------------
*/

Route::resource('instructor-master-list', 'InstructorMasterListController');

// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| C-Panel
|-----------------------------------------------------------------------------------------------------------
*/

Route::resource('c-panel/enrollment-process', 'ControlPanelEnrollmentProcessController');

Route::resource('c-panel/program-settings', 'ControlPanelProgramSettingController');

Route::resource('c-panel/queue-settings', 'ControlPanelQueueSettingController');

Route::resource('c-panel/general-settings', 'ControlPanelGeneralSettingController');

Route::resource('c-panel/account-management', 'ControlPanelController');

Route::resource('c-panel/log-history', 'ControlPanelLogHistoryController');

Route::get('c-panel/all-modules',[
    'as'    =>  'cpanel.all-modules',
    'uses'  =>  'ControlPanelEnrollmentProcessController@getModules'
]);

Route::get('c-panel/employee-user-info',[
    'as'    =>  'cpanel.eui',
    'uses'  =>  'ControlPanelController@getUserInfo'
]);

Route::get('c-panel/access-list',[
    'as'    =>  'cpanel.al',
    'uses'  =>  'ControlPanelController@getAccessList'
]);

Route::get('c-panel/registered-users-list',[
    'as'    =>  'cpanel.rul',
    'uses'  =>  'ControlPanelController@getRegisteredUsers'
]);

Route::post('c-panel/active-deactive',[
    'as'    =>  'cpanel.ad',
    'uses'  =>  'ControlPanelController@activeOrDeactive'
]);

Route::get('c-panel/program-settings-poglist',[
    'as'    =>  'cpanel.rul',
    'uses'  =>  'ControlPanelProgramSettingController@getProgramList'
]);

Route::get('c-panel/program-settings-acthis',[
    'as'    =>  'cpanel.acthis',
    'uses'  =>  'ControlPanelProgramSettingController@getActivaitonHistories'
]);

Route::post('c-panel/program-settings-actdeact',[
    'as'    =>  'cpanel.actdeact',
    'uses'  =>  'ControlPanelProgramSettingController@activeOrDeactive'
]);

Route::get('c-panel/enrollment-process-version',[
    'as'    =>  'cpanel.enrollproc-ver',
    'uses'  =>  'ControlPanelEnrollmentProcessController@getVersion'
]);

Route::post('c-panel/enrollment-process-active',[
    'as'    =>  'cpanel.enrollproc.active',
    'uses'  =>  'ControlPanelEnrollmentProcessController@active'
]);

Route::get('c-panel/general-settings-req',[
    'as'    =>  'cpanel.genset-req',
    'uses'  =>  'ControlPanelGeneralSettingController@getRequirements'
]);

Route::post('c-panel/general-settings-activeordeact',[
    'as'    =>  'cpanel.genset.active',
    'uses'  =>  'ControlPanelGeneralSettingController@activeOrDeactive'
]);

Route::post('c-panel/general-settings-addscholar',[
    'as'    =>  'cpanel.genset.addscholar',
    'uses'  =>  'ControlPanelGeneralSettingController@storeScholarship'
]);

Route::get('c-panel/general-settings-scholar',[
    'as'    =>  'cpanel.genset-scholar',
    'uses'  =>  'ControlPanelGeneralSettingController@getScholarship'
]);

Route::delete('c-panel/general-settings-scholar-del/{id}',[
    'as'    =>  'cpanel.genset-scholardel',
    'uses'  =>  'ControlPanelGeneralSettingController@deleteScholarship'
]);

Route::patch('c-panel/general-settings-scholar-edit/{id}',[
    'as'    =>  'cpanel.genset-scholaredit',
    'uses'  =>  'ControlPanelGeneralSettingController@updateScholarship'
]);

Route::get('c-panel/log-history-get',[
    'as'    =>  'cpanel.loghis-get',
    'uses'  =>  'ControlPanelLogHistoryController@getLogHistories'
]);

Route::get('c-panel/queue-settings-getregdep',[
    'as'    =>  'cpanel.queueset-getregdep',
    'uses'  =>  'ControlPanelQueueSettingController@getRegisteredDepartments'
]);

Route::post('c-panel/queue-settings-actdeact',[
    'as'    =>  'cpanel.genset.actdeact',
    'uses'  =>  'ControlPanelQueueSettingController@activateOrDeactivate'
]);
// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| SSG Payment
|-----------------------------------------------------------------------------------------------------------
*/

// Route::resource('ssg-payment/cashier', 'SsgPaymentCashierController');

// Route::resource('ssg-payment/student-payment', 'SsgPaymentStudentPaymentMonitoringController');

// Route::resource('ssg-payment/payment-settings', 'SsgPaymentPaymentSettingsController');

// Route::resource('ssg-payment/payment-report', 'SsgPaymentPaymentReportController');

// Route::resource('ssg-payment/log-history', 'SsgPaymentLogHistoryController');

// Route::resource('ssg-payment/account-settings', 'SsgPaymentController');

// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| Student Information
|-----------------------------------------------------------------------------------------------------------
*/

Route::resource('student-information', 'StudentInformationController');


Route::get('search-enrolled-student',[
    'as'    =>  'search-sib',
    'uses'  =>  'StudentInformationController@getEnrolledStudents'
]);

Route::get('student-questions',[
    'as'    =>  'stud-question',
    'uses'  =>  'StudentInformationController@getQuestions'
]);

Route::get('address-info',[
    'as'    =>  'studentinfo-city',
    'uses'  =>  'StudentInformationController@addressInfo'
]);

Route::get('student-information-column',[
    'as'    =>  'studentinfo-column',
    'uses'  =>  'StudentInformationController@getColumn'
]);

Route::get('student-information-search',[
    'as'    =>  'studentinfo-search',
    'uses'  =>  'StudentInformationController@getSearch'
]);

Route::get('student-information-personal',[
    'as'    =>  'studentinfo-personal',
    'uses'  =>  'StudentInformationController@getAllStudentInfo'
]);

Route::get('student-information-program',[
    'as'    =>  'studentinfo-program',
    'uses'  =>  'StudentInformationController@program'
]);

Route::get('address-info-search',[
    'as'    =>  'studentinfo-program-search',
    'uses'  =>  'StudentInformationController@addressQuery'
]);

Route::delete('student-info-removesib/{id}',[
    'as'    =>  'student-info-removesib',
    'uses'  =>  'StudentInformationController@removeSibling'
]);

Route::post('student-info-addsib',[
    'as'    =>  'student-info-addsib',
    'uses'  =>  'StudentInformationController@addSibling'
]);


// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| Student Subject Loading
|-----------------------------------------------------------------------------------------------------------
*/

Route::resource('student-subject-loading', 'StudentSubjectLoadingController');

Route::get('subject-loading-blocksection',[
    'as'    =>  'subject-loading-blcsec',
    'uses'  =>  'StudentSubjectLoadingController@getBlockSection'
]);

Route::get('subject-loading-allsub',[
    'as'    =>  'subject-loading-allsub',
    'uses'  =>  'StudentSubjectLoadingController@getAllSubject'
]);

Route::post('student-subject-loading-drop',[
    'as'    =>  'subject-loading-dropsub',
    'uses'  =>  'StudentSubjectLoadingController@dropSubjects'
]);

Route::post('student-subject-loading-change',[
    'as'    =>  'subject-loading-changesub',
    'uses'  =>  'StudentSubjectLoadingController@changeSubjects'
]);

Route::post('student-subject-loading-add',[
    'as'    =>  'subject-loading-addsub',
    'uses'  =>  'StudentSubjectLoadingController@addSubjects'
]);

Route::post('student-subject-loading-withdraw',[
    'as'    =>  'subject-loading-withdrawsub',
    'uses'  =>  'StudentSubjectLoadingController@withdrawSubjects'
]);

Route::post('student-subject-loading-advise',[
    'as'    =>  'subject-loading-advisesub',
    'uses'  =>  'StudentSubjectLoadingController@advise'
]);

// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| Student Subject List
|-----------------------------------------------------------------------------------------------------------
*/

Route::resource('student-subject-list', 'StudentSubjectListController');

// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| Subject Crediting
|-----------------------------------------------------------------------------------------------------------
*/

Route::resource('subject-crediting', 'SubjectCreditingController');

Route::resource('uncredited-subject', 'UncreditedSubjectController');

Route::get('credited-subject-history',[
    'as'    =>  'csh-all',
    'uses'  =>  'SubjectCreditingController@getCreditedSubjectsHistory'
]);

Route::get('uncredited-subject-all',[
    'as'    =>  'sl-all',
    'uses'  =>  'UncreditedSubjectController@getAllUncreditedSubjects'
]);

Route::post('uncredited-subject-delete',[
    'as'    =>  'sl-all-del',
    'uses'  =>  'UncreditedSubjectController@removeUncreditedSubjects'
]);
// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| Dashbaord
|-----------------------------------------------------------------------------------------------------------
*/

Route::resource('dashboard', 'DashboardController');

Route::get('dashboard-search',[
    'as'    =>  'dashboard-search',
    'uses'  =>  'HomeController@getSearch'
]);

Route::post('dashboard-verify',[
    'as'    =>  'dashboard-verify',
    'uses'  =>  'DashboardController@verifyStudent'
]);

Route::post('dashboard-exam-verify',[
    'as'    =>  'dashboard-examverify',
    'uses'  =>  'DashboardController@verifyExam'
]);

Route::post('dashboard-cashier-verify',[
    'as'    =>  'dashboard-cashierverify',
    'uses'  =>  'DashboardController@verifyCashier'
]);

Route::post('dashboard-acc-verify',[
    'as'    =>  'dashboard-accverify',
    'uses'  =>  'DashboardController@verifyAccounting'
]);

Route::post('dashboard-ssg-verify',[
    'as'    =>  'dashboard-ssgverify',
    'uses'  =>  'DashboardController@verifySgg'
]);

// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| Admission
|-----------------------------------------------------------------------------------------------------------
*/

Route::resource('admission', 'AdmissionController');

Route::post('admission-add-req',[
    'as'    =>  'admission-addreq',
    'uses'  =>  'AdmissionController@addRequirements'
]);
Route::get('admission-getallprogram',[
    'as'    =>  'admission-getprograms',
    'uses'  =>  'AdmissionController@getPrograms'
]);

Route::get('admission-province',[
    'as'    =>  'admission-province',
    'uses'  =>  'AdmissionController@city'
]);

Route::get('admission-search-student',[
    'as'    =>  'admission-search',
    'uses'  =>  'AdmissionController@getSearch'
]);

Route::post('admission-nextqueue',[
    'as'    =>  'admission-next',
    'uses'  =>  'AdmissionController@nextQueue'
]);

Route::get('admission-search-school',[
    'as'    =>  'admission-searchschool',
    'uses'  =>  'AdmissionController@getSearchSchoolName'
]);

Route::post('admission-transfer',[
    'as'    =>  'admission-trans',
    'uses'  =>  'AdmissionController@transferCredentials'
]);



// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| SHort Course
|-----------------------------------------------------------------------------------------------------------
*/

Route::resource('short-course', 'ShortCourseController');

// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| Report
|-----------------------------------------------------------------------------------------------------------
*/

Route::resource('reports', 'ReportController');

Route::get('reports-enrolled-students',[
    'as'    =>  'reports.el',
    'uses'  =>  'ReportController@getStudentsEnrolled'
]);

Route::get('reports-transferee-students',[
    'as'    =>  'reports.ts',
    'uses'  =>  'ReportController@getTransfereeEnrolled'
]);

Route::get('reports-withdraw-students',[
    'as'    =>  'reports.ws',
    'uses'  =>  'ReportController@getWithdrawnStudents'
]);

Route::get('reports-subject-students',[
    'as'    =>  'reports.ss',
    'uses'  =>  'ReportController@subjectSchedulesAndNoOfStudents'
]);

Route::get('reports-subject-changelog',[
    'as'    =>  'reports.sc',
    'uses'  =>  'ReportController@subjectChangeLog'
]);

// ---------------------------------------------------------------------------------------------------------



/*
|-----------------------------------------------------------------------------------------------------------
| Grade Encoding
|-----------------------------------------------------------------------------------------------------------
*/

Route::resource('grade-encode', 'GradeEncodeController');

Route::get('grade-encode-search',[
    'as'    =>  'grade-encode.search',
    'uses'  =>  'GradeEncodeController@searchCurriculum'
]);


// ---------------------------------------------------------------------------------------------------------

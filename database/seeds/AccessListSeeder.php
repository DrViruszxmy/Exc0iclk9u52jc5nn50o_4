<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class AccessListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
        	'Dashboard' => [
                'Enrollment Verification Button', 
                'Examination Verification Button', 
                'SSG Verification Button', 
                'Cashier Verification Button',
                'Accounting Verification Button',
                'View Only'
            ], 
        	'Admission' => ['Save', 'Delete', 'Queue', 'Transfer', 'View Only'], 
        	'Student Information' => ['Edit', 'Delete', 'Sibling', 'Download', 'Create ID', 'Upload Requirements', 'View Only'], 
        	'Grades Evaluation' => ['Transcript of Records', 'Evaluation Form', 'Semestral Grades', 'View Only'], 
        	'Subject Crediting' => [
        		'Save Credited Subjects', 'Edit Credited Subjects', 
        		'Save Uncredited Subjects', 'Delete Uncredited Subjects',
                'View Only'
        	], 
        	'Student Subject Loading' => ['Save', 'Drop', 'Change', 'Withdraw', 'Add', 'Print', 'Advise' , 'View Plot', 'View Only'],
        	'Enrolled Students' => ['Print', 'View Only'], 
            'Grade Overide' => ['Override', 'Save', 'View Only'],
            'Short Course' => ['Save', 'Edit', 'Delete', 'View Only'],
            'Reports' => ['Print', 'View Only'],
        	'Account Management' => ['Save', 'Edit', 'Activate', 'Deactivate', 'View Only'], 
        	'Program Settings' => ['Save', 'Modify', 'Activate', 'Deactivate', 'View Only'], 
        	'Enrollment Process' => ['Save', 'Edit', 'Activate', 'View Only'], 
        	'General Settings' => [
                'Save Requirements', 
                'Modify Requirements', 
                'Delete Requirements', 
                'Activate Requirements', 
                'Deactivate Requirements', 
                'Save Scholarships', 
                'Modify Scholarships', 
                'Delete Scholarships', 
                'View Only'
            ], 
        	'Log History' => ['Download', 'Print', 'View Only'], 
        	'Queue Settings' => ['Register', 'Activate', 'Deactivate', 'View Only'], 
        	
        ];

        $user = App\User::create([
                    'username' => 'admin',
                    'password' => Bcrypt('admin'),
                    'employee_id' => 'BTN- 2010-0128',
                    'status' => 'activate',
                    'status' => 'activate',
                    'account_span' => '1'
                ]);

        foreach ($modules as $key => $module) {
        	
        	if ($key == 'Dashboard') {
                $new_module = App\AccessList::create([
                    'module_name' => $key,
                    'link' => 'dashboard.index',
                    'active_class' => 'dashboard',
                    'image_path' => 'images/control-panel/account-management/access-portal/thread.fw.png'
                ]);

        		foreach ($module as $mod) {
        			$mod = App\SubModuleList::create([
		        		'al_id' => $new_module->al_id,
		        		'sub_module' => $mod
		        	]);
                    $mod->accessiblities()->attach($user->user_id, ['date_created' => new Carbon()]);
        		}
        		
        	}
        	if ($key == 'Admission') {
                $new_module = App\AccessList::create([
                    'module_name' => $key,
                    'link' => 'admission.index',
                    'active_class' => 'admission',
                    'image_path' => 'images/thread/pre-reg.fw.png'
                ]);

        		foreach ($module as $mod) {
        			$mod = App\SubModuleList::create([
		        		'al_id' => $new_module->al_id,
		        		'sub_module' => $mod
		        	]);

                    $mod->accessiblities()->attach($user->user_id, ['date_created' => new Carbon()]);
        		}
        	}
        	if ($key == 'Student Information') {
                $new_module = App\AccessList::create([
                    'module_name' => $key,
                    'link' => 'student-information.index',
                    'active_class' => 'student-information',
                    'image_path' => 'images/control-panel/account-management/access-portal/stud-info.fw.png'
                ]);

        		foreach ($module as $mod) {
        			$mod = App\SubModuleList::create([
		        		'al_id' => $new_module->al_id,
		        		'sub_module' => $mod
		        	]);
                    $mod->accessiblities()->attach($user->user_id, ['date_created' => new Carbon()]);
        		}
        	}
        	if ($key == 'Grades Evaluation') {
                $new_module = App\AccessList::create([
                    'module_name' => $key,
                    'link' => 'grade-evaluation.index',
                    'active_class' => 'grade-evaluation',
                    'image_path' => 'images/control-panel/account-management/access-portal/grade-eval.fw.png'
                ]);

        		foreach ($module as $mod) {
        			$mod = App\SubModuleList::create([
		        		'al_id' => $new_module->al_id,
		        		'sub_module' => $mod
		        	]);
                    $mod->accessiblities()->attach($user->user_id, ['date_created' => new Carbon()]);
        		}
        	}
        	if ($key == 'Subject Crediting') {
                $new_module = App\AccessList::create([
                    'module_name' => $key,
                    'link' => 'subject-crediting.index',
                    'active_class' => 'subject-crediting',
                    'image_path' => 'images/nav-logo/subject-credit.fw.png'
                ]);

        		foreach ($module as $mod) {
        			$mod = App\SubModuleList::create([
		        		'al_id' => $new_module->al_id,
		        		'sub_module' => $mod
		        	]);
                    $mod->accessiblities()->attach($user->user_id, ['date_created' => new Carbon()]);
        		}
        	}
        	if ($key == 'Student Subject Loading') {
                $new_module = App\AccessList::create([
                    'module_name' => $key,
                    'link' => 'student-subject-loading.index',
                    'active_class' => 'student-subject-loading',
                    'image_path' => 'images/control-panel/account-management/access-portal/stud-sub-load.fw.png'
                ]);

        		foreach ($module as $mod) {
        			$mod = App\SubModuleList::create([
		        		'al_id' => $new_module->al_id,
		        		'sub_module' => $mod
		        	]);

                    $mod->accessiblities()->attach($user->user_id, ['date_created' => new Carbon()]);
        		}
        	}
        	if ($key == 'Enrolled Students') {
                $new_module = App\AccessList::create([
                    'module_name' => $key,
                    'link' => 'student-subject-list.index',
                    'active_class' => 'student-subject-list',
                    'image_path' => 'images/nav-logo/instructor-list.fw.png'
                ]);

        		foreach ($module as $mod) {
        			App\SubModuleList::create([
		        		'al_id' => $new_module->al_id,
		        		'sub_module' => $mod
		        	]);
        		}
        	}
            if ($key == 'Short Course') {
                $new_module = App\AccessList::create([
                    'module_name' => $key,
                    'link' => 'short-course.index',
                    'active_class' => 'short-course',
                    'image_path' => 'images/nav-logo/short.fw.png'
                ]);

                foreach ($module as $mod) {
                    App\SubModuleList::create([
                        'al_id' => $new_module->al_id,
                        'sub_module' => $mod
                    ]);
                }
            }
            if ($key == 'Reports') {
                $new_module = App\AccessList::create([
                    'module_name' => $key,
                    'link' => 'reports.index',
                    'active_class' => 'reports',
                    'image_path' => 'images/nav-logo/instructor-list.fw.png'
                ]);

                foreach ($module as $mod) {
                    App\SubModuleList::create([
                        'al_id' => $new_module->al_id,
                        'sub_module' => $mod
                    ]);
                }
            }
        	if ($key == 'Account Management') {
                $new_module = App\AccessList::create([
                    'module_name' => $key,
                    'link' => 'account-management.index',
                    'active_class' => 'c-panel/account-management',
                    'image_path' => 'images/control-panel/account-management/panel/account-management.fw.png'
                ]);

        		foreach ($module as $mod) {
        			$mod = App\SubModuleList::create([
		        		'al_id' => $new_module->al_id,
		        		'sub_module' => $mod
		        	]);
                    $mod->accessiblities()->attach($user->user_id, ['date_created' => new Carbon()]);
        		}
        	}
        	if ($key == 'Program Settings') {
                $new_module = App\AccessList::create([
                    'module_name' => $key,
                    'link' => 'program-settings.index',
                    'active_class' => 'c-panel/program-settings',
                    'image_path' => 'images/control-panel/account-management/panel/program-setting.fw.png'
                ]);

        		foreach ($module as $mod) {
        			App\SubModuleList::create([
		        		'al_id' => $new_module->al_id,
		        		'sub_module' => $mod
		        	]);
        		}
        	}
        	if ($key == 'Enrollment Process') {
                $new_module = App\AccessList::create([
                    'module_name' => $key,
                    'link' => 'enrollment-process.index',
                    'active_class' => 'c-panel/enrollment-process',
                    'image_path' => 'images/control-panel/account-management/panel/enrollment-process.fw.png'
                ]);

        		foreach ($module as $mod) {
        			App\SubModuleList::create([
		        		'al_id' => $new_module->al_id,
		        		'sub_module' => $mod
		        	]);
        		}
        	}
        	if ($key == 'General Settings') {
                $new_module = App\AccessList::create([
                    'module_name' => $key,
                    'link' => 'general-settings.index',
                    'active_class' => 'c-panel/general-settings',
                    'image_path' => 'images/control-panel/account-management/panel/req-sectors.fw.png'
                ]);

        		foreach ($module as $mod) {
        			App\SubModuleList::create([
		        		'al_id' => $new_module->al_id,
		        		'sub_module' => $mod
		        	]);
        		}
        	}
        	if ($key == 'Log History') {
                $new_module = App\AccessList::create([
                    'module_name' => $key,
                    'link' => 'log-history.index',
                    'active_class' => 'c-panel/log-history',
                    'image_path' => 'images/control-panel/account-management/panel/log-history.fw.png'
                ]);

        		foreach ($module as $mod) {
        			App\SubModuleList::create([
		        		'al_id' => $new_module->al_id,
		        		'sub_module' => $mod
		        	]);
        		}
        	}
        	if ($key == 'Queue Settings') {
                $new_module = App\AccessList::create([
                    'module_name' => $key,
                    'link' => 'queue-settings.index',
                    'active_class' => 'c-panel/queue-settings',
                    'image_path' => 'images/control-panel/account-management/panel/queue.fw.png'
                ]);
                
        		foreach ($module as $mod) {
        			App\SubModuleList::create([
		        		'al_id' => $new_module->al_id,
		        		'sub_module' => $mod
		        	]);
        		}
        	}
        	if ($key == 'Grade Overide') {
                $new_module = App\AccessList::create([
                    'module_name' => $key,
                    'link' => 'grade-override.index',
                    'active_class' => 'grade-override',
                    'image_path' => 'images/nav-logo/grade-overide.fw.png'
                ]);

        		foreach ($module as $mod) {
        			App\SubModuleList::create([
		        		'al_id' => $new_module->al_id,
		        		'sub_module' => $mod
		        	]);
        		}
        	}
        }
    }
}

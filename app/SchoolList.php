<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\SchoolList;
use App\StudentEnrollmentStat;
use App\Hschool_Student;
use App\CurriculumSchedSubject;
use DB;

class SchoolList extends Model
{
	protected $table = "school_lists";
    protected $primaryKey = "sl_id";
    protected $fillable = ['school_name', 'category'];

    public function setSchoolNameAttribute($school_name)
    {
        $this->attributes['school_name'] = ucwords(strtolower($school_name));
    }

    public function schools()
    {
    	return $this->hasMany(Hschool_Student::class, 'sl_id');
    }

    public static function totalEnrolledStudents($school_lvl, $academic_year, $semester)
    {

        return SchoolList::selectRaw('school_lists.school_name,
                Count(school_lists.school_name) AS total, 
                COUNT(CASE WHEN stud_per_info.gender = "male" THEN 1 END) AS male,
                COUNT(CASE WHEN stud_per_info.gender = "female" THEN 1 END) AS female')
                ->join('hschool_student', 'hschool_student.sl_id', '=', 'school_lists.sl_id')
                ->join('stud_per_info', 'hschool_student.spi_id', '=', 'stud_per_info.spi_id')
                ->join('stud_sch_info', 'stud_sch_info.spi_id', '=', 'stud_per_info.spi_id')
                ->join('student_enrollment_stat', 'student_enrollment_stat.ssi_id', '=', 'stud_sch_info.ssi_id')
                ->join('stud_type', 'stud_sch_info.st_id', '=', 'stud_type.st_id')
                ->where('student_enrollment_stat.status', 'enrolled')
                ->where('school_lists.category', 'junior_high')
                ->where('hschool_student.last_school', 'yes')
                ->where('student_enrollment_stat.sch_year', $academic_year)
                ->where('student_enrollment_stat.semester', $semester)
                ->where('stud_type.type', $school_lvl)
                ->groupBy('school_lists.school_name')
                ->orderBy('school_lists.school_name', 'ASC')
                ->get();
    }

    public static function totalTransfereeStudents($school_lvl, $academic_year, $semester)
    {
        return SchoolList::selectRaw('school_lists.school_name,
                Count(school_lists.school_name) AS total, 
                COUNT(CASE WHEN stud_per_info.gender = "male" THEN 1 END) AS male,
                COUNT(CASE WHEN stud_per_info.gender = "female" THEN 1 END) AS female')
                ->join('hschool_student', 'hschool_student.sl_id', '=', 'school_lists.sl_id')
                ->join('stud_per_info', 'hschool_student.spi_id', '=', 'stud_per_info.spi_id')
                ->join('stud_sch_info', 'stud_sch_info.spi_id', '=', 'stud_per_info.spi_id')
                ->join('student_enrollment_stat', 'student_enrollment_stat.ssi_id', '=', 'stud_sch_info.ssi_id')
                ->join('stud_type', 'stud_sch_info.st_id', '=', 'stud_type.st_id')
                ->join('year', 'year.ssi_id', '=', 'stud_sch_info.ssi_id')
                ->where('student_enrollment_stat.status', 'enrolled')
                ->where('school_lists.category', 'junior_high')
                ->where('hschool_student.last_school', 'yes')
                ->where('year.current_stat', 'transferee')
                ->where('student_enrollment_stat.sch_year', $academic_year)
                ->where('student_enrollment_stat.semester', $semester)
                ->where('stud_type.type', $school_lvl)
                ->groupBy('school_lists.school_name')
                ->orderBy('school_lists.school_name', 'ASC')
                ->get();
    }

    public static function totalWithdrawnStudents($school_lvl, $academic_year, $semester)
    {

        return SchoolList::selectRaw('school_lists.school_name,
                Count(school_lists.school_name) AS total, 
                COUNT(CASE WHEN stud_per_info.gender = "male" THEN 1 END) AS male,
                COUNT(CASE WHEN stud_per_info.gender = "female" THEN 1 END) AS female')
                ->join('hschool_student', 'hschool_student.sl_id', '=', 'school_lists.sl_id')
                ->join('stud_per_info', 'hschool_student.spi_id', '=', 'stud_per_info.spi_id')
                ->join('stud_sch_info', 'stud_sch_info.spi_id', '=', 'stud_per_info.spi_id')
                ->join('student_enrollment_stat', 'student_enrollment_stat.ssi_id', '=', 'stud_sch_info.ssi_id')
                ->join('stud_type', 'stud_sch_info.st_id', '=', 'stud_type.st_id')
                ->join('year', 'year.ssi_id', '=', 'stud_sch_info.ssi_id')
                ->where('student_enrollment_stat.status', 'withdraw')
                ->where('school_lists.category', 'junior_high')
                ->where('hschool_student.last_school', 'yes')
                ->where('student_enrollment_stat.sch_year', $academic_year)
                ->where('student_enrollment_stat.semester', $semester)
                ->where('stud_type.type', $school_lvl)
                ->groupBy('school_lists.school_name')
                ->orderBy('school_lists.school_name', 'ASC')
                ->get();
    }

    public static function subjectSchedulesAndNoOfStudents($school_lvl, $academic_year, $semester)
    {
        if ($semester == '1st') {
            $semester = 'First Semester';
        } else if ($semester == '2nd') {
            $semester = 'Second Semester';
        }

        $table = [
            'subjectList', 
            'scheduleDays.schedDay',
            'scheduleDays.roomList',
            'instructor',
            'section',
        ];

        return CurriculumSchedSubject::with($table)
            ->withCount('subjectsEnrolled')
            ->leftJoin('sis_main_db.subject_enrolled', 'sis_main_db.subject_enrolled.ss_id', '=', 'curriculum.sched_subj.ss_id')
            ->leftJoin('sis_main_db.stud_sch_info', 'sis_main_db.stud_sch_info.ssi_id', '=', 'sis_main_db.subject_enrolled.ssi_id')
            ->leftJoin('sis_main_db.stud_per_info', 'sis_main_db.stud_per_info.spi_id', '=', 'sis_main_db.stud_sch_info.spi_id')
            ->select('sched_subj.ss_id', 'sched_subj.subj_id', 'sched_subj.employee_id', 'sched_subj.bs_id', DB::raw('
                count(sis_main_db.subject_enrolled.ssi_id) as total, 
                COUNT(CASE WHEN stud_per_info.gender = "male" THEN 1 END) AS male,
                COUNT(CASE WHEN stud_per_info.gender = "female" THEN 1 END) AS female')
            )
            ->whereHas('subjectList', function($query) use ($school_lvl) {     
                $query->where('subj_type', $school_lvl);
            })
            ->where('sem', $semester)
            ->where('sy', $academic_year)
            ->groupBy('sched_subj.ss_id')
            ->get();
    }

    public static function subjectChangeLog($school_lvl, $academic_year, $semester)
    {
        if ($semester == '1st') {
            $semester = 'First Semester';
        } else if ($semester == '2nd') {
            $semester = 'Second Semester';
        }

        return CurriculumSchedSubject::with('subjectList')
            ->leftJoin('sis_main_db.subject_enrolled', 'sis_main_db.subject_enrolled.ss_id', '=', 'curriculum.sched_subj.ss_id')
            ->leftJoin('sis_main_db.stud_subject_logs', 'sis_main_db.stud_subject_logs.se_id', '=', 'sis_main_db.subject_enrolled.se_id')
            ->select('sched_subj.ss_id', 'sched_subj.subj_id', 
                DB::raw('COUNT(CASE WHEN stud_subject_logs.stud_sub_status = "drop" THEN 1 END) AS drop_count, 
                    COUNT(CASE WHEN stud_subject_logs.stud_sub_status = "add" THEN 1 END) AS add_count,
                    COUNT(CASE WHEN stud_subject_logs.stud_sub_status = "change" THEN 1 END) AS change_count
                ')
            )
            ->whereHas('subjectList', function($query) use ($school_lvl) {     
                $query->where('subj_type', $school_lvl);
            })
            ->where('sem', $semester)
            ->where('sy', $academic_year)
            ->groupBy('sched_subj.ss_id')
            ->get();
    }
}

<?php
//FJ Moodle integrator


//enrol_manual_enrol_users function
function enrol_manual_enrol_users_object()
{
	//first, gather the necessary variables
	global $student_id, $course_period;


	//then, convert variables for the Moodle object:
/*
list of (
	object {
		roleid int   //Role to assign to the user
		userid int   //The user that is going to be enrolled
		courseid int   //The course to enrol the user role in
		timestart int  Optionnel //Timestamp when the enrolment start
		timeend int  Optionnel //Timestamp when the enrolment end
		suspend int  Optionnel //set to 1 to suspend the enrolment
	}
)*/

	//student's roleid = student = 5
	$roleid = 5;

	//get the Moodle user ID
	$userid = (int) DBGetOne( "SELECT moodle_id
		FROM moodlexrosario
		WHERE rosario_id='".$student_id."'
		AND \"column\"='student_id'" );

	if (empty($userid))
	{
		return null;
	}

	//gather the Moodle course ID
	$courseid = (int) DBGetOne( "SELECT moodle_id
		FROM moodlexrosario
		WHERE rosario_id='".$course_period['COURSE_PERIOD_ID']."'
		AND \"column\"='course_period_id'" );

	if (empty($courseid))
	{
		return null;
	}

	$enrolments = array(
						array(
							'roleid' => $roleid,
							'userid' => $userid,
							'courseid' => $courseid,
						)
					);

	return array($enrolments);
}


function enrol_manual_enrol_users_response($response)
{
	return null;
}

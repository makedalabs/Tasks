<?php

class Task extends AppModel {
    public $name = 'Task';
	

	public $validate = array(
	'Name' => array(
	    'rule'    => array('minLength', 1),
		'required' => true,
		'message'  => 'Please enter the task'
	),

	'DateDue' => array(
		'rule'       => 'date',
		'required' => true,
		'message'    => 'Enter a valid date'
	)
	);


	// declare find parameters
	public $findMethods = array('unfinished' =>  true, 'finished' =>  true);

	// finsh for unfinished
    protected function _findUnfinished($state, $query, $results = array()) {
        if ($state == 'before') {
            $query['conditions']['Task.Completed'] = 0;
            return $query;
        }
        return $results;
    }

	// find for finished
    protected function _findFinished($state, $query, $results = array()) {
        if ($state == 'before') {
            $query['conditions']['Task.Completed'] = 1;
            return $query;
        }
        return $results;
    }	
	
	

	
	
}

?>
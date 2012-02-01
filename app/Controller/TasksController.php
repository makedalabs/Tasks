<?php
class TasksController extends AppController {
    public $name = 'Tasks';
    public $helpers = array('Html', 'Form');
	public $components = array('Session');

    public function index() {
        $this->set('tasks', $this->CalculateDueDays($this->Task->find('unfinished')));
		$this->render('unfinished');
    }

    public function unfinished() {
        $this->set('tasks', $this->CalculateDueDays($this->Task->find('unfinished')));
    }

    public function finished() {
        $this->set('tasks', $this->Task->find('finished'));
    }

    public function add() {

        if ($this->request->is('post')) {
		
		$this->request->data['Task']['DateCreated']['month'] = date("m");
		$this->request->data['Task']['DateCreated']['day'] = date("d");
		$this->request->data['Task']['DateCreated']['year'] = date("Y");
		$this->request->data['Task']['Completed'] = 0;
		
		
            if ($this->Task->save($this->request->data)) {
                $this->Session->setFlash('Your task has been created.');
                $this->redirect(array('action' => 'unfinished'));
				
            } else {
                $this->Session->setFlash('Unable to create your task.');
            }
        }

    }

	function edit($id = null) {
		$this->Task->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Task->read();

		} else {
			if ($this->Task->save($this->request->data)) {
				$this->Session->setFlash('Your task has been updated.');
			
				//redirect either to finished or unfinished tasks depending on the tasks status
				if ($this->Task->field('Completed') == 1) {
					$this->redirect(array('action' => 'finished'));
				} else {
					$this->redirect(array('action' => 'unfinished'));
				}
			
			} else {
				$this->Session->setFlash('Unable to update your task.');
			}
		}
	}

	function delete($id) {
		if ($this->request->is('get')) {
			// this was from the blog tutorial
			throw new MethodNotAllowedException();
		}
		
		// determines where to redirect user
		$unfinished = 0;
		$this->Task->id = $id;
		$this->request->data = $this->Task->read();
		if ($this->Task->field('Completed') == 1) {
			$unfinished = 0;
		} else {
			$unfinished = 1;
		}

		// deletes task
		if ($this->Task->delete($id)) {
			$this->Session->setFlash('The task with id: ' . $id . ' has been deleted.');
			
			if ($unfinished) {
				$this->redirect(array('action' => 'unfinished'));
			} else {
				$this->redirect(array('action' => 'finished'));
			}
		}
	}

	public function complete($id = null) {
        $this->Task->id = $id;
		$this->Task->read();
		$this->Task->set('Completed', 1);
		$this->Task->save();
        $this->Session->setFlash('Your task has been completed.');
        $this->redirect(array('action' => 'unfinished'));
		
    }

	public function uncomplete($id = null) {
        $this->Task->id = $id;
		$this->Task->read();
		$this->Task->set('Completed', 0);
		$this->Task->save();
        $this->Session->setFlash('Your task has been marked as incomplete.');
        $this->redirect(array('action' => 'finished'));

    }	

	
	// Calculates how many days a task is due in
	private function CalculateDueDays($tasks) {
		foreach ($tasks as &$task) {
			$diff = abs(strtotime(date("Y/m/d")) - strtotime($task['Task']['DateDue']));
			$years = floor($diff / (365*60*60*24));
			$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
			$task['Task']['DueInDays'] = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
			
			// makes it negative if its ovderdue
			if (strtotime(date("Y/m/d")) > strtotime($task['Task']['DateDue'])) {
			 	$task['Task']['DueInDays'] = $task['Task']['DueInDays'] * -1;
			}
		}
		return $tasks;
	}
	
}
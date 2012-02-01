
<center>
<h1>Add Task</h1>
<?php
echo $this->Form->create('Task');
echo $this->Form->input('Name', array('rows' => '3'));
echo "<br />";
echo $this->Form->input('DateDue');
echo "<br />";
echo $this->Form->end('Edit Task');
?>

</center>
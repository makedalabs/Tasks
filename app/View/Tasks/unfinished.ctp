<!--
<pre>
<?php

print_r($tasks);

?>
</pre>
-->

<center>
<h1>Unfinished Tasks</h1>
<table border=1 cellpadding=10>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Date Due</th>
        <th>Date Created</th>
        <th>Due in</th>
        <th>Completed?</th>
		<th>Delete Task</th>
    </tr>

    <!-- Here is where we loop through our $tasks array, printing out post info -->

    <?php foreach ($tasks as $task): ?>
    <tr>
        <td><?php echo $task['Task']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($task['Task']['Name'],
            array('controller' => 'tasks', 'action' => 'edit', $task['Task']['id'])); ?>
        </td>
        <td><?php echo $task['Task']['DateDue']; ?></td>
        <td><?php echo $task['Task']['DateCreated']; ?></td>
        <td>
		
			<?php
			
			if ($task['Task']['DueInDays'] == 0) echo "Task is due today";
			else if ($task['Task']['DueInDays'] < 0) echo "<span class='Overdue'>Task is ".abs($task['Task']['DueInDays'])." days overdue</span>";
			else echo $task['Task']['DueInDays']." days";
			
			?>
		
		</td>
        <td>
            <?php echo $this->Html->link("Complete this Task",
            array('controller' => 'tasks', 'action' => 'complete', $task['Task']['id'])); ?>		
		</td>		
  		<td>
		     <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $task['Task']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
		</td>
    </tr>
    <?php endforeach; ?>

</table>
</center>
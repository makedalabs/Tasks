<center>
<h1>Finished Tasks</h1>
<table border=1 cellpadding=10>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Date Due</th>
        <th>Date Created</th>
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
            <?php echo $this->Html->link("Mark as Uncomplete",
            array('controller' => 'tasks', 'action' => 'uncomplete', $task['Task']['id'])); ?>		
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
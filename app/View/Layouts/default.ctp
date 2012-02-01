<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title_for_layout?></title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- Include external files and scripts here (See HTML helper for more info.) -->
	<?php echo $this->Html->css('style'); ?>
</head>
<body>

<div class="Logo">
    My Tasks
</div>

<div class="Menu">
    <?php echo $this->Html->link("View Unfinished Tasks",
    array('controller' => 'tasks', 'action' => 'unfinished')); ?>
    |
    <?php echo $this->Html->link("View Finished Tasks",
    array('controller' => 'tasks', 'action' => 'finished')); ?>
    |
    <?php echo $this->Html->link("Add New Task",
    array('controller' => 'tasks', 'action' => 'add')); ?>
</div>

<br />

<center>
<strong><?php echo $this->Session->flash();  ?></strong>
</center>

<!-- If you'd like some sort of menu to
show up on all of your views, include it here -->
<div id="header">
    <div id="menu">...</div>
</div>

<!-- Here's where I want my views to be displayed -->
<?php echo $content_for_layout; ?>

<!-- Add a footer to each displayed page -->
<div id="footer">...</div>

</body>
</html>
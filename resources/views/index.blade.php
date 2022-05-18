<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Project dashboard</h1>
    <div>
        <h2>Create new project</h2>
        <form action="POST" action="">
            <label for="project_name">Project name</label>
            <input 
                type="text" 
                name="project_name" 
                id="project_name" 
                placeholder="Enter a unique project name" 
            >

            <label for="number_of_groups">How many groups?</label>
            <input 
                type="number" 
                name="number_of_groups" 
                id="number_of_groups" 
                placeholder="Number of groups" 
            >

            <label for="students_per_group">How many groups?</label>
            <input 
                type="number" 
                name="students_per_group" 
                id="students_per_group" 
                placeholder="Students per group" 
            >

            <input type="submit" value="Create">
            
        </form>
        <h2>Project list</h2>
        <?php if (count($projects) === 0): ?>
            <div>No projects are available</div>
        <?php else: ?>
            <?php foreach($projects as $project): ?>
                <!-- <a href=""><?= $project['project_name'] ?></a> -->
                <a href="">{{ $project['project_name'] }}</a>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</body>
</html>
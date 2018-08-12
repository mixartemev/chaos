<?php
$projects = factory(App\Project::class,15)->create();
$projects->each(function($proj){
    factory(App\Task::class, 3)->create(['project_id'=>$proj->id]);
});
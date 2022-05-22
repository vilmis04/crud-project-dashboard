<?php

$sortedStudents = [];
foreach ($students as $student) {
    $sortedStudents[$student['group']] ?? [];
    $sortedStudents[$student['group']][] = $student;
}

?>

@extends('layout/layout')

@section('content')
    <div>Project: <strong>{{ $project['project_name'] }}</strong></div>
    <div>Number of groups: <strong>{{ $project['number_of_groups'] }}</strong></div>
    <div>Students per group: <strong>{{ $project['students_per_group'] }}</strong></div>

    <div>Students</div>
    <table>
        <thead>
            <tr>
                <td>Student</td>
                <td>Group</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($students as $student): ?>
                <tr>
                    <td> <?= $student['student_name'] ?> </td>
                    <td> <?= $student['group'] ?> </td>
                    <td> <a href="" method='POST'>Delete</a> </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <form method='GET' action='/project/<?= $project['id'] ?>/add-student'>
        @csrf
        <input type="submit" value="Add new student">
    </form>
    <div>Groups</div>
    <?php for($i=1; $i<=intval($project['number_of_groups']); $i++): ?>

        <table>
        <thead>
            <tr>
                <td>Group #<?= $i ?></td>
            </tr>
        </thead>
        <tbody>
            <?php if (!isset($sortedStudents[$i])): ?>
                <?php
                    $openings = intval($project['students_per_group']);
                    while ($openings > 0): ?>
                        <tr>
                            <td>
                            <select>
                                    <option value="">Assign student</option>
                                    <?php
                                        if (!isset($sortedStudents['-'])) {
                                            $openings--;
                                            continue;
                                        }; 
                                        foreach($sortedStudents['-'] as $student): ?>
                                        <option value="<?= $student['id'] ?>"><?= $student['student_name'] ?></option>
                                        <?php endforeach ?>
                                </select>
                            </td>
                        </tr>
                        <?php $openings-- ?>
                    <?php endwhile ?>
            <?php else: ?>
                <?php
                    $counter = 0;
                    foreach($sortedStudents[$i] as $student): ?>
                        <tr>
                            <td> <?= $student['student_name'] ?> </td>
                        </tr>
                    <?php
                        $counter++; 
                        endforeach;
                        $openings = intval($project['students_per_group']) - $counter;
                        while ($openings > 0): ?>
                            <tr>
                                <td>
                                    <select>
                                        <option value="">Assign student</option>
                                        <?php
                                            if (!isset($sortedStudents['-'])) {
                                                $openings--;
                                                continue;
                                            };
                                            foreach($sortedStudents['-'] as $student): ?>
                                                <option value="<?= $student['id'] ?>"><?= $student['student_name'] ?></option>
                                            <?php endforeach ?>
                                    </select>
                                </td>
                            </tr>
                            <?php $openings-- ?>
                        <?php endwhile ?>
            <?php endif ?>
        </tbody>
    </table>

    <?php endfor ?>
@endsection
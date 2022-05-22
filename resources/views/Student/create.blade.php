@extends('layout/layout')
@section('content')
<form action="/project/<?= $project['id'] ?>/add-student" method='POST'>
    @csrf
    <label for="student_name">Student name: </label>
    <input type="text" placeholder="Full name" name="student_name" id="student_name">
    <input type="submit" value="Add student">
</form>
@endsection
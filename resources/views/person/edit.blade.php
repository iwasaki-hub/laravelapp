@extends('layouts.helloapp')

@section('title', "Edit")

@section('menubar')
    @parent
    編集ページ
@endsection

@section('content')
    @if (count($errors) > 0)
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="/person/edit" method="POST">
        <table>
            @csrf
            <input type="hidden" name="id" value="{{$form->id}}">
            <tr>
                <th>Name: </th>
                <td><input type="text" name="name" value="{{$form->name}}"></td>
            </tr>
    
            <tr>
                <th>Mail: </th>
                <td><input type="email" name="mail" value="{{$form->mail}}"></td>
            </tr>
    
            <tr>
                <th>Age: </th>
                <td><input type="number" name="age" value="{{$form->age}}"></td>
            </tr>
    
            <tr>
                <th></th>
                <td><input type="submit" value="Edit"></td>
            </tr>
        </table>
    </form>
@endsection

@section('footer')
    copyright 2022 tuyano.
@endsection
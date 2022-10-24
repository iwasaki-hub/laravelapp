@extends('layouts.helloapp')

@section('title', "Edit")
    
@section('menubar')
    @parent
    更新ページ
@endsection

@section('content')
    <form action="/helloo/edit" method="POST">
        <table>
            @csrf
            <input type="hidden" name="id" value="{{$form->id}}">

            <tr>
                <th>Name: </th>
                <td><input type="text" name="name" placeholder="Name..." value="{{$form->name}}"></td>
            </tr>

            <tr>
                <th>Mail: </th>
                <td><input type="email" name="mail" placeholder="Email..." value="{{$form->mail}}"></td>
            </tr>

            <tr>
                <th>Age: </th>
                <td><input type="number" name="age" placeholder="Age..." value="{{$form->age}}"></td>
            </tr>

            <tr>
                <th></th>
                <td><input type="submit" value="update"></td>
            </tr>

        </table>
    </form>
    
@endsection

@section('footer')
copyright 2022 tuyano.
@endsection
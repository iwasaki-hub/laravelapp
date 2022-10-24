@extends('layouts.helloapp')

@section('title', "Index")

@section('menubar')
    @parent
    投稿ページ
@endsection

@section('content')
    <form action="/board/add" method="POST">
        <table>
            @csrf
            <tr>
                <th>Person ID: </th>
                <td><input type="number" name="person_id"></td>
            </tr>

            <tr>
                <th>Title: </th>
                <td><input type="text" name="title"></td>
            </tr>

            <tr>
                <th>Message: </th>
                <td><input type="text" name="message"></td>
            </tr>

            <tr>
                <th></th>
                <td><input type="submit" value="投稿"></td>
            </tr>
        </table>

    </form>

@endsection

@section('footer')
    copyright 2022 tuyano.
@endsection
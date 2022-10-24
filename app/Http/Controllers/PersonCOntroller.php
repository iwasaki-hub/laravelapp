<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonCOntroller extends Controller
{
    public function index(Request $request){
        $items = Person::all();

        // 投稿をもつ・持たないを分ける
        $hasItems = Person::has('boards')->get();
        $noItems = Person::doesntHave('boards')->get();
        $param = ['hasItems' => $hasItems, 'noItems' => $noItems];
        return view('person.index', $param, ['items' => $items]);
    }

    public function find(Request $request){
        return view('person.find', ['input' =>'']);
    }

    // Create form
    public function add(Request $request){  
        return view('person.add');
    }

    // Create
    public function create(Request $request){
        $this->validate($request, Person::$rules);
        $person = new Person;
        $form = $request->all();
        unset($form['_token']);
        $person->fill($form)->save();
        return redirect('/person');
    }

    // Edti form
    public function edit(Request $request){
        $person = Person::find($request->id);
        return view('person.edit', ['form' => $person]);
    }

    // Update
    public function update(Request $request){
        $this->validate($request, Person::$rules);
        $person = Person::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        $person->fill($form)->save();
        return redirect('/person');

    }

    // Delete form
    public function delete(Request $request){
        $person = Person::find($request->id);
        return view('person.del', ['form' => $person]);
    }

    // Delete
    public function remove(Request $request){
        Person::find($request->id)->delete();
        return redirect('/person');
    }

    // 検索
    public function search(Request $request){

        function noUse(Request $request){
            
            // idによる検索
            $item = Person::find($request->input);
            // nameによる検索
            $item = Person::where("name", $request->input)->first();
            // ローカルスコープを使う
            $item = Person::nameEqual($request->input)->first();
            
        }

        // スコープを組み合わせる
        $min = $request->input * 1;
        $max = $min + 10;
        $item = Person::ageGreaterThan($min)->ageLessThan($max)->first();

        $param = ['input' => $request->input, 'item' => $item];
        return view('person.find', $param);
    }


}

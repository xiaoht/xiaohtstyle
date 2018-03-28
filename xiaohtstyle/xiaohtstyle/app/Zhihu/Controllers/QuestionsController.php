<?php

namespace App\Zhihu\Controllers;

use App\Http\Models\Question;
use App\Http\Models\Topic;
use App\Http\Requests\QuestionRequest;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index' , 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('zhihu.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        $topics = $this->normalizeTopic($request->get('topics'));
        $data = [
            'title'   => $request->get('title'),
            'content' => $request->get('content'),
            'user_id' => Auth::id(),
        ];
        $question = Question::create($data);

        $question->topics()->attach($topics);
        return redirect()->route('zhihu.question.show' , [$question->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::where('id',$id)->with('topics')->first();

        return view('zhihu.questions.show' , compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function normalizeTopic(array $topics)
    {
        return collect($topics)->map(function ($topic){
            if (is_numeric($topic)){
                Topic::find($topic)->increment('questions_count');
                return (int) $topic;
            }

            $newTopic = Topic::create(['name' => $topic , 'questions_count' => 1]);
            return $newTopic->id;
        })->toArray();
    }
}

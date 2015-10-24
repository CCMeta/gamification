<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class QuestsController extends Controller
{

    /**
     * @return Response
     */
    public function getIndex()
    {
        $quests = DB::table('quests')->get();
        $this->export(200, $quests);
    }

    /**
     * @return Response
     */
    public function postIndex()
    {
        $input = Input::all();
        $rules = array();
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $this->export(40003);
            die;
        }

        $isCommit = DB::table('quests')->insertGetId($input);
        if ($isCommit) {
            $this->export(200);
        } else {
            $this->export(50000);
        }
    }

    /**
     * @return Response
     */
    public function getQuest($id)
    {
        $quest = DB::table('quests')->where('id', $id)->first();
        if ($quest) {
            $this->export(200, $quest);
        } else {
            $this->export(40400);
        }
    }

    /**
     * @param  int $id
     * @return Response
     */
    public function putQuest($id)
    {
        $input = Input::all();
        $rules = array();
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $this->export(40003);
            die;
        }

        $isCommit = DB::table('quests')->where('id', $id)->update(array(
            'state' => 4,
        ));
        if ($isCommit) {
            $this->export(200);
        } else {
            $this->export(50000);
        }
    }

    /**
     * @param  int $id
     * @return Response
     */
    public function deleteQuest($id)
    {
        $isCommit = DB::table('quests')->where('id', $id)->update(array(
            'state' => 4,
        ));
        if ($isCommit) {
            $this->export(200);
        } else {
            $this->export(50000);
        }
    }

}
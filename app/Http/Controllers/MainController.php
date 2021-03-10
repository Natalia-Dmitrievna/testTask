<?php

namespace App\Http\Controllers;

use App\Employeer;
use App\Department;
use Illuminate\Http\Request;
use View;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        //$employeers = Employeer::All();
       $employeers = Employeer::leftJoin('department', 'department.dep_id', '=', 'employeer.department_id')->orderBy('id')->paginate(200);
       //var_dump($employeers);

       return view('employeers/main_page', compact('employeers'));
   }


   public function searchPage(Request $request){

    $q = $request->input('q');
    $max_page = 200;
        //Полнотекстовый поиск с пагинацией
    $results = $this->search($q, $max_page);
    return view('employeers/search', [
        'employeers' => $results,
    ])->render();
}

public function search($q, $count){
    $query = mb_strtolower($q, 'UTF-8');
        $arr = explode(" ", $query); 
        $query = [];
        foreach ($arr as $word)
        {
            $len = mb_strlen($word, 'UTF-8');
            switch (true)
            {
                case ($len <= 3):
                {
                    $query[] = $word . "*";
                    break;
                }
                case ($len > 3 && $len <= 6):
                {
                    $query[] = mb_substr($word, 0, -1, 'UTF-8') . "*";
                    break;
                }
                case ($len > 6 && $len <= 9):
                {
                    $query[] = mb_substr($word, 0, -2, 'UTF-8') . "*";
                    break;
                }
                case ($len > 9):
                {
                    $query[] = mb_substr($word, 0, -3, 'UTF-8') . "*";
                    break;
                }
                default:
                {
                    break;
                }
            }
        }
        $query = array_unique($query, SORT_STRING);
        $qQeury = implode(" ", $query); //объединяет массив в строку
        // Таблица для поиска
        $results = Employeer::whereRaw(
            "MATCH(fname, sname, pname) AGAINST(? IN BOOLEAN MODE)", 
            $qQeury)->paginate($count) ;
        return $results;
    }

    public function add()
    {

         $departments  = Department::All();
        return view('employeers/add_empl', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $this->validate($request, [
            'fname'  => 'required|max:255',
            'sname' => 'max:255',
            'pname'  => 'max:255',
        ]);
        
        $employeer       = new Employeer();
        $employeer->fname  = $request->fname;
        $employeer->sname  = $request->sname;
        $employeer->pname  = $request->pname;
        $employeer->department_id  = $request->department_id;
        $employeer->save();
        return redirect('/');

    }

     public function edit($id)
    {
        $employeer   = Employeer::FindOrFail($id);
        $departments  = Department::All();

        return view('employeers/edit', compact('employeer', 'departments'));
    }

     public function update(Request $request, $id)
    {

        $employeer    =   Employeer::Find($id);
        $employeer->fname  = $request->fname;
        $employeer->sname  = $request->sname;
        $employeer->pname  = $request->pname;
        $employeer->department_id  = $request->department_id;
        $employeer->save();
        return redirect('/');
        
    }

    public function delete($id){

        Employeer::find($id)->delete();
         return redirect('/');
    }



}

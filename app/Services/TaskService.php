<?php
namespace App\Services;
use App\Models\Task;


class TaskService {


    public function pageQuery($request) {
        $pageNum = $request->input('pageNum', 1); // Default page number is 1 if not provided
        $pageSize = $request->input('pageSize', 10); // Default page size is 10 if not provided

        // Retrieve paginated tasks from the database based on pageNum and pageSize
        $tasks = Task::paginate($pageSize, ['*'], 'page', $pageNum);

        return response()->json($tasks);
    }
    

    public function raw_query() {
        $found = DB::select('select * from tasks where id = ?',  [1]);

        return $found;
    }

    public function raw_insert() {
        $res = DB::insert('insert into tasks (title, content) values (?, ?)', ['fie', 'Marc']);
    }

    public function raw_update() {
        $affected = DB::update(
            'update tasks set title = "first one" where id = ?',
            [1]
        );
    }

    public function raw_delete() {
        $deleted = DB::delete('delete from tasks where title = ?', ['gdf']);
    }


    public function raw_transaction() {
        $res = DB::transaction(function() {
            DB::update('update tasks set title = "first" where id = ?', [1]);
            DB::delete('delete from tasks where title = ?', ['jgefr']);
        });
    }


    public function query_builder() {
        $users = DB::table('users')->get();
        $user = DB::table('users')->select('name', 'email as user_email')->where('name', 'test')->first();
    }


}


?>
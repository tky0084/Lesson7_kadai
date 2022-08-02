<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRegisterPostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CompletedTask as CompletedTaskModel;


class CompletedTaskController extends Controller
{
    public function list()
    {
        // 1Page辺りの表示アイテム数を設定
        $per_page = 2;        
        
        $list = CompletedTaskModel::where('user_id', Auth::id())
                         ->orderBy('priority', 'DESC')
                         ->orderBy('period')
                         ->orderBy('created_at')
                         ->paginate($per_page);
        return view('task.completed_list', ['list' => $list]);
    }
}
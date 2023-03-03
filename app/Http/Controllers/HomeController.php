<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        
    }
    
    // ログイン画面
    public function login(Request $request)
    {
        if($request->query('id')) {
            // ログアウト処理
            \DB::table('login_time_table')->where('user_table_id', $request->query('id'))->delete();
        }
        return view('login')->with(['validation'=>"", 'b_id'=>"", 'b_pass'=>""]);
    }

    // ホーム画面
    public function home(Request $request)
    {
        $id = "";
        $key = "";
        // 新規登録処理
        if ($request->type == "new") {
            // バリデーション
            $rulus = [
                'id' => 'required',
                'password' => 'required',
                'mail' => 'required',
            ];
            
            $message = [
                'id.required' => '名前を入力してください',
                'password.required' => 'パスワードを入力してください',
                'mail.required' => 'メールアドレスを入力してください'
            ];
            
            $validator = Validator::make($request->all(), $rulus, $message);
        
            if ($validator->fails()) {
                return redirect('/public/new')->withErrors($validator)->withInput();
            }

            $created_date = \DB::table('user_table')
                            ->where('name', $request->id)
                            ->where('password', $request->password)
                            ->where('email', $request->mail)
                            ->get();

            if (count($created_date) == 0) {
               // 問題なければ保存
                $insert_data = \DB::table('user_table')->insert([
                    'name' => $request->id,
                    'password' => $request->password,
                    'email' => $request->mail,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // 自動ログアウト処理用のデータを保存
            $user_data = \DB::table('user_table')->where('name', $request->id)->where('password', $request->password)->get();
            $token_data = \DB::table('login_time_table')->where('user_table_id', $user_data[0]->id)->get();
            if (count($token_data) == 0) {
                \DB::table('login_time_table')->insert([
                    'user_table_id' => $user_data[0]->id,
                    'token' => now()->format("YmdHis")
                ]);
            } else {
                \DB::table('login_time_table')->where('user_table_id', $user_data[0]->id)->update(['token' => now()->format("YmdHis")]);
            }

            $id = $user_data[0]->id;
        
        // ログイン後
        } else if ($request->type == "login") {
            // データの有無確認
            $data = \DB::table('user_table')->where('name', $request->id)->where('password', $request->pass)->get();
            if (count($data) == 0) {
                return view('login', ['validation'=>'1', 'b_id'=>$request->id, 'b_pass'=>$request->pass]);
            } else {
                // ログイン後自動ログアウト処理用のデータを保存
                $user_data = $data;
                $token_data = \DB::table('login_time_table')->where('user_table_id', $user_data[0]->id)->get();
                if (count($token_data) == 0) {

                    \DB::table('login_time_table')->insert([
                        'user_table_id' => $user_data[0]->id,
                        'token' => now()->format("YmdHis")
                    ]);
                } else {
                    \DB::table('login_time_table')->where('user_table_id', $user_data[0]->id)->update(['token' => now()->format("YmdHis")]);
                }
            }

            $id = $data[0]->id;
            $key = $data[0]->name;

        } else if ($request->type == "kadai") {
            if ($request->id) {
                $token_data = \DB::table('login_time_table')->where('user_table_id', $request->id)->get();
                if (count($token_data) == 0) {
                    return redirect('/public');
                } else {
                    if (now()->format(now()->format("YmdHis")) - $token_data[0]->token > 7200) {
                        \DB::table('login_time_table')->where('user_table_id', $request->id)->delete();
                        return redirect('/public');
                    }
                }
            } else {
                return redirect('/public');
            }
            // バリデーション
            $rulus = [
                'kenmei' => 'required',
                'tantou' => 'required',
                'naiyou' => 'required',
            ];
            
            $message = [
                'kenmei.required' => '件名を入力してください',
                'tantou.required' => '担当を入力してください',
                'naiyou.required' => '内容を入力してください',
            ];
            
            $validator = Validator::make($request->all(), $rulus, $message);
        
            if ($validator->fails()) {
                return redirect('/public/home/new?id=1')->withErrors($validator)->withInput();
            }
            
            $created_date = \DB::table('task_table')
                            ->where('user_table_id', $request->id)
                            ->where('title', $request->kenmei)
                            ->where('naiyou', $request->naiyou)
                            ->where('tantou', $request->tantou)
                            ->where('zyoutai', $request->zyoutai)
                            ->where('kigen_y', $request->year)
                            ->where('kigen_m', $request->month)
                            ->where('kigen_d', $request->day)
                            ->get();

            if (count($created_date) == 0) {
                // 問題なければ保存
                $insert_data = \DB::table('task_table')->insert([
                    'user_table_id' => $request->id,
                    'title' => $request->kenmei,
                    'naiyou' => $request->naiyou,
                    'tantou' => $request->tantou,
                    'zyoutai' => $request->zyoutai,
                    'kigen_y' => $request->year,
                    'kigen_m' => $request->month,
                    'kigen_d' => $request->day,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
                
            $id = $request->id;
            $data = \DB::table('user_table')->where('id', $request->id)->get();
            $key = $data[0]->name;
        
        } else if ($request->type == "kadai_edit") {
            if ($request->id) {
                $token_data = \DB::table('login_time_table')->where('user_table_id', $request->id)->get();
                if (count($token_data) == 0) {
                    return redirect('/public');
                } else {
                    if (now()->format(now()->format("YmdHis")) - $token_data[0]->token > 7200) {
                        \DB::table('login_time_table')->where('user_table_id', $request->id)->delete();
                        return redirect('/public');
                    }
                }
            } else {
                return redirect('/public');
            }
            // バリデーション
            $rulus = [
                'kenmei' => 'required',
                'tantou' => 'required',
                'naiyou' => 'required',
            ];
            
            $message = [
                'kenmei.required' => '件名を入力してください',
                'tantou.required' => '担当を入力してください',
                'naiyou.required' => '内容を入力してください',
            ];
            
            $validator = Validator::make($request->all(), $rulus, $message);
        
            if ($validator->fails()) {
                $url = '/public/home/edit?id=1&kadai_id='.$request->data_id;
                return redirect($url)->withErrors($validator)->withInput();
            }
            
            // 問題なければ保存
            $test = \DB::table('task_table')
            ->where('user_table_id', $request->id)
            ->where('id', $request->data_id)
            ->update([
                'title' => $request->kenmei,
                'naiyou' => $request->naiyou,
                'tantou' => $request->tantou,
                'zyoutai' => $request->zyoutai,
                'kigen_y' => $request->year,
                'kigen_m' => $request->month,
                'kigen_d' => $request->day,
                'updated_at' => now()
            ]);

            $id = $request->id;
            $data = \DB::table('user_table')->where('id', $request->id)->get();
            $key = $data[0]->name;
            
        }
        
        // メニュー用、パラメーターにidが入っている場合は上書きする
        if ($request->query('id')) {
            $id = $request->query('id');
        }

        if ($id == "") {
            return redirect("/public");
        }

        if ($id) {
            $token_data = \DB::table('login_time_table')->where('user_table_id', $id)->get();
            if (count($token_data) == 0) {
                return redirect('/public');
            } else {
                if (now()->format(now()->format("YmdHis")) - $token_data[0]->token > 7200) {
                    \DB::table('login_time_table')->where('user_table_id', $id)->delete();
                    return redirect('/public');
                }
            }
        } else {
            return redirect('/public');
        }

        if ($request->query('search_flg')) {
            $kadai_data = \DB::table('task_table')->where('user_table_id', $id)->where('zyoutai', $request->query('search_flg'))->get();
        } else {
            $kadai_data = \DB::table('task_table')->where('user_table_id', $id)->get();
        }
        $data = \DB::table('user_table')->where('id', $id)->get();
        $key = $data[0]->name;
        return view('home', ['user_id'=>$id, 'kadai_data'=>$kadai_data, 'num'=>count($kadai_data), 'key'=>$key, 'search_flg'=>$request->query('search_flg')]);
    }

    public function new()
    {
        return view('new');
    }

    public function home_new(Request $request)
    {
        if($request->query('id')) {
            if ($request->query('id')) {
                $token_data = \DB::table('login_time_table')->where('user_table_id', $request->query('id'))->get();
                if (count($token_data) == 0) {
                    return redirect('/public');
                } else {
                    if (now()->format(now()->format("YmdHis")) - $token_data[0]->token > 7200) {
                        \DB::table('login_time_table')->where('user_table_id', $request->query('id'))->delete();
                        return redirect('/public');
                    }
                }
            } else {
                return redirect('/public');
            }
            return view('kadai_new', ['user_id'=>$request->query('id')]);
        } else {
            return redirect("/public");
        }
    }

    public function home_edit(Request $request)
    {
        if($request->query('id')) {
            if ($request->query('id')) {
                $token_data = \DB::table('login_time_table')->where('user_table_id', $request->query('id'))->get();
                if (count($token_data) == 0) {
                    return redirect('/public');
                } else {
                    if (now()->format(now()->format("YmdHis")) - $token_data[0]->token > 7200) {
                        \DB::table('login_time_table')->where('user_table_id', $request->query('id'))->delete();
                        return redirect('/public');
                    }
                }
            } else {
                return redirect('/public');
            }
            $kadai_data = \DB::table('task_table')->where('user_table_id', $request->query('id'))->where('id', $request->query('kadai_id'))->get();
            return view('edit', ['user_id'=>$request->query('id'), 'kadai_data'=>$kadai_data[0]]);
        } else {
            return redirect("/public");
        }
    }
}

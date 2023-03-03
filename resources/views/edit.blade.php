<!DOCTYPE html>
<html lang="ja"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/main.js"></script>
  </head>

  <body>
    <header>
      <table>
        <tr>
          <td class="left">
            <h1>タスク管理</h1>
          </td>
          <td class="right">
            <img id="menu" src="../assets/image/menu.png" onclick="click_menu('open')">
            <img id="close" src="../assets/image/close.png" onclick="click_menu('close')">
          </td>
        </tr>
      </table>
      <div style="cursor: pointer;" class="menu_back" id="menu_back" onclick="click_menu('close')"></div>
      <div class="menu_main" id="menu_main">
        <h3>MENU</h3>
        <ul>
          <li style="cursor: pointer;" onclick="home()">ホーム</li>
          <li style="cursor: pointer;" onclick="kadai_new()">課題の追加</li>
          <li style="cursor: pointer;" onclick="logout()">ログアウト</li>
        </ul>
      </div>
    </header>

    <main class="login">
        <form action="{{route('home')}}" method="POST">    
            @csrf    
            @if($errors->has('kenmei'))  
              <p style="color: red; margin-block-start: 0; margin-block-end: 0;">{{$errors->first('kenmei')}}</p>
            @endif
            @if($errors->has('tantou'))  
              <p style="color: red; margin-block-start: 0; margin-block-end: 0;">{{$errors->first('tantou')}}</p>
            @endif
            @if($errors->has('naiyou'))  
              <p style="color: red; margin-block-start: 0; margin-block-end: 0;">{{$errors->first('naiyou')}}</p>
            @endif
            <section>
                <h3>件名</h3>
                <input class="input_font" name="kenmei" type="text" value="{{$kadai_data->title}}">
                <h3>状態</h3>
                <select class="input_font" name="zyoutai">
                  <option value="1"
                  @if($kadai_data->zyoutai=='1')
                    selected
                    @endif
                    >未対応
                  </option>
                  <option value="2"
                  @if($kadai_data->zyoutai=='2')
                    selected
                    @endif
                    >処理中
                  </option>
                  <option value="3"
                  @if($kadai_data->zyoutai=='3')
                    selected
                    @endif
                    >完了
                  </option>
                </select>
                <h3>担当者</h3>
                <input class="input_font" name="tantou" type="text" value="{{$kadai_data->tantou}}">
                <h3>期限日</h3>
                <select class="input_font" name="year">
                @for ($i = 2023; $i < 2026; $i++)
                  <option value="{{$i}}" 
                    @if($kadai_data->kigen_y==$i)
                    selected
                    @endif
                    >{{$i}}
                  </option>
                @endfor  
                </select>
                年
                <select class="input_font" name="month">
                @for ($i = 1; $i < 13; $i++)
                  <option value="{{$i}}" 
                    @if($kadai_data->kigen_m==$i)
                    selected
                    @endif
                    >{{$i}}
                  </option>
                @endfor  
                </select>
                月
                <select class="input_font" name="day">
                @for ($i = 1; $i < 31; $i++)
                  <option value="{{$i}}" 
                    @if($kadai_data->kigen_d==$i)
                    selected
                    @endif
                    >{{$i}}
                  </option>
                @endfor  
                </select>
                日
                <h3>内容</h3>
                <textarea class="input_font" name="naiyou">{{$kadai_data->naiyou}}</textarea>
            </section>
            <section>
                <ul>
                    <input type="hidden" name="type" value="kadai_edit">
                    <input type="hidden" name="data_id" value="{{$kadai_data->id}}">
                    <input type="hidden" id="user_id" name="id" value="{{$user_id}}">    
                    <li><input class="submit_button" type="submit" value="登録"></li>
                </ul>
            </section>
        </form>
    </main>
    <footer>
    </footer>
  </body>
</html>
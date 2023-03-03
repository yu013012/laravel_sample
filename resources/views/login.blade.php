<!DOCTYPE html>
<html lang="ja"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="./assets/js/main.js"></script>
  </head>

  <body>
    <header>
      <table>
        <tr>
          <td class="left">
            <h1>タスク管理</h1>
          </td>
          <td class="right">
            <img id="menu" src="./assets/image/menu.png" onclick="click_menu('open')">
            <img id="close" src="./assets/image/close.png" onclick="click_menu('close')">
          </td>
        </tr>
      </table>
      <div style="cursor: pointer;" class="menu_back" id="menu_back" onclick="click_menu('close')"></div>
      <div class="menu_main" id="menu_main">
        <h3>MENU</h3>
        <ul>
          <li>ログイン</li>
        </ul>
      </div>
    </header>

    <main class="login">
        <form action="{{route('home')}}" method="POST">  
            @csrf    
            <section>
                @if ($validation == '1')
                    <p style="color: red; margin-block-start: 0; margin-block-end: 0;">idまたはパスワードが正しくありません</p>   
                @endif    
                 
                <h3>ID</h3>
                <input name="id" class="input_font" type="text" value="{{$b_id}}">
                
                <h3>パスワード</h3>
                <input name="pass" class="input_font" type="text" value="{{$b_pass}}">
            </section>
            <section>
                <ul>
                    <input type="hidden" name="type" value="login">  
                    <li><input class="submit_button" type="submit" value="ログイン"></li>
                    <li><a href="/new">新規登録</a></li>
                </ul>
            </section>
        </form>
    </main>
    <footer>
    </footer>
  </body>
</html>
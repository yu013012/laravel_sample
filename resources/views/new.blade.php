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
          <li>新規登録</li>
        </ul>
      </div>
    </header>

    <main class="login">
      <form action="{{route('home')}}" method="POST">  
        @csrf
        @if($errors->has('id'))  
          <p style="color: red; margin-block-start: 0; margin-block-end: 0;">{{$errors->first('id')}}</p>
        @endif
        @if($errors->has('password'))  
          <p style="color: red; margin-block-start: 0; margin-block-end: 0;">{{$errors->first('password')}}</p>
        @endif
        @if($errors->has('mail'))  
          <p style="color: red; margin-block-start: 0; margin-block-end: 0;">{{$errors->first('mail')}}</p>
        @endif
        <section>
          <h3>ID</h3>
          <input name="id" class="input_font" type="text">
          <h3>パスワード</h3>
          <input name="password" class="input_font" type="text">
          <h3>メールアドレス</h3>
          <input name="mail" class="input_font" type="text">
        </section>
        <section>
          <ul>
            <input type="hidden" name="type" value="new">  
            <li><input class="submit_button" type="submit" value="新規登録"></li>
          </ul>
        </section>
      </form>  
    </main>
    <footer>
    </footer>
  </body>
</html>
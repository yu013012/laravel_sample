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
                <input class="input_font" name="kenmei" type="text">
                <h3>状態</h3>
                <select class="input_font" name="zyoutai">
                  <option value="1">未対応</option>
                  <option value="2">処理中</option>
                  <option value="3">完了</option>
                </select>
                <h3>担当者</h3>
                <input class="input_font" name="tantou" type="text" value="">
                <h3>期限日</h3>
                <select class="input_font" name="year">
                  <option value="2023">2023</option>
                  <option value="2024">2024</option>
                  <option value="2024">2024</option>
                </select>
                年
                <select class="input_font" name="month">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                </select>
                月
                <select class="input_font" name="day">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                  <option value="15">15</option>
                  <option value="16">16</option>
                  <option value="17">17</option>
                  <option value="18">18</option>
                  <option value="19">19</option>
                  <option value="20">20</option>
                  <option value="21">21</option>
                  <option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                </select>
                日
                <h3>内容</h3>
                <textarea class="input_font" name="naiyou"></textarea>
            </section>
            <section>
                <ul>
                    <input type="hidden" name="type" value="kadai">
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
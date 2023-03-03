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
            <h1>タスク管�?</h1>
          </td>
          <td class="right">
            <img id="menu" src="./assets/image/menu.png" onclick="click_menu('open')">
            <img id="close" src="./assets/image/close.png" onclick="click_menu('close')">
          </td>
        </tr>
      </table>
      <input type="hidden" id="user_id" value="{{$user_id}}">
      <div class="menu_back" id="menu_back" onclick="click_menu('close')"></div>
      <div class="menu_main" id="menu_main">
        <h3>MENU</h3>
        <ul>
          <li style="cursor: pointer;">ホ�?��?</li>
          <li style="cursor: pointer;" onclick="kadai_new()">課題�?�追�?</li>
          <li style="cursor: pointer;" onclick="logout()">ログアウ�?</li>
        </ul>
      </div>
    </header>

    <main>
      <section class="section1">
        <ul>
          <li onclick="search('', '{{$user_id}}')" 
          @if ($search_flg == '')
          style="background-color: #e1e1e1;"
          @endif
          >全て</li>
          <li onclick="search('1', '{{$user_id}}')" 
          @if ($search_flg == 1)
          style="background-color: #e1e1e1;"
          @endif
          >未対�?</li>
          <li onclick="search('2', '{{$user_id}}')" 
          @if ($search_flg == 2)
          style="background-color: #e1e1e1;"
          @endif
          >処�?中</li>
          <li onclick="search('3', '{{$user_id}}')" 
          @if ($search_flg == 3)
          style="background-color: #e1e1e1;"
          @endif
          >完�?</li>
        </ul>
      </section>
      <section class="section2">
        <p>{{$num}}件中{{$num}}件表示</p>
        <div class="grid-container1">
          <div class="grid-container2">
            <div class="title">キー</div>
            <div class="title">�?容</div>
          </div>
          <div class="grid-container3">
            <div class="title">�?当�?</div>
            <div class="title">状�?</div>
            <div class="title">期限日</div>
          </div>
        </div>
        <div class="container">
        <?php $i=0; ?>
        @foreach ($kadai_data as $kadai)
        <?php $i++; ?>  
        <div class="grid-container1">
            <div class="grid-container2">
                <div><a href="/public/home/edit?id={{$user_id}}&kadai_id={{$kadai->id}}">{{$key}}_{{$i}}</a></div>
                <div>{{$kadai->title}}</div>
            </div>
            <div class="grid-container3">
              <div>{{$kadai->tantou}}</div>
              @if ($kadai->zyoutai == '1')
                <div>未対�?</div>
              @elseif ($kadai->zyoutai == '2')
                <div>処�?中</div>
              @elseif ($kadai->zyoutai == '3')
                <div>完�?</div>
              @endif
              <div>{{$kadai->kigen_y}}/{{$kadai->kigen_m}}/{{$kadai->kigen_d}}</div>
            </div>
          </div>  
        @endforeach
        </div>
        <p>{{$num}}件中{{$num}}件表示</p>
      </section>
    </main>
    <footer>
    </footer>
  </body>
</html>
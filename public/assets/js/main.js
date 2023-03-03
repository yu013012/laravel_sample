function click_menu(flg) {
   if (flg == "open") {
    document.getElementById("menu").style.display = "none";
    document.getElementById("close").style.display = "initial";
    document.getElementById("menu_back").style.display = "block";
    document.getElementById("menu_main").style.display = "block";
   } else {
    document.getElementById("close").style.display = "none";
    document.getElementById("menu").style.display = "initial";
    document.getElementById("menu_back").style.display = "none";
    document.getElementById("menu_main").style.display = "none";
   }
}

function kadai_new() {
   if (document.getElementById("user_id").value) {
      location.href="http://tasukukanri/home/new?id="+document.getElementById("user_id").value;
   } else {
      location.href="http://tasukukanri";
   }
}

function logout() {
   if (document.getElementById("user_id").value) {
      location.href="http://tasukukanri?id="+document.getElementById("user_id").value;
   } else {
      location.href="http://tasukukanri";
   }
}

function home() {
   if (document.getElementById("user_id").value) {
      location.href="http://tasukukanri/home?id="+document.getElementById("user_id").value;
   } else {
      location.href="http://tasukukanri/home";
   }
}

function search(flg, id) {
   location.href="http://tasukukanri/home?id="+id+"&search_flg="+flg;
}
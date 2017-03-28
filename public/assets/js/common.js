/**
 * ajax通信
 **/
var execAjax = function(url, formObj, funcCallack, funcFaiiCallack) {
    var self = this;

    console.log(url);
    console.log(formObj);
    formObj['_token'] = $('meta[name="csrf-token"]').attr('content');

    var process = $.ajax({
      url : url,
      data : JSON.stringify(formObj),
      dataType : "json",
      type : "POST",
      timeout : 10000,
      cache : false,
      contentType : 'application/json; charset=utf-8',
      mimeType: 'application/json',
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    // 通信完了コールバック
    process.done(function(data) {
      funcCallack(data);
    });

    // fail
    process.fail(function(data) {
      console.log("failed");
      if(funcFaiiCallack) {
        funcFaiiCallack(data);
      }
    });
    // 通信後(finally)コールバック
    process.always(function(data) {
        removeLoadingGif();
    });
};

var getFailCallback = function(){
    var callback = function(){
        alert("Failed");
    };
    return callback;
};

/**
 * SHA256変換
 */
var getSha256 = function(text) {
    var ret = '';
    if (text !== '' && text !== undefined) {
        var shaObj = new jsSHA("SHA-256", 'TEXT');
        shaObj.update(text);
        ret = shaObj.getHash("B64");
    }
    return ret;
}

/**
  * XSS対策　データのエスケープ処理
  **/

 function escapeHTML(str) {
    str = str.replace(/&/g, '&amp;');
    str = str.replace(/</g, '&lt;');
    str = str.replace(/>/g, '&gt;');
    str = str.replace(/"/g, '&quot;');
    str = str.replace(/'/g, "'");
    return str;
 }

 /**
 * 与えられたエレメントの隣にローディング画像を表示させる
 * 同時に通信が完了するまでボタンを一時的に使用不可とする
 */
function createLoadingGif(e)
{
    $("button").not("[disabled]").each(function(idx, target){
        $(target).addClass("limited-disabled disabled").prop("disabled", true);
    });
    var image = $("<img>").attr("src", LOADING_IMAGE).attr('id', "loading-img")
        .css("position", "absolute").css("z-index", 100);
    $(e).after(image);
}

/**
 * ローディング画像を削除する
 * 同時に一時的に使用不可となっていたボタンを有効に変更する
 */
function removeLoadingGif()
{
    $("#loading-img, .loading-img").remove();
    $("button.limited-disabled").each(function(idx, target){
        $(target).prop("disabled", false).removeClass("limited-disabled disabled");
    });
}

/**
 * クッキーをセットする
 * @param String name  クッキー名
 * @param Mixed value セットする値（配列可）
 */
var setCookie = function(name, value, limit) {
    var option = {};
    option['path'] = '/';
    option['domain'] = location.hostname;
    if(limit !== undefined) option['expires'] = limit
    Cookies.set(name, value, option);
    return true;
}

/**
 * セットしたクッキーを削除する
 * @param  String name 削除するクッキー名
 */
var removeCookie = function(name) {
    Cookies.remove(name, {'path': '/', 'domain': location.hostname});
    return true;
}

/**
 * クッキーを取得する
 * @param  String name 取得するクッキー名
 */
var getCookie = function(name) {
    var result = '';
    if(name === undefined) {
        result = Cookies.get();
    } else {
        result = Cookies.get(name);
    }
    return result;
}

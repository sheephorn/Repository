<script>
var getLoginCallback = function(ele) {
    var callback = function(data) {
        console.log(data)
        if (data.code !== undefined) {
            if (data.code === '0') {
                // 正常時

            } else if (data.code === '1') {
                // error時
            }　else {
                // 想定外コード時
            }
        } else {
            // data = undefined
        }
    }
    return callback;
};

var getRegistCallback = function(ele) {
    var callback = function(data) {
        console.log(data)
        if (data.code !== undefined) {
            if (data.code === '0') {
                // 正常時

            } else if (data.code === '1') {
                // error時
            }　else {
                // 想定外コード時
            }
        } else {
            // data = undefined
        }
    }
    return callback;
};

var login = function(event, ele)
{
    createLoadingGif($(event.target).next());
    var formObj = {
        'email' : ele.email,
        'password' : ele.sha256
    }
    var callback = getLoginCallback();
    var failcallback = getFailCallback();
    console.log(formObj);
    execAjax(ele.url.login, formObj, callback, failcallback);
}

var regist = function(event, ele)
{
    createLoadingGif($(event.target).next());
    var formObj = {
        'email' : ele.email,
        'password' : ele.sha256
    }
    var callback = getRegistCallback();
    var failcallback = getFailCallback();
    execAjax(ele.url.regist, formObj, callback, failcallback);
}




var app = new Vue({
    el : '#login-form',
    data : {
        message : 'Login',
		email : '',
		password : '',
        url : {
            login : '{{ route($func::LOGIN) }}',
            regist : '{{ route($func::MEMBER_REGIST) }}'
        }
    },
	created : function() {
        //
	},
	computed : {
		sha256 : function() {
			return getSha256(this.password);
		}
	},
	methods : {
		login : function(event) {
            login(event, this)
        },
        regist : function(event) {
            regist(event, this)
        }
	}
});

</script>

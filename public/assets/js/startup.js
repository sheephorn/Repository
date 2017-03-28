// オリジナルデータを格納
var dataholder;
Vue.component('data-holder', {
    template : '<div></div>',
    props : ['sub'],
    created : function() {
        dataholder = this.sub
    },
    data : function() {
        return {
            'conetnts' : ''
        };
    },
});
var data_holder = new Vue({
    el : '#data-holder',
    props : ['sub'],
    data : {
        'contents' : ''
    }
});
// ページの読み込みが終わったらローディング背景を消す
var loading = new Vue({
    el : '#loading-bg',
    data : {
        'ret' : false
    }
});

/**
 * Created by zhangliqin on 2015/11/18.
 */
/**
 +-------------------------------------------------------------------
 * jQuery hDialog - 寮瑰嚭灞傝〃鍗曟彃浠� - http://www.jq22.com/
 +-------------------------------------------------------------------
 * @version 1.0.0
 * @since 2014.10.27
 * @author haibao <hhb219@163.com> <http://www.jq22.com/>
 +-------------------------------------------------------------------
 */
;(function($, window, document, undefined) {
    var _doc = $(document), $body = $('body');
    methods = {
        init: function (options) {
            return this.each(function() {
                var $this = $(this), opt = $this.data('hDialog');
                if(typeof(opt) == 'undefined') {
                    var defaults = {
                        title: '',              //寮规鏍囬
                        box: '#HBox',           //寮规榛樿閫夋嫨鍣�
                        boxBg: '#fff',          //寮规榛樿鑳屾櫙棰滆壊
                        modalBg: 'rgba(0,0,0,0.5)', //閬僵榛樿鑳屾櫙棰滆壊
                        closeBg: '#ccc',        //寮规鍏抽棴鎸夐挳榛樿鑳屾櫙棰滆壊
                        width: 400,             //寮规榛樿瀹藉害
                        height: 250,            //寮规榛樿楂樺害
                        positions: 'center',    //寮规浣嶇疆(榛樿center锛氬眳涓紝top锛氶《閮ㄥ眳涓紝left锛氶《閮ㄥ眳宸�)
                        triggerEvent: 'click',  //瑙﹀彂鏂瑰紡(榛樿click锛氱偣鍑伙紝mouseenter锛氭偓娴�)
                        effect: 'hide',         //寮规鍏抽棴鏁堟灉(榛樿hide锛屾贰鍑哄叧闂細fadeOut)
                        resetForm: true,        //鏄惁娓呯┖琛ㄥ崟(榛樿true锛氭竻绌猴紝false锛氫笉娓呯┖)
                        modalHide: true,        //鏄惁鐐瑰嚮閬僵鑳屾櫙鍏抽棴寮规(榛樿true锛氬叧闂紝false锛氫笉鍙叧闂�)
                        closeHide: true,        //鏄惁闅愯棌鍏抽棴鎸夐挳(榛樿true锛氫笉闅愯棌锛宖alse锛氶殣钘�)
                        escHide: true,          //鏄惁鏀寔ESC鍏抽棴寮规(榛樿true锛氬叧闂紝false锛氫笉鍙叧闂�)
                        beforeShow: function(){}, //鏄剧ず鍓嶇殑鍥炶皟鏂规硶
                        afterHide: function(){}   //闅愯棌鍚庣殑鍥炶皟鏂规硶
                    };
                    opt = $.extend({}, defaults, options);
                    $this.data('hDialog', opt);
                }
                opt = $.extend({}, opt, options);
                $(opt.box).hide(); //闅愯棌瀹瑰櫒
                $this.on(opt.triggerEvent,function() { //鍏冪礌鐐瑰嚮浜嬩欢
                    //閲嶇疆琛ㄥ崟
                    if(opt.resetForm) {
                        var $obj = $(opt.box);
                        $obj.find('input[type=text],textarea').val('');
                        $obj.find('select option').removeAttr('selected');
                        $obj.find('input[type=radio],input[type=checkbox]').removeAttr('checked');
                    }

                    //鏀寔ESC鍏抽棴
                    if(opt.escHide) {
                        $(document).keyup(function(event){
                            switch(event.keyCode) {
                                case 27:
                                    methods.close(opt);
                                    break;
                            }
                        });
                    }

                    methods.fire.call(this, opt.beforeShow); //璋冪敤鏄剧ず涔嬪墠鍥炶皟鍑芥暟
                    methods.add(opt,$this); //鏄剧ず寮规

                    //鐐瑰嚮鍏抽棴浜嬩欢
                    var $close = $('#HCloseBtn');
                    if(opt.modalHide){ $close = $('#HOverlay,#HCloseBtn'); }
                    $close.on('click',function(event) {
                        event = event || window.event;
                        event.stopPropagation();
                        methods.close(opt);
                    });
                });
            });
        },
        add: function (o,$this) { //鏄剧ず寮规
            var w,h,t,l,m; $obj = $(o.box); title = o.title; c = $this.attr("class"); modalBg = o.modalBg; closeBg = o.closeBg;
            w = o.width != undefined ? parseInt(o.width) : '300';
            h = o.height != undefined ? parseInt(o.height) : '270';
            m = ""+(-(h/2))+'px 0 0 '+(-(w/2))+"px";

            //寮规浣嶇疆
            switch (o.positions) {
                case 'center':
                    t = l = '50%';
                    break;
                case 'top':
                    t = 0; l = '50%'; m = "0 0 0 "+(-(w/2))+"px";
                    break;
                case 'left':
                    t = l = m = 0;
                    break;
                default:
                    t = l = '50%';
            }

            methods.remove('#HOverlay,#HCloseBtn,#HTitle');
            $body.stop().append("<div id='HOverlay' style='width:"+_doc.width()+"px;height:"+_doc.height()+"px;background-color:"+modalBg+";position:fixed;top:0;left:0;z-index:9999;'></div>");
            if(o.title != ''){ $obj.stop().prepend('<div id="HTitle" style="font-weight:bold; color:#073c6e; font-size:16px;padding:10px 45px 10px 12px;border-bottom:1px solid #ddd;background-color:#f2f2f2;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">'+o.title+'</div>'); }
            if(o.closeHide != false){
                $obj.stop().append('<a id="HCloseBtn" title="鍏抽棴" style="width:24px;height:24px;line-height:18px;display:inline-block;cursor:pointer;background-color:'+closeBg+';color:#fff;font-size:1.4em;text-align:center;position:absolute;top:8px;right:8px;"><span style="width:24px;height:24px;display:inline-block; line-height: 24px;">X</span></a>').css({'position':'fixed','backgroundColor':o.boxBg,'top':t,'left':l,'margin':m,'zIndex':'100000'});
            }
            $obj.stop().animate({'width':o.width,'height':o.height},300).removeAttr('class').addClass('animated '+c+'').show();
        },
        close: function (o, urls) { //鍏抽棴寮规
            var $obj = $(o.box);
            //鍏抽棴鏁堟灉
            switch(o.effect){
                case "hide":
                    $obj.stop().hide(_effect);
                    break;
                case "fadeOut":
                    $obj.stop().fadeOut(_effect);
                    break;
                default:
                    $obj.stop().hide(_effect);
            }

            function _effect() {
                methods.remove('#HOverlay,.HTooltip');
                $(this).removeAttr('class').removeAttr('style').addClass('animated').hide();
                if(urls != undefined) { setTimeout(function() { window.location.href = urls; },1000); }
                methods.fire.call(this, o.afterHide); //闅愯棌鍚庣殑鍥炶皟鏂规硶
            }
        },
        remove: function (a) { //绉婚櫎鍏冪礌
            $(a).remove();
        },
        fire: function (event, data) { //璋冪敤鍥炶皟鍑芥暟
            if($.isFunction(event)) { return event.call(this, data); }
        }
    };

    $.fn.hDialog = function (method) {
        if(methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        }else if(typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        }else {
            $.error('Error! Method' + method + 'does not exist on jQuery.hDialog锛�');
        }
    };

    /**
     +----------------------------------------------------------
     * 鍐呯疆鎵╁睍
     +----------------------------------------------------------
     */
    $.extend({
        /**
         * @decription 缁欐柟娉曟坊鍔犲姞杞藉嚱鏁�
         * @param t : string 鍔犺浇鏂囧瓧
         * @param w : string 鍔犺浇妗嗗搴�
         * @param h : string 鍔犺浇妗嗛珮搴�
         */
        showLoading: function (t, w, h) { //鏄剧ず鍔犺浇
            t = t != undefined ? t : '姝ｅ湪鍔犺浇...';
            w = w != undefined ? parseInt(w) : '90';
            h = h != undefined ? parseInt(h) : '30';
            var margin = ""+(-(h/2))+'px 0 0 '+(-(w/2))+"px";
            methods.remove('#HLoading');
            $body.stop().append('<div id="HLoading" style="width:'+w+'px;height:'+h+'px;line-height:'+h+'px;background:rgba(0,0,0,0.6);color:#fff;text-align:center;position:fixed;top:50%;left:50%;margin:'+margin+';">'+t+'</div>');
        },
        hideLoading: function () { //绉婚櫎鍔犺浇
            methods.remove('#HLoading');
        },
        /**
         * @decription 缁欐柟娉曟坊鍔犳彁绀哄嚱鏁�
         * @param t1 : string 鎻愮ず鏂囧瓧
         * @param t2 : string 鎻愮ず鏃堕棿
         * @param t3 : boolean 鎻愮ず绫诲瀷锛岄粯璁や负false
         */
        tooltip: function (t1, t2, t3) {
            t1 = t1 != undefined ? t1 : '鍝庡憖锛屽嚭閿欏暒 锛�';
            t2 = t2 != undefined ? parseInt(t2) : 2500;
            var tip = '<div class="HTooltip shake animated" style="width:280px;padding:10px;text-align:center;background-color:#D84C31;color:#fff;position:fixed;top:10px;left:50%;z-index:100001;margin-left:-150px;box-shadow:1px 1px 5px #333;-webkit-box-shadow:1px 1px 5px #333;">'+t1+'</div>';
            if(t3) { tip = '<div class="HTooltip fadeIn animated" style="width:280px;padding:10px;text-align:center;background-color:#5cb85c;color:#fff;position:fixed;top:10px;left:50%;z-index:100001;margin-left:-150px;box-shadow:1px 1px 5px #333;-webkit-box-shadow:1px 1px 5px #333;">'+t1+'</div>'; }
            methods.remove('.HTooltip');
            $body.stop().append(tip);
            setTimeout(function() { methods.remove('.HTooltip'); },t2);
        },
        /**
         * @decription 杩斿洖椤堕儴
         * @param b : string 鍜屽睆骞曞簳閮ㄧ殑璺濈
         * @param r : string 鍜屽睆骞曞彸渚х殑璺濈
         */
        goTop: function (b, r) {
            b = b != undefined ? b : '30px';
            r = r != undefined ? r : '20px';
            methods.remove('#HGoTop');
            $body.stop().append('<a id="HGoTop" href="javascript:;" class="animated" style="width:40px;height:40px;line-height:40px;display:inline-block;text-align:center;background:#333;color:#fff;position:fixed;bottom:'+b+';right:'+r+';z-index:100000;">Top</a>').find('#HGoTop').hide();
            $(window).scroll(function(){
                if($(window).scrollTop()>150){
                    $('#HGoTop').removeClass('rollIn rollOut').addClass('rollIn').show();
                }else{
                    $('#HGoTop').removeClass('rollIn rollOut').addClass('rollOut');
                }
            });

            //杩斿洖椤堕儴鎸夐挳鐐瑰嚮浜嬩欢
            $('#HGoTop').on('click',function(){
                $('body,html').animate({ scrollTop:0 },500);
                return false;
            });
        }
    });
})(jQuery, window, document);

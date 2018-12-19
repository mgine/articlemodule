(function ($) {
    "use strict";

    var Ankieta = function (element) {

        var self = this;

        self.o = {
            test: true,
            autorefresh: true
        };

        self.el = element;

        self.form = false;

        self.pages = false;

        self.counter = 5;

        self.init = function (options) {

            self.o = $.extend(self.o, options);

            self.form = new FormController().init();
            self.pages = new PagesController().init();

            if (self.o.autorefresh) {
                var ticCounterIsStarted = false;
                resetCounter();
                var ticCounter = function (recursive) {
                    if(!recursive){
                        if(ticCounterIsStarted){
                            return;
                            
                        }else{
                            resetCounter();
                            $('body').trigger('sessionStart');
                            ticCounterIsStarted = true;
                        }
                    }
                    
                    if (self.counter <= 0) {
                        
                        self.form.submit();
                        ticCounterIsStarted = false;
                        /**** To do things when screensaver restart site ********/



                        /*****************************************************/
                        $('body').trigger('sessionStop');
                        return;
                    }

                    self.counter = self.counter - 1;
                    setTimeout(function () {
                        ticCounter(true);
                    }, 7500);

                };

                // ticCounter();
                $('body').on('click tap taphold touchstart mousedown swipe',function (event) {
                    if($(event.target).hasClass('disable-click') || $(event.target).parents('.disable-click').length){
                        return;
                    }
                    resetCounter();
                });
                $('body').on('tap taphold touchstart mousedown swipe',function () {
                    if($(event.target).hasClass('disable-click') || $(event.target).parents('.disable-click').length){
                        return;
                    }
                    ticCounter();
                });
                $('#screensaver').on('touchstart mousedown click',function () {
                    ticCounter();
                    $(this).hide(300);
                    return false;
                });
                //RESET
                
                var refreschTimer;

                $('.logo img').on('touchend mouseup',function () {
//                    console.log('up');
                  clearTimeout(refreschTimer);
                  
                }).on('touchstart mousedown',function () {
                  // Set timeout
                  refreschTimer = window.setTimeout(function() {
                      window.location.href = window.location.href;
                  },4000);
                  
                });
            }

            return self;
        }

        function FormController() {

            this.config = {

            };

            this.el = false;

            this.key = false;

            this.popup = false;

            this.init = function () {

                var f = this;

                f.config = $.extend(f.config, self.o.formController);

                f.key = new Date().getTime();

                f.el = self.el.find('#ankieta');

                f.popup = $('#submitPopup').css('z-index', '9999');

                f.attachedEvents();

                return this;

            }

            this.attachedEvents = function(){

                var f = this;

                f.el.on('submit', function(){

                    if($(this).data('key') === f.key){
                        return true;
                    }

                    return false;
                });

                self.el.find('.ankieta-submit').on('click touchdown', function(){
                    f.submit();
                });

                self.el.find('.submit-popup').on('click touchdown', function(){
                    f.popup.show(300);
                });
                $('.max-checked').on('change', function(){
                    if($('input[name="'+$(this).attr('name')+'"]:checked').length > $(this).data('max-checked')){
                        this.checked = false;
                    }
                })
                f.popup.find('.close').on('click touchdown', function(){
                    f.popup.hide(300);
                });


            }

            this.submit = function(){
                this.el.data('key', this.key);
                this.el.submit();
            }

        }

        function PagesController() {

            this.config = {
                "class" : '.page-switcher'
            };

            this.el = false;

            this.current = false;

            this.init = function () {

                var p = this;

                p.config = $.extend(p.config, self.o.pages);

                p.el = self.el.find(p.config.class);

                p.el.hide();

                p.current = p.el.first();

                p.current.show(200).css('z-index', '10');

                p.attachedEvents();


                return this;

            }
            this.attachedEvents = function(){
                var p = this;
                self.el.find('.next-page:not(.disabled)').on('click touchdown', function(){console.log('test');
                    p.next();
                });

                self.el.find('.prev-page:not(.disabled)').on('click touchdown', function(){
                    p.prev();
                });
                self.el.find('.first-page:not(.disabled)').on('click touchdown', function(){
                    p.first();
                });
                self.el.find('.last-page:not(.disabled)').on('click touchdown', function(){
                    p.last();
                });
            },
            this.next = function(){

                var p = this;

                if(p.current.data('page') == p.el.last().data('page')){
                    p.goto(p.el.first());
                    return;
                }

                var go = null;
                $.each(p.el, function(index, item){
                    item = $(item);

                    if(go){
                        console.log(item.data('page'));
                        p.goto(item);
                        go = false;
                        return false;

                    }

                    if((item.data('page') == p.current.data('page')) && (go === null)){
                        go = true;
                    }

                });

                return;
            }

            this.prev = function(){

                var p = this;

                if(p.current.data('page') == p.el.first().data('page')){
                    return p.goto(p.el.last());
                }

                var prev = false;
                $.each(p.el, function(index, item){
                    item = $(item);
                    if(!prev){
                        prev = item;
                        return;
                    }

                    if(item.data('page') == p.current.data('page')){
                        p.goto(prev);
                        return false;
                    }else{
                        prev = item;
                    }

                });

                return;
            }

            this.first = function(){

                var p = this;

                if(p.current.data('page') == p.el.first().data('page')){
                    return;
                }

                return p.goto(p.el.first());

                return;
            }

            this.last = function(){

                var p = this;

                if(p.current.data('page') == p.el.last().data('page')){
                    return;
                }

                return p.goto(p.el.last());

            }

            this.goto = function(item){
                this.current.hide(200).css('z-index', '1');
                this.current = item;
                this.current.show(200).css('z-index', '10');
                return;
            }
        }
        
        var resetCounter = function () {
            self.counter = 6;
        }

        var resetCounterHalf = function () {
            self.counter = 3;
        }
        
        var scrollLevelCalculateTopPosition = function (top) {

            if (self.o.switchLevelScroll > 0) {
                if (typeof self.scale == 'undefined') {
                    self.scale = self.contentHeight / 1000;
                }
                var x = self.scrollLevelTopValue * self.contentHeight * self.scale - (self.scrollLevelTopValue * self.o.switchLevelScroll);
                if (typeof top == 'undefined') {
                    return x;
                }
                var containerInner = self.contentHeight * self.scale;
                var container = self.container.height();
                if (top) {
                    if (containerInner > container) {
                        self.y = 0;

                        return x;
                    } else {
                        return x;
                    }
                }

                if (containerInner > container) {
                    self.y = -(containerInner - container);
//                            self.map.data('lastY',self.y );
                    return x - self.y;
                } else {
                    return x;
                }

            } else {
                return 0;

            }

        };

    };

    $.fn.ankieta = function (options) {

        return this.each(function () {
            var element = $(this);

            if (element.data('ankieta'))
                return;

            var instance = (new Ankieta(element)).init(options);

            element.data('ankieta', instance);
        });
    };

})(jQuery);

var $ = jQuery.noConflict();

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i=0; i<ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1);
      if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
  }
  return "";
}
  
function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+d.toGMTString();
  document.cookie = cname + "=" + cvalue + "; " + expires +"; path=/";
} 

(function(){
  var saampleScript = {

    init: function() {
      //this.fixedMenu();
      this.rwdNav();
      this.slideBox();
      this.popup();
      this.scrollTo();
      this.nicePopup();
      this.selectCheckbox();
      this.showAdvancedSearch();
      this.offerViews();
      this.sgMapController();
      this.scrollToController();
      this.contactFormController();
      this.searchFormController();
      this.selectMoreThanController();
      this.loadMoreController();
      this.seeMoreInformationTable();
      this.rwdSlideshowController();
      this.rwdInvestSlideshowController();
    },
    rwdInvestSlideshowController(){
        
        var $slideShowInvest = $('.investment-container .location-wrapper');
        if(!$slideShowInvest.length){
            return;
        }
        var cicleSlideShow = false;       
        
        var setSize = function(windowWidth){
            if(windowWidth <= 768){
                
                if(!cicleSlideShow){
                    cicleSlideShow = true;
                    $slideShowInvest.cycle('destroy');
                    $slideShowInvest.cycle({
                        slides:".column",  
                        timeout:7000,
                        swipe:true,
                        fx:"scrollHorz",
                        swipeFx:"scrollHorz",
                        pauseOnHover: true
                    });
                    
                }
            }else{
                if(cicleSlideShow){
                    cicleSlideShow = false;
                    $slideShowInvest.cycle('destroy');
                    
                }
            }
            
        };
        setSize(window.innerWidth);
        
        $(window).on('resize', function(){
            setSize(window.innerWidth);
        });
        
    },
    rwdSlideshowController(){
        
        var $slideShow = $('.news--wrapper--slideshow');
        var $search = $('.wrapper.search');
        var $img = $slideShow.find('.news:first-of-type a.figure img');

        if(!$search.length || !$slideShow.length || !$img.length){
            return;
        }
        var descHeight = $('.news:first-of-type .desc', $slideShow);
        var setSize = function(windowWidth){
            if(windowWidth <= 992){
                var tmpHeight = descHeight.outerHeight()+$img.height();
                $slideShow.height(tmpHeight);
                $search.css({'marginTop': tmpHeight});
            }else{
                $slideShow.removeAttr('style');
                $search.removeAttr('style');
            }
            
        };
        
        $(window).on('load', function(){
                setSize(window.innerWidth);
        });
        
        $(window).on('resize', function(){
            setSize(window.innerWidth);
        });
        
    },
    seeMoreInformationTable(){
        var table = $('.see-more-information-table');
        var button = $('.see-more-information-table-button');
        if(!table.length){
            return;
        }
        table.hide();
        
        button.on('click', function(){
            if(table.hasClass('open')){
                table.slideUp({duration: 400, easing: 'linear', complete: function(){
                        button.text('Zobacz więcej informacji');
                }}).removeClass('open');
                button.removeClass('open');
            }else{
                table.slideDown({duration: 400, easing: 'linear', complete: function(){
                        button.text('Zwiń');
                }}).addClass('open');
                button.addClass('open');
            }
        });
        
    },
    loadMoreController(){
        var wrapper = $('.load-more-wrapper');
        $('#show-more-galleries').on('click', function(){
            $('#hidden-galleries').slideDown(400);
            $(this).slideUp(400);
        });
        if(!wrapper.length){
            return;
        }
        var link = $('.load-more-link');

        if(($('.load-more-meter').height()) <= wrapper.height()){
            wrapper.css('height', 'auto');
            link.remove();
        }
        
        link.on('click', function(){
            wrapper.css('height', ($('.load-more-meter').height())+'px');
            setTimeout(function(){
                wrapper.css('height', 'auto');
            }, 1150);
            link.hide(200, function(){
                link.remove();
            })
        });
    },
    selectMoreThanController(){
        var moreThanSelect = function($select){
            if(typeof $select == 'undefined' || $select.length != 1){
                return;
            }
            var $wrapper = $select.parents('.select-more-than');
            var $plus = $('.plus', $wrapper);
            var $minus = $('.minus', $wrapper);
            var $name = $('.value', $wrapper);
            
            var values = [];
            var currentSelected = false;
//            var valuesIndex = {};
            var index = 0;
            $('option', $select).each(function(i, item){ 
                var $item = $(item);
                if(!$item.attr('value')){
                    return;
                }
                values.push({
                    "name" : $item.text(),
                    "value" : $item.attr('value'),
                    "selected" : $item.attr('selected') ? true : false
                 });
                 if($item.attr('selected')){
                     currentSelected = index;
                     $name.text($item.text());
                 }
                 index++;
            });
            if(currentSelected === false){
                $minus.addClass('block');
            }
            
            if(values[values.length-1]['selected']){
                $plus.addClass('block');
            }
            
            var setBlock = function(){
                if(currentSelected === false){
                    $minus.addClass('block');
                    $plus.removeClass('block');
                    if($('#arch-select').length){
                        $('#arch-select').val(12);
                    }
                }else if(currentSelected === values.length-1){
                    $minus.removeClass('block');
                    $plus.addClass('block');
                }else{
                    $minus.removeClass('block');
                    $plus.removeClass('block');
                }
            };
            
            var pp = function(){

                if(currentSelected === values.length-1){
                    return false;
                }
                
                if(currentSelected === false){
                    currentSelected = 0;
                }else{
                    currentSelected++;
                }
                
                var toSelect = values[currentSelected];
                $select.val(toSelect.value).trigger('change');
                $name.text(toSelect.name);
                
                setBlock();
            };
            $plus.click(function(){
                if($(this).hasClass('block')){
                    return;
                }
                pp();
            });
            
            
            var mm = function(){

                if(currentSelected === false){
                    return false;
                }
                
                if(currentSelected === 0){
                    currentSelected = false;
                    $name.text('');
                    $("option", $select).removeAttr("selected");
                }else{
                    currentSelected--;
                    var toSelect = values[currentSelected];
                    $select.val(toSelect.value).trigger('change');
                    $name.text(toSelect.name);
                }
                
                
                setBlock();
            };
            
            $minus.click(function(){
                if($(this).hasClass('block')){
                    return;
                }
                mm();
            });
        };
        moreThanSelect($('select.rmt'));
    },
    searchFormController(){
        
        var $searchForm = $('#searchForm');
        var $searchCountText = $('#searchCountText');
        var searchCountGetJson = false;
        if(!$searchForm.length){
            return;
        }
        
        var ajaxCountFlat = function(reload){
            if(searchCountGetJson){
                searchCountGetJson.abort();
            }
            var query = $searchForm.serialize();
            query = query + '&typ=' + $searchForm.data('type');
            searchCountGetJson = $.getJSON('/searchcount?'+query, function(data){
                if(typeof data.ile != 'undefined'){
                    $searchCountText.text('('+data.ile+')');
                    if(reload){
                        window.location.reload();
                    }
                }
                
            });
            
        };

        $('#searchForm .input--default').on('change',function () {
            ga('send','event','WYSZUKIWARKA','Zmiana miasta');
        });

        
        ajaxCountFlat();
        $('input,select,textarea', $searchForm).on('change', function(event){

            if($(event.target).attr('name') == 'oddzialy' && $(event.target).val() == 'warszawa'){
                window.location.href='https://site.pl/';
                return;
            }

                ajaxCountFlat((window.location.pathname == '/') && ($(event.target).attr('name') == 'oddzialy'));

        });
        
    },
    contactFormController(){
        var chooseSubject = function(){
            $('body').on('click', '.choose-subject', function(){
                var $wrapper = $(this).parents('.chose-subject-wrapper');
                var chooseSubjects = $('.choose-subject', $wrapper);
                var input = $('.choose-subject-input', $wrapper);
                
                input.val($(this).data('value'));
                chooseSubjects.not($(this)).removeClass('active');
                $(this).addClass('active');
            });
        };
        chooseSubject();
        
        var rwdAddText = function(width){
            if(window.innerWidth < 580){
                $('.rwd-add-text').each(function(index, item){
                    var $item = $(item);
                    if($item.val() == ''){
                        $item.val('Prośba wysłana z urządzenia mobilnego.');
                    }
                });
            }else{
                $('.rwd-add-text').each(function(index, item){
                    var $item = $(item);
                    if($item.val() == 'Prośba wysłana z urządzenia mobilnego.'){
                        $item.val('');
                    }
                });
            }
            
        };
        $(window).on('load', function(){
                rwdAddText();
        });
        
        $(window).on('resize', function(){
            rwdAddText();
        });
    },
    scrollToController(){
        $(document).on('click','.scrollTo', function(){
            var el = $($(this).data('href'));
            var fixPosition = $(this).data('fix-position');
            
            if(typeof fixPosition != 'undefined')
            {
                fixPosition = parseInt(fixPosition);
            }else{
                fixPosition = 0;
            }
            
            if(el.length){
                $('html, body').stop().animate({
                    scrollTop: el.offset().top + fixPosition
                }, 1000);
            }
        });
    },
    sgMapController: function(){
            var container = $('.offers--and--map--container');
            var desc = container.find('.map--container');
            if(!desc.length){
                return;
            }
            desc.css('width', desc.outerWidth()+'px');

            $(window).on('load', function(){
                
                var offset = desc.offset();
                var containerOffset = container.offset();
                var height = desc.outerHeight();
                var containerHeight = container.outerHeight();
                var rt = ($(window).width() - (offset.left + desc.outerWidth()));
                var fixedTop = $(window).width() > 1366 ? 40 : 15;
                
                var fixPosition = function(){
                    var scrollTop = $(this).scrollTop();
                    var bottomIs = scrollTop+height > (containerOffset.top+containerHeight);

                    if(scrollTop >= offset.top-fixedTop && !bottomIs){
                        desc.addClass('fixed');
                        desc.removeClass('bottom');
                        desc.css('right', rt+'px');
                    }else if(bottomIs){
                        desc.addClass('bottom');
                        desc.removeClass('fixed');
                        desc.css('right', '0');
                    }else{
                        desc.css('right', '0');
                        desc.removeClass('fixed');
                        desc.removeClass('bottom');
                    }
                };
                
                $(window).scroll(function () {
                    fixPosition();
                });
                
                fixPosition();
            });

            

    },
    fixedMenu: function(){
      var header = $('header');
      if($(window).width() > 1500){
        header.addClass('fixed--top');
      }
      $(window).scroll(function(){
        if($(window).scrollTop() > 146 && $(window).width() > 1160 && $(window).width() < 1500){
          if(!header.hasClass('fixed')){
						header.addClass('fixed');
					}
        }else{
          if(header.hasClass('fixed')){
						header.removeClass('fixed');
					}
        }
      });
      $(window).scroll(function(){
        if($(window).width() > 1500 && !header.hasClass('fixed--top')){
          header.addClass('fixed--top');
        }
      });
      $(window).on('resize', function(){
        header.removeClass('fixed');
        header.removeClass('fixed--top');
      });
    },
    rwdNav: function () {
      var button = $('#menu--button');
      var logo = $('.rwd-logo a');
      var header = $('header');
      var menu = $('body').find('header .menu a');

      button.on('click', function(e){
        e.preventDefault();
        if($(this).hasClass('active')){
          $(this).removeClass('active');
          header.removeClass('active');
          logo.removeClass('active');
        }else{
          $(this).addClass('active');
          header.addClass('active');
          logo.addClass('active');
        }
      });
      menu.on('click', function(){
        if($(window).width() < 992){
          window.location.href = $(this).attr('href');
        }
      })
    },
    slideBox:function(){
      var button = $('body').find('.contact__location-box h4');
      button.on('click', function(e){
        e.preventDefault();
        var parent = $(this).parent();
        var table = parent.find('.table-toggle');
        var icon = $(this).find('i');
        if(icon.hasClass('active')){
          table.slideUp(200);
          icon.removeClass('active');
        }else{
          table.slideDown(200);
          icon.addClass('active');
        }
      });
    },
    popup:function(){
      var allPicture = [];
      var clickedIndex = -1;

      var btnActive = $('body').find('.btn--ws-poup');
      var btnClose =  $('body').find('.ws--popup .close--popup');
      var divScreen = $('body').find('.ws--popup-screen');
      var divContent = $('body').find('.ws--popup');

      btnActive.each(function(index, el) {
        var picture = {
          index:index,
          link:$(this).attr('href')
        }
        allPicture.push(picture);
      });

      divContent.delegate('.prev', 'click', function(e) {
        e.preventDefault();
        if(clickedIndex == 0){
          $(this).addClass('disabled');
        }else{
          $('.ws--popup .photo-controller').removeClass('disabled');
          clickedIndex--;
          var img = divContent.find('img');
          img.fadeOut(200);
          setTimeout(function(){
            img.attr('href', allPicture[clickedIndex].link);
            img.fadeIn(200);
          },200);
        }
      });
      divContent.delegate('.next', 'click', function(e) {
        e.preventDefault();
        if(clickedIndex == allPicture.length-1){
          $(this).addClass('disabled');
        }else{
          $('.ws--popup .photo-controller').removeClass('disabled');
          clickedIndex++;
          var img = divContent.find('img');
          img.fadeOut(300);
          setTimeout(function(){
            img.attr('href', allPicture[clickedIndex].link);
            img.fadeIn(200);
          },200);
        }
      });

      btnActive.on('click', function(e){
        e.preventDefault();
        var checkCtr = divContent.find('.photo-controller');
        if(!checkCtr.length > 0){
          divContent.append('<a href="" class="photo-controller prev">&nbsp</a>');
          divContent.append('<a href="" class="photo-controller next">&nbsp</a>');
        }
        for(var i=0; i < allPicture.length; i++){
          if(clickedIndex == -1){
            if($(this).attr('href') == allPicture[i].link){
              clickedIndex = allPicture[i].index;
            }
          }
        }
        if(clickedIndex == 0){
          $('.photo-controller.prev').addClass('disabled');
        }
        if(clickedIndex == allPicture.length-1){
          $('.photo-controller.next').addClass('disabled');
        }
        var img = divContent.find('img');
        img.attr('src', allPicture[clickedIndex].link);
        divScreen.fadeIn(200);
        setTimeout(function(){
          divContent.fadeIn(100);
        },300);
      });
      btnClose.on('click', function(e){
        e.preventDefault();
        var img = divContent.find('img');
        img.attr('src', '');
        divScreen.fadeOut(200);
        divContent.fadeOut(100);
      });
    },
    scrollTo:function(){
      var btn = $('body').find('.scrollToBox');
      btn.on('click', function(e){
        e.preventDefault();
        box = $('body').find($(this).attr('href'));
        $('body, html').animate({
          scrollTop: box.offset().top
        }, 300);
      });
    },
    nicePopup:function(){
      var btn = $('body').find('.open--nice-popup');
      var popup = $('body').find('.ws--nice-popup');
      var btnClose =  $('body').find('.ws--nice-popup .close--popup');

      btn.on('click', function(e){
        e.preventDefault();
        thisPopup = $('body').find($(this).attr('href'));
        thisPopup.fadeIn(300);
      });

      btnClose.on('click', function(e){
          
        e.preventDefault();
        $('.flats-pdf-ajax-overlay').fadeOut(300);
        popup.fadeOut(300);
      });
    },
    selectCheckbox:function(){
      var select = $('body').find('.select--checkbox a');
      select.after().on('click', function(e){
        e.preventDefault();
        parent = $(this).parent();
        if(parent.hasClass('clicked')){
          var checkbox = parent.find('.checkbox.hidden');
          checkbox.slideUp(300);
          parent.removeClass('clicked');
        }else{
          var checkbox = parent.find('.checkbox.hidden');
          checkbox.slideDown(300);
          parent.addClass('clicked');
        }
      });
    },
    showAdvancedSearch:function(){
      var btn = $('body').find('#showAdvancedSearch');
      var search = $('.advanced--form');
      btn.on('click', function(e){
        e.preventDefault();
        if($(this).hasClass('active')){
          $(this).removeClass('active');
          search.slideUp(300);
        }else{
          $(this).addClass('active');
          search.slideDown(300);
        }
      });
    },
    offerViews:function(){
      var view = $('body').find('.views');
      var sw = view.find('a');

      var offerView = getCookie('offerview');
      if(offerView == ''){
        setCookie('offerview', '#grid', 1);
      }

      if(offerView == '#grid'){
        view.find('.grid').addClass('active');
        $('#grid').show();
      }else{
        view.find('.list').addClass('active');
        $('#list').show();
      }

      
      $('body').on('click', '.views a', function(e){
        e.preventDefault();
        $('.views a').removeClass('active');
        $(this).addClass('active');
        $('#grid, #list').slideUp(500);
        $($(this).attr('href')).slideDown(500);
        setCookie('offerview', $(this).attr('href'), 1);
      });

    }
  }
  $(document).ready(function($){
		sampleScript.init();
	});

}());




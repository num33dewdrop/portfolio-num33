import $ from 'jquery';
$(function() {
    const aniMod = (() => {
        let scrollCurrent = $(window).scrollTop(),
            windowHeight = $(window).innerHeight(),

            addScrollClass = ($elems, className) => {
            $.each($elems, function() {
                let $this = $(this),
                    elemPos = $this.offset().top;
                if(scrollCurrent >= elemPos - windowHeight && !$this.hasClass(className)) {
                    $this.addClass(className);
                }
            });
        }

        return {
            setScrollCurrent : val => {
                scrollCurrent = val;
            },
            //===============================================
            //topBannerScroll
            //===============================================
            imgScroll : () => {
                let $img = $('.js-moveImg'),
                    topBannerPos = scrollCurrent / 8;
                $img.css('transform',  'translateY(' + topBannerPos + 'px)');
            },
            //===============================================
            //fadeDelay
            //===============================================
            fadeDelay : () => {
                let delayTimeDefault = 0.4,
                    delayTime = 0.2,
                    $contents = $('.js-fadeDelay');

                $.each($contents, function() {
                    let contentsOffset = $(this).offset().top,
                        $contentsChildren = $(this).children();
                    $contentsChildren.addClass('js-fadeDelay__item');

                    $.each($contentsChildren, function() {
                        if(scrollCurrent >= contentsOffset - windowHeight) {
                            $(this).addClass('js-fadeDelay__item--active').css('animation-delay', (delayTimeDefault + delayTime) + 's');
                            delayTime += 0.2;
                        }
                    });
                    delayTime = 0.2;
                });
            },
            //===============================================
            //contentsFadeIn
            //===============================================
            contentsFadeIn : () => {
                addScrollClass($('.js-fadeIn'), 'js-scroll--fadeIn');
            },
            //===============================================
            //subtitleSlideIn
            //===============================================
            subtitleSlideIn : () => {
                addScrollClass($('.js-slideIn'), 'js-scroll--slideIn');
            }
        };
    })();
    //===============================================
    //init
    //===============================================
    aniMod.contentsFadeIn();
    aniMod.subtitleSlideIn();
    aniMod.fadeDelay();

    //===============================================
    //scroll
    //===============================================
    $(window).on('scroll',function () {
        aniMod.setScrollCurrent($(window).scrollTop());

        aniMod.imgScroll();
        aniMod.contentsFadeIn();
        aniMod.subtitleSlideIn();
        aniMod.fadeDelay();
    });

    //===============================================
    //hamburger
    //===============================================
    $('.js-toggleSpMenu').on('click',function() {
        let $that = $(this),
            $spMenu = $('.js-targetSpMenu'),
            $hideLinks = $('.js-hideSpMenu').children(),
            activeBlendMode = () => {
                if($spMenu.hasClass('active')) {
                    $spMenu.parent().css('mix-blend-mode','unset');
                }else {
                    setTimeout(() => {
                        $spMenu.parent().css('mix-blend-mode','exclusion');
                    }, 500);
                }
            };
        $that.toggleClass('active');
        $spMenu.toggleClass('active');
        $.each($hideLinks, function(){
            $(this).on('click', function() {
                $spMenu.removeClass('active');
                $that.removeClass('active');
                activeBlendMode();
            });
        });
        activeBlendMode();
    });

    //===============================================
    //spSkillShow
    //===============================================
    $('.js-spSkillShow').on('click', function() {
        let $spSkillTarget = $('.js-spSkillTarget'),
            $spSkillHide = $('.js-spSkillHide');
        $spSkillHide.toggleClass('active');
        $spSkillTarget.toggleClass('active');

        $spSkillHide.on('click', function() {
            $(this).removeClass('active');
            $spSkillTarget.removeClass('active');
        });
    });

    /*================================================================
    フッター最下部
    ================================================================*/
    let $ftr = $('#footer'),
        $body = $("body");
    if (window.innerHeight > $ftr.offset().top + $ftr.outerHeight()) {
        $body.css({height: '100vh'});
        $ftr.css({position: 'fixed', top: (window.innerHeight - $ftr.outerHeight()) });
    }

    /*================================================================
    works全件表示
    ================================================================*/
    let $showFullBtn = $(".js-showFullBtn");
    $.each($showFullBtn, function() {
        let $this = $(this),
            $parent = $this.parents(".js-showFullContainer"),
            $target = $parent.find(".js-showFullTarget");
        if($target.length < 4) {
            $this.css('display', 'none');
            $parent.find(".js-showFullTarget:last-child").css('margin-bottom', 0);
        }else {
            $this.css('display', 'block');
        }
    });
    $showFullBtn.on('click', function () {
        let $this = $(this),
            $parent = $this.parents(".js-showFullContainer"),
            $target = $parent.find(".js-showFullTarget"),
            $targetPos = $parent.find(".js-subTitlePos");
        $this.toggleClass("active");
        $target.toggleClass("active");
        if ($this.hasClass("active")) {
            $this.text('Close');
        } else {
            $this.text('More');
            $("body , html").scrollTop($targetPos.offset().top);
        }
    });
});


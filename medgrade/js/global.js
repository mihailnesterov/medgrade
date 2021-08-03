$(document).ready(function () {

});

/* toTop Button */
$(function() { 
    $(window).scroll(function() { 
    if($(this).scrollTop() != 0) { 
        $('#toTop').fadeIn(); 
        } else {	 
                $('#toTop').fadeOut(); 
        }	 
    }); 
        $('#toTop').click(function() { 
        $('body,html').animate({scrollTop:0},800); 
    });
});

/* product tabs */
$(function() { 
    function tabsOneTimeInit() {
        const tabsHeaders = [];
        let tabsCount = 0;
        $('#page-product .second-column .tabs .tab').each( function() {
            const h5 = $(this).find('h5');
            tabsHeaders.push($(h5).text());
            $(h5).hide();
        });
        $('#page-product .second-column .tabs-nav ul li').each( function() {
            $(this).html(tabsHeaders[tabsCount]);
            tabsCount++;
        });
        //  photo tab name
        if(tabsHeaders[(tabsCount-1)] == '') {
            tabsHeaders[(tabsCount-1)] = 'Фото';
        }

        $('#page-product .second-column .tabs-nav ul li:last-child').html(tabsHeaders[(tabsCount-1)]);
        document.querySelector('#page-product .second-column .tabs-nav ul li').classList.add('active'); 
        document.querySelector('#page-product .second-column .tabs .tab').classList.add('active'); 
    } // end tabsOneTimeInit

    function tabsInit() {
        let tab_li_count = 0;
        let tab_card_count = 0;
        $('#page-product .second-column .tabs .tab.active .tab-content ul li').each( () => {
            tab_li_count++;
        });
        if($('#page-product .second-column .tabs .tab.active .tab-content .card')) {
            $('#page-product .second-column .tabs .tab.active .tab-content .card').each( () => {
                tab_card_count++;
            });
        }
        if( tab_li_count > 0) {
        $('#page-product .second-column .tabs .tab.active button .btn-count').html(tab_li_count);
        } else if( tab_card_count > 0) {
            $('#page-product .second-column .tabs .tab.active button .btn-count').html(tab_card_count);
        } else {
            $('#page-product .second-column .tabs .tab.active button .btn-count').html(0);
        }
        $('#page-product .second-column .tabs .tab.active').on('click', 'button', function() {
            const tabContent = $(this).closest('.tab').find('.tab-content');
            if( $(tabContent).hasClass('overflow-hidden') ) {
                $(tabContent).removeClass('overflow-hidden');
                $(this).find('.btn-text').html('Свернуть &#8593;');
            } else {
                $(tabContent).addClass('overflow-hidden');
                location.href = '#page-product';
                $(this).find('.btn-text').html('Развернуть &#8595;');
            }
        });
    } // end tabsInit

    tabsOneTimeInit();   // init tabs one time on load
    tabsInit(); // init tabs on every tab's click
    
    $('#page-product .second-column .tabs .tabs-nav ul').on('click', 'li', function() {
        tabsInit();
        $('#page-product .second-column .tabs .tabs-nav ul li').each(function() {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $('#page-product .second-column .tabs .tab').each(function() {
            $(this).removeClass('active');
        });
        document.querySelectorAll('#page-product .second-column .tabs .tab')[Number($(this).data('num'))-1].classList.add('active');
        tabsInit();
    });
});

// one click form ajax send
/*$(function() {
    $('#one-click-order-form').on('beforeSubmit', function(e) {
        e.preventDefault();
        console.log('beforeSubmit');
    }).on('submit',function(e){
        e.preventDefault();
        console.log('submit=' + $(this).find('input[type="text"]').val());
    });
});*/


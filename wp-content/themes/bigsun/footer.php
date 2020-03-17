<footer id="main">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <h1>CÔNG TY TNHH ĐẦU TƯ THƯƠNG MẠI DỊCH VỤ BIGSUN</h1>
                <h2>02, Võ Văn Kiệt, P. An Hòa, Q.Ninh Kiều, TP.Cần Thơ</h2>
                <h2>Hotline: <a href="tel:0913748513">0913748513</a> Mr.Nghi (CEO) -
                    <a href="tel:0981910123">0981910123</a> Mr.Dương</h2>
            </div>
            <div class="col-12 col-md-6">
                <div class="icon-row">
                    <a href="https://www.facebook.com/tochucsukiencanthoso/" target="_blank"><i id="icon-fb" class="lab la-facebook-square"></i></a>
                    <a href="https://goo.gl/maps/hRGVEMVL4zbLXgYh7" target="_blank"><i id="icon-map" class="las la-map-marked"></i></a>
                    <a href="https://www.youtube.com/channel/UC8EvAzSW2jnpCkBKzTT9UYA" target="_blank"><i id="icon-yt" class="lab la-youtube"></i></a>
                    <a href="mailto:phongkinhdoanh@bigsungroup.com.vn"><i id="icon-gg" class="lab la-google"></i></a>
                    <a href="tel:0981910123"><i id="icon-phone" class="las la-phone"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
<script type="text/javascript">
    $(function () {
        //caches a jQuery object containing the header element
        var thea = $("header nav#nav div#menu ul li a");
        var nav = $("header nav#nav");
        $(window).scroll(function () {
            var scroll = $(window).scrollTop();

            if (scroll >= 50) {
                //thea.addClass("darkthea");
                // nav.addClass("darknav");
            }
            else {
                //thea.removeClass("darkthea");
                // nav.removeClass("darknav");
            }
        });
    });
</script></body></html>
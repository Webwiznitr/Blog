<?php Confirm_Login(); ?>
<head>
    <title>Backend footer</title>
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<!--FOOTER STARTS-->
<div style="height: 5px; background: cornflowerblue"></div>
<footer class="footer-distributed" id="contact">
    <div class="footer-left">
        <h3 style="font-family: mindsagacustom;">MindSaga <span id="year" style="font-family: sans-serif;"></span></h3>
        <p class="footer-links">
            <a href="#" class="nav-link" style="margin-left: -15px;">About Us</a>
            ·
            <a href="index.php" class="nav-link">Blog</a>
            ·
            <a href="#" class="nav-link">Contact Us</a>
            ·
            <a href="#" class="nav-link">Features</a>
            .
        </p>
        <p class="footer-company-name">Made with 💕 by Webwiz</p>
    </div>

    <div class="footer-center">

        <div>
            <i class="fa fa-map-marker" ></i>
            <p><span>Loremlaudantium assumenda</span> Odisha, India</p>
        </div>

        <div>
            <i class="fa fa-phone"></i>
            <p>random789</p>
        </div>

        <div>
            <i class="fa fa-envelope"></i>
            <p><a href="">webwiz.nitrkl@gmail.com</a></p>
        </div>

    </div>

    <div class="footer-right">

        <p class="footer-company-about">
            <span>About MindSaga</span>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magni expedita assumenda temporibus sapiente veritatis veniam
        </p>
        <ul class="social">
            <li>
                <a href="#" class="fa fa-twitter"></a>
            </li>
            <li>
                <a href="#" class="fa fa-facebook"></a>
            </li>
            <li>
                <a href="#" class="fa fa-google"></a>
            </li>
            <li>
                <a href="#" class="fa fa-github"></a>
            </li>
            <li>
                <a href="#" class="fa fa-instagram"></a>
            </li>
            <li>
                <a href="#" class="fa fa-linkedin"></a>
            </li>
        </ul>
    </div>
</footer>
<div style="height: 5px; background: cornflowerblue"></div>
<!----FOOTER ENDS---->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
<script>
    $('#year').text(new Date().getFullYear());
</script>
</body>
</html>

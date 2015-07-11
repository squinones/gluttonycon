<!DOCTYPE HTML>
<!--
	Directive by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title>GluttonyCon.us</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <!--[if lte IE 8]>
    <script src="css/ie/html5shiv.js"></script><![endif]-->
    <script src="js/jquery.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/init.js"></script>
    <noscript>
        <link rel="stylesheet" href="css/skel.css"/>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/style-wide.css"/>
    </noscript>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="css/ie/v8.css"/><![endif]-->
</head>
<body>

<!-- Header -->
<div id="header">
    <a href="/">
        <img width="50%" src="./images/gluttonycon.png"/>
    </a>
    <h4>Every so often the most prestigious and unknown<br>
        developers across the world venture to a new city<br>
        to eat more than is humanly safe.</h4>

    {% if message == null %}
    <a class="button" href="/rsvp">RSVP</a>
    {% endif %}
</div>

<!-- Main -->
<div id="main">

    {% if message %}
    <header class="major container 75%" id="congrats">
        <h2>{{message}}</h2>
    </header>
    {% endif %}

    <div class="box alt container">
        <section class="feature left">
            <a href="#" class="image icon fa-map-marker"></a>

            <div class="content">
                <h3>A DESTINATION</h3>

                <p> Summer 2015 brings us our second semi-annual #GluttonyCon. Aug 28th - 30th~ish in Boston.</p>
            </div>
        </section>
        <section class="feature right">
            <a href="#" class="image icon fa-cutlery"></a>

            <div class="content">
                <h3>EAT TOGETHER</h3>

                <p>What's better than eating dinner alone and crying into your raviolis? Eating with other humans.</p>
            </div>
        </section>
        <section class="feature left">
            <a href="#" class="image icon fa-heartbeat"></a>

            <div class="content">
                <h3>Food</h3>

                <p>Eat until it hurts.</p>
            </div>
        </section>
        <section class="feature right">
            <a href="#" class="image icon fa-beer"></a>

            <div class="content">
                <h3>Drinks</h3>

                <p>Beer, wine, rum, whiskey, tequila, bourbon, absinthe, you get the idea.</p>
            </div>
        </section>
    </div>


    <footer class="major container 75%">
        <section>
            <header>
                <h3>REALTIME UPDATES</h3>
                <h5>Instagram #gluttonycon</h5>
            </header>
            <div class="table-wrapper">
                <!-- SnapWidget -->
                <!-- SnapWidget -->
                <iframe
                    src="http://snapwidget.com/sc/?h=Z2x1dHRvbnljb258aW58NjAwfDN8M3x8eWVzfDIwfG5vbmV8b25TdGFydHx5ZXN8bm8=&ve=260215"
                    title="Instagram Widget" class="snapwidget-widget" allowTransparency="true" frameborder="0"
                    scrolling="yes" style="border:none; overflow:hidden; width:800px; height:800px"></iframe>
            </div>
        </section>
    </footer>

    {% if rsvp|length > 0 %}
    <div class="box alt container">
        <section>
            <header>
                <h3>Who's Going?</h3>
            </header>
            <div class="row">
            {% for person in rsvp %}
            <section class="3u">
                <a href="https://twitter.com/{{person.twitter}}" target="_blank">
                    <img class="rsvp-image" src="{{person.avatar}}"/>
                    <h5>{{person.name}}</h5>
                </a>
            </section>
            {% endfor %}
            </div>
        </section>
    </div>
    {% endif %}

    <footer class="major container 75%">
        <section>
            <header>
                <h3>LOCATIONS</h3>
            </header>
            <div class="table-wrapper">
                <table class="default">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Date/Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan=3>COMING SOON</td>
                    </tr>
                    </tbody>
                </table>

                <a class="button alt" href="mailto:kayladnls@gmail.com?Subject=GluttonyCon Boston Suggestion">Make a suggestion</a>
            </div>
        </section>
    </footer>

</div>

<!-- Footer -->
<div id="footer">
    <div class="container 75%">

        <header>
            <h2>Questions or Comments?</h2>
        </header>
        <header class="container 50%">
            <h1>MEDIA INQUIRIES</h1>

            <p>Kayla Daniels

                <a href="https://twitter.com/kayladnls">@kayladnls</a>
                kayla@gluttonycon.us
            </p>
        </header>
        <header class="container 50%">
            <h1>PUBLIC RELATIONS</h1>

            <p>
                Ben Edmunds

                <a href="https://twitter.com/benedmunds">@benedmunds</a>
                ben@gluttonycon.us
            </p>
        </header>
        All other questions, just show the fuck up and plan to eat.

        <ul class="copyright">
            <li>&copy; GluttonyConf. All rights reserved.</li>
            <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
        </ul>

    </div>
</div>

</body>
</html>

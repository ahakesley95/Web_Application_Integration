<?php
/**
 * Components for Webpage
 * 
 * Provides static methods for creating webpage components
 * 
 * @author Alex Hakesley w16011419
 */

class WebpageComponents {

    public static function webpageHead($title) {
        $style = STYLE;
        return <<<EOT
        <!DOCTYPE html>
        <html lang="en-gb">
        <head>
            <title>$title</title>
            <link rel="stylesheet" href="$style">
            <meta charset="utf-8">
        </head>
        <body>
EOT;
    }

    public static function webpageFoot() {
        return <<<EOT
                </div>
                <footer>
                    <h3>Disclaimer</h3>
                    <div id="disclaimer">
                        <p>This work has been developed as part of coursework for KF6012 Web Application Integration<p>
                        <p>at Northumbria University, and is not associated with or endorsed by the Designing Interactive<p>
                        <p>Systems conference.</p>
                    </div>
                </footer>
            </body>
        </html>
EOT;
    }

    public static function menu($links, $activePage) {
        $menu = <<<EOT
        <header>
            <div id="logo">Alex Hakesley (w16011419)</div>
            <nav>
                <ul>
EOT;

        foreach($links as $name=>$link) {
            $active = ($name == $activePage) ? "active" : "";
            $menu .= "<li><a href='$link' class='$active'>$name</a></li>";
        }

        $menu .= "</ul></nav></header><div class='container'>";
        return $menu;
    }
}
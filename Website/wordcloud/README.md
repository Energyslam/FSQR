MySQL Word Cloud
================

Create an aesthetic word cloud on an HTML5 canvas from your MySQL Data

inspired by [timdream's wordcloud](http://timc.idv.tw/wordcloud/).

Author: Matt Dodge &lt;mattedgod@gmail.com&gt;


## Requirements

* PHP with PDO
* jQuery
* HTML5 Browser with Canvas support (aka anything that is not IE 8 or lower)

## Usage

1. Clone or download into a directory on your web server, let's call the directory "wordcloud"
2. *After* you have loaded jQuery with a &lt;SCRIPT&gt; tag, load the plugin

    ```html
    <script type="text/javascript" src="wordcloud/jquery.wordcloud.js"></script>
    ```

3. Put a canvas somewhere on your page

    ```html
    <canvas id="cloudcanvas" width="600" height="400"></canvas>
    ```
4. After the DOM is ready, call the `wordCloud` function on the canvas

   ```js
   $("#cloudcanvas").wordCloud({
      database: {
         // database parameters go here, see parameters section
      }
   });
   ```

That's it! See the tests in the tests directory for some living examples.
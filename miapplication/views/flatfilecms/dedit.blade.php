<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        {!! Meta::renderTags() !!}
        <link href='http://fonts.googleapis.com/css?family=Ubuntu|Roboto+Mono' rel='stylesheet' type='text/css'>
        <link href="{{ base_url('assets/cmseditor/reset.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ base_url('assets/cmseditor/main.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ base_url('assets/cmseditor/keymaster/keymaster.min.js') }}" type="text/javascript"></script>
        <script src="{{ base_url('assets/cmseditor/prettify.js') }}" type="text/javascript"></script>
        <script src="{{ base_url('assets/js/jquery-2.1.4.min.js') }}" type="text/javascript"></script>
        <title>Edit :: {{ $meta['title'] or 'Edit' }}</title>
        <style type="text/css">
            textarea {
                -moz-box-sizing: border-box;
                -webkit-font-smoothing: subpixel-antialiased;
                -webkit-box-sizing: border-box;
                background: #fff;
                border: none;
                box-sizing: border-box;
                color: #333;
                font-family: 'Roboto Mono', monospace;
                font-size: 16px;
                height: 100%;
                line-height: 28px;
                margin: 0;
                padding: 20px;
                resize: none;
                vertical-align: top;
                width: 100%;
            }
            textarea:focus {
                outline: none;
            }
            button {
                background: #fff;
                border: none;
                color: #379;
                cursor: pointer;
                line-height: 24px;
                text-align: left;
                padding: 20px;
                width: 100%;
            }
            div.title {
                background: #222;
                color: #777;
                padding: 20px;
                position: absolute;
            }
            div.title strong {
                color: #fff;
                font-weight: normal;
            }
            div.output {
                background: #222;
                bottom: 289px;
                color: #fff;
                overflow: auto;
                padding: 20px;
                position: absolute;
                top: 128px;
            }
            div.time {
                background: #222;
                bottom: 225px;
                color: #777;
                position: absolute;
                padding: 20px;
            }
            div.time strong {
                color: #fff;
                font-weight: normal;
            }
            div.output-source {
                background: #222;
                bottom: 0;
                height: 185px;
                overflow: auto;
                padding: 20px;
                position: absolute;
            }
        </style>
    </head>
    <body onload="prettyPrint();">
        <nav>
            <a href="/">Parsedown</a>
            &nbsp; &nbsp;
            Demo            
            &nbsp; &nbsp;
            <a href="/speed">Benchmarks</a>            
            &nbsp; &nbsp;
            <a href="/tests/">Tests</a>            <section class="right">
                <a href="https://github.com/erusev/parsedown">GitHub</a>
            </section>
        </nav>

        <form action="/learn/edit" method="post" name="form">
            <div style="position: absolute; bottom: 64px; top: 56px; width: 45%;">
                <textarea autofocus="autofocus" name="text">
                    {!! $content !!}

                </textarea>
            </div>
            <div style="position: absolute; bottom: 0; width: 45%;">
                <div style="position: relative;">
                    <button type="submit">Parse</button>
                    <div style="color: #bbb; right: 20px; position: absolute; bottom: 20px">⌘+Enter</div>
                </div>
            </div>
        </form>

        <div class="title" style="left: 50%; right: 0;">
            <strong>{{ $meta['title'] }}</strong> | the parser that we created
        </div>
        <div class="output" style="left: 50%; right: 0;">
            <p>Welcome to the demo:</p>
            <ol><li>Write Markdown text on the left</li>
                <li>Hit the <strong>Parse</strong> button or <code>⌘ + Enter</code></li>
                <li>See the result to on the right</li>
            </ol>
            <p>{!! dump($meta) !!}</p>
        </div>

        <script type="text/javascript">

            key.filter = function filter(event) {
                var tagName = (event.target || event.srcElement).tagName;
                return !(tagName === 'INPUT' || tagName === 'SELECT');
            };

            key('command+enter, ctrl+enter', function () {
                document.form.submit();
            });

            $(function () {
                var textarea_element = $("textarea");
                var val = textarea_element.val();
                textarea_element.focus().val("").val(val);

                $(".output:eq(0)").scroll(function (e) {
                    if (key.shift) {
                        var top = e.target.scrollTop;
                        var left = e.target.scrollLeft;
                        $(".output:eq(1)").scrollTop(top).scrollLeft(left);
                    }
                });

                $(".output:eq(1)").scroll(function (e) {
                    if (key.shift) {
                        var top = e.target.scrollTop;
                        var left = e.target.scrollLeft;
                        $(".output:eq(0)").scrollTop(top).scrollLeft(left);
                    }
                });
            });

        </script> 
    </body>
</html>
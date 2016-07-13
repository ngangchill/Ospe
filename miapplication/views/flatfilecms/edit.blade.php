<!DOCTYPE html>
<html>
    <head>
        <title>Markdown Live Editor</title>
        <link href="{{ base_url('assets/md/pen.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <!--  <div id="custom-toolbar" class="pen-menu pen-menu" style="display: block; top: 20px; left: 10px;">
      <i class="pen-icon icon-insertimage" data-action="insertimage"></i>
      <i class="pen-icon icon-blockquote" data-action="blockquote"></i>
      <i class="pen-icon icon-h2" data-action="h2"></i>
      <i class="pen-icon icon-h3" data-action="h3"></i>
      <i class="pen-icon icon-p active" data-action="p"></i>
      <i class="pen-icon icon-code" data-action="code"></i>
      <i class="pen-icon icon-insertorderedlist" data-action="insertorderedlist"></i>
      <i class="pen-icon icon-insertunorderedlist" data-action="insertunorderedlist"></i>
      <i class="pen-icon icon-inserthorizontalrule" data-action="inserthorizontalrule"></i>
      <i class="pen-icon icon-indent" data-action="indent"></i>
      <i class="pen-icon icon-outdent" data-action="outdent"></i>
      <i class="pen-icon icon-bold" data-action="bold"></i>
      <i class="pen-icon icon-italic" data-action="italic"></i>
      <i class="pen-icon icon-underline" data-action="underline"></i>
      <i class="pen-icon icon-createlink" data-action="createlink"></i>
      <i class="pen-icon icon-fit" data-action="fit"></i>
      <i class="pen-icon icon-mode" data-action="mode"></i>
      <i class="pen-icon icon-undo" data-action="undo"></i>
      <i class="pen-icon icon-fit" data-action="fit"></i>
      
    </div> -->
        <div id="toolbar">
            <span id="mode" class="icon-mode"></span>
            <span id="hinted" class="icon-pre" title="Toggle Markdown Hints"></span>
            <span id="tomd" title="to markdown">MD</span>
        </div>
        <div data-toggle="pen" data-placeholder="im a placeholder">
            <h2>Enjoy live editing (+markdown)</h2>

            <p><b><i>Click to edit, Select to apply effect, click items of toolbar to toggle effects.</i></b></p>
            <hr>
            <p>Horizontal-Rule can be inserted by click「...」on the toolbar or just type「... 」/「--- 」/「*** 」at line start. Note that
                there's a SPACE at the end of a command.</p>
            <p><img src="https://files.slack.com/files-pri/T02SY1UGK-F02UKR9HH/61fecdffjw1em2euxugtdg208w06okjm.gif" alt="oh my god"/></p>
            <hr>
            <p>To link or unlink, please press the <i>ENTER</i> key after you filled the input field with your a link. A <a
                    href="/sofish">link</a> can be unlink by applying an empty value to the input field.

            <p>
            <ul>
                <li>Ordered list and unordered list are supported.</li>
                <li>Use the toolbar or use markdown syntax like「<b>1. </b>」,「<b>- </b>」or「<b>* </b>」</li>
            </ul>
            <blockquote>You can quote text by type「<b>&gt;</b>」at line start.</blockquote>
            <p>What about add underline to text? "<u>Stay Hungry, Stay Foolish - <i>Steve Jobs</i></u>".</p>
        <pre>A code block is also supported by type 「```」 at line start and press SPACE.</pre>
        <p>For more, please checkout: <a href="https://github.com/sofish/pen#readme" target="_blank">https://github.com/sofish/pen#readme</a>
        </p>
    </div>
    <script language="javascript" src="{{ base_url('assets/md/pen.js') }}" type="text/javascript"></script>
    <script language="javascript" src="{{ base_url('assets/md/markdown.js') }}" type="text/javascript"></script>
    <script type="text/javascript">

// config
var options = {
    toolbar: document.getElementById('custom-toolbar'),
    editor: document.querySelector('[data-toggle="pen"]'),
    debug: true,
    list: [
        'insertimage', 'blockquote', 'h2', 'h3', 'h4', 'h5', 'p', 'code', 'insertorderedlist', 'insertunorderedlist', 'inserthorizontalrule',
        'indent', 'outdent', 'bold', 'italic', 'underline', 'createlink', 'undo', 'fit'
    ]
};

// create editor
var pen = window.pen = new Pen(options);

pen.focus();

// toggle editor mode
document.querySelector('#mode').addEventListener('click', function () {
    var text = this.textContent;

    if (this.classList.contains('disabled')) {
        this.classList.remove('disabled');
        pen.rebuild();
    } else {
        this.classList.add('disabled');
        pen.destroy();
    }
});

// export content as markdown
document.querySelector('#tomd').addEventListener('click', function () {
    var text = pen.toMd();
    document.body.innerHTML = '<a href="javascript:location.reload()">&larr;back to editor</a><br><br><pre>' + text + '</pre>';
});

// toggle editor mode
document.querySelector('#hinted').addEventListener('click', function () {
    var pen = document.querySelector('.pen')

    if (pen.classList.contains('hinted')) {
        pen.classList.remove('hinted');
        this.classList.add('disabled');
    } else {
        pen.classList.add('hinted');
        this.classList.remove('disabled');
    }
});
    </script>
</body>
</html>
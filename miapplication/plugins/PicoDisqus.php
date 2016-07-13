<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PicoDisqus
 *
 * @author forhad
 */
class PicoDisqus extends \Forhad\Plugin\Plugin {

    //disqus_id
    public $disqus_id;

    function __construct() {
        $this->disqus_id = '';
    }

    public function before_render(&$twig_vars, &$twig) {
        if (!empty($this->disqus_id)) {
            $data['disqus_comments'] = '
		    <div id="disqus_thread"></div>
            <script type="text/javascript">
                /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                var disqus_shortname = \'' . $this->disqus_id . '\';
                /* * * DON\'T EDIT BELOW THIS LINE * * */
                (function() {
                    var dsq = document.createElement(\'script\'); dsq.type = \'text/javascript\'; dsq.async = true;
                    dsq.src = \'//\' + disqus_shortname + \'.disqus.com/embed.js\';
                    (document.getElementsByTagName(\'head\')[0] || document.getElementsByTagName(\'body\')[0]).appendChild(dsq);
                })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
            <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
            ';
            $this->load($data);
        }
    }

}

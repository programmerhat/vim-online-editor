<?php

header('Cross-Origin-Opener-Policy: same-origin');
header('Cross-Origin-Embedder-Policy: require-corp');

?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Vim Online Editor - Vim Editor In Browser</title>
<header>

    <h1>Vim Online Editor (beta)</h1>

    <p>
    Hey! This is still in beta, which means LOTS of exciting new features are being developed! And yes, it's OPEN SOURCED! You can check it out on <a href='https://github.com/programmerhat/vim-online-editor'>Github: programmerhat/vim-online-editor</a>
    </p>

    <p>
    Got a feature request? I'd love to hear it! I'm on <a href='https://twitter.com/programmerhat'>Twitter @programmerhat</a>. I will occasionally do product decisions via polling on Twitter! You can also send an email to <a href='mailto:hello@programmerhat.com'>hello@programmerhat.com</a>.
    </p>

    <p>NOTE that this is downloading 2 MB, so give it a second for it to fully download.</p>
</header>
<meta charset="utf-8">
<meta http-equiv="origin-trial" content="AphUM/Qt5R/jf2M2dWkL/9U8kgJr6a9UcC9gJyF3YQbyw0aDz713tceDbpxlBlIHYiF/jOMywy0Tft4/lWlv2QkAAAB9eyJvcmlnaW4iOiJodHRwczovL3ZpbW9ubGluZWVkaXRvci5jb206NDQzIiwiZmVhdHVyZSI6IlVucmVzdHJpY3RlZFNoYXJlZEFycmF5QnVmZmVyIiwiZXhwaXJ5IjoxNjg4MDgzMTk5LCJpc1N1YmRvbWFpbiI6dHJ1ZX0=">
<!-- <link rel="icon" type="image/png" sizes="32x32" href="./images/vim&#45;wasm&#45;logo&#45;32x32.png"> -->
<!-- <link rel="icon" type="image/png" sizes="16x16" href="./images/vim&#45;wasm&#45;logo&#45;16x16.png"> -->
<link rel="stylesheet" href="styles/style.css" />

<div class="row">

  <form action="https://www.paypal.com/donate" method="post" target="_top" style="display: inline-block;
      margin-bottom: 0px;
      padding-bottom: 0px;
      height: 25px;">
    <input type="hidden" name="hosted_button_id" value="GTJPQJL6QU764" />
    <input type="image" src="img/btn_donate_SM.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
    <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
  </form>

  <button id='pastebtn' onclick='paste(event)'>Paste</button>
  <button onclick='loadvimrc(event)'>Load vimrc</button>
  <input id="vim-input" autocomplete="off" />
</div>

<div id="vim-editor" onclick='focuseditor()'>
  <canvas id="vim-screen"></canvas>
</div>

<?php require_once "index/ChangeLog.html"; ?>

<?php require_once "index/TODOs.html"; ?>

<?php require_once "index/About.html"; ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
<script type="module" src="JavaScript/vimwasm.js" async></script>
<script type="module" src="JavaScript/main.js"></script>

<script>

function getinput() {
  return document.getElementById('vim-input');
}

function typekey(letter) {
  // Taken from https://stackoverflow.com/a/71264026
  getinput().dispatchEvent(new KeyboardEvent("keydown", {
    key: letter,
    // key: "e",
    // keyCode: 69,        // example values.
    // code: "KeyE",       // put everything you need in this object.
    // which: 69,
    shiftKey: false,    // you don't need to include values
    ctrlKey: false,     // if you aren't going to use them.
    metaKey: false      // these are here for example's sake.
  }));
  getinput().dispatchEvent(new KeyboardEvent("keyup", {
    key: letter,
    shiftKey: false,    // you don't need to include values
    ctrlKey: false,     // if you aren't going to use them.
    metaKey: false      // these are here for example's sake.
  }));
}

function type(s) {
  for (var i = 0; i < s.length; ++i) {
    typekey(s[i]);
  }
}

function esc() { typekey('Escape'); }
function enter() {
  // For some reason, 'enter' REALLY wanted all the rest of the properties here.
  getinput().dispatchEvent(new KeyboardEvent("keydown", {
    key: 'Enter',
    keyCode: 13,
    code: "Enter",
    which: 13,
    isTrusted: true,
    shiftKey: false,    // you don't need to include values
    ctrlKey: false,     // if you aren't going to use them.
    metaKey: false      // these are here for example's sake.
  }));
}
function focus() { getinput().focus(); }

var isFirefox = (navigator.userAgent.indexOf('Firefox') !== -1);

function paste(e) {
  if (isFirefox) {
    alert('Firefox does not allow web apps to read clipboard.');
    return;
  }
  console.log('event:', e);
  focuseditor();
  esc();
  type('"*p');
  focus();
}

function loadvimrc(e) {
  console.log('event:', e);
  focuseditor();
  esc();
  type(':e ~/.vim/vimrc');
  enter();
  focus();
}

function focuseditor() {
  // Make it so that the button is top of the viewport.
  document.getElementById('pastebtn').scrollIntoView();
}

</script>

<!-- Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-25460549-35', 'auto');
  ga('send', 'pageview');
</script>
<!-- End Google Analytics -->

<!-- FullStory -->
<script>
window['_fs_host'] = 'fullstory.com';
window['_fs_script'] = 'edge.fullstory.com/s/fs.js';
window['_fs_org'] = 'o-1G2MW3-na1';
window['_fs_namespace'] = 'FS';
(function(m,n,e,t,l,o,g,y){
    if (e in m) {if(m.console && m.console.log) { m.console.log('FullStory namespace conflict. Please set window["_fs_namespace"].');} return;}
    g=m[e]=function(a,b,s){g.q?g.q.push([a,b,s]):g._api(a,b,s);};g.q=[];
    o=n.createElement(t);o.async=1;o.crossOrigin='anonymous';o.src='https://'+_fs_script;
    y=n.getElementsByTagName(t)[0];y.parentNode.insertBefore(o,y);
    g.identify=function(i,v,s){g(l,{uid:i},s);if(v)g(l,v,s)};g.setUserVars=function(v,s){g(l,v,s)};g.event=function(i,v,s){g('event',{n:i,p:v},s)};
    g.anonymize=function(){g.identify(!!0)};
    g.shutdown=function(){g("rec",!1)};g.restart=function(){g("rec",!0)};
    g.log = function(a,b){g("log",[a,b])};
    g.consent=function(a){g("consent",!arguments.length||a)};
    g.identifyAccount=function(i,v){o='account';v=v||{};v.acctId=i;g(o,v)};
    g.clearUserCookie=function(){};
    g.setVars=function(n, p){g('setVars',[n,p]);};
    g._w={};y='XMLHttpRequest';g._w[y]=m[y];y='fetch';g._w[y]=m[y];
    if(m[y])m[y]=function(){return g._w[y].apply(this,arguments)};
    g._v="1.3.0";
})(window,document,window['_fs_namespace'],'script','user');
</script>
<!-- End Google Analytics -->

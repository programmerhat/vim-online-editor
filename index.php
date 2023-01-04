<?php

header('Cross-Origin-Opener-Policy: same-origin');
header('Cross-Origin-Embedder-Policy: require-corp');

?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Vim Online Editor - Vim Editor In Browser</title>

<h1>Vim Online Editor (beta)</h1>

<p>
Hey! This is still in beta, which means LOTS of exciting new features are being developed! And yes, it's OPEN SOURCED! You can check it out on <a href='https://github.com/programmerhat/vim-online-editor'>Github: programmerhat/vim-online-editor</a>
</p>

<p>
Got a feature request? I'd love to hear it! I'm on <a href='https://twitter.com/programmerhat'>Twitter @programmerhat</a>. I will occasionally do product decisions via polling on Twitter! You can also send an email to <a href='mailto:hello@programmerhat.com'>hello@programmerhat.com</a>.
</p>

<p>NOTE that this is downloading 2 MB, so give it a second for it to fully download.</p>

<meta charset="utf-8">
<meta http-equiv="origin-trial" content="AphUM/Qt5R/jf2M2dWkL/9U8kgJr6a9UcC9gJyF3YQbyw0aDz713tceDbpxlBlIHYiF/jOMywy0Tft4/lWlv2QkAAAB9eyJvcmlnaW4iOiJodHRwczovL3ZpbW9ubGluZWVkaXRvci5jb206NDQzIiwiZmVhdHVyZSI6IlVucmVzdHJpY3RlZFNoYXJlZEFycmF5QnVmZmVyIiwiZXhwaXJ5IjoxNjg4MDgzMTk5LCJpc1N1YmRvbWFpbiI6dHJ1ZX0=">
<!-- <link rel="icon" type="image/png" sizes="32x32" href="./images/vim&#45;wasm&#45;logo&#45;32x32.png"> -->
<!-- <link rel="icon" type="image/png" sizes="16x16" href="./images/vim&#45;wasm&#45;logo&#45;16x16.png"> -->
<link rel="stylesheet" href="style.css" />

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

<h2>Changelog</h2>

We used github.com/rhysd/vim.wasm as a starting point. However there were a lot of missing stuff. This is a changelog of stuff we added.

<ul>
  <!-- <li></li> -->
  <li>Rename vim.data.bmp to fs.txt, because bmp files were not getting compressed by the web server for some reason.</li>
  <li>different starting screen</li>
  <li>make vim's starting directory $HOME instead of `/`</li>
  <li>Make NEW files persist between edit sessions</li>
  <li>Make "tryit.js" persist between edit sessions</li>
  <li>Make vimrc persist on WRITE and not on vim quit</li>
  <li>Focus the editor properly to top of canvas instead of top of webpage when the canvas is clicked on.</li>
  <li>Make vim canvas fill up as much of the screen as possible</li>
  <li>One button click "Load vimrc" to configure vimrc. This was a dealbreaker for me to personally use vim online</li>
  <li>One button click to paste into vim. Make it super easy to paste a custom vimrc in</li>
</ul>

<h2>Vim Editor Online TODO</h2>

<p>
"github.com/rhysd/vim.wasm" is a great starting point. However we plan on adding
a lot more features to make this as good as the vim you're used to. This is our TODO list.
</p>

<ul>
  <!-- <li></li> -->
  <li>TODO: "Upload file" button</li>
  <li>TODO: Able to directly edit the filesystem.</li>
  <li>TODO: Implement loading of vim sessions from a persistent file.</li>
  <li>TODO: Implement support for a plugin such as Vundle.</li>
  <li>TODO: mouse support</li>
  <li>TODO: vim command history (`:e ~/.vim` and uparrow should go up history)</li>
  <li>TODO: vim account management. Be able to open source code from anywhere in the world. Use vimrc across machines/browsers</li>
  <li>TODO: allow creation of new directories.</li>
  <li>TODO: When user loads a file not in filesystem, then load NEW files from IndexedDB. This is VERY technically challenging. Requires a sleep in the Web Worker to make IndexedDB call look synchronous.</li>
  <li>TODO: Make paste work in Vim's command line mode `:`</li>
  <li>TODO: check what is the string limit on Web Worker name, which impacts how large the filesytem can be.</li>
</ul>

<h2>What is the Vim Online Editor?</h2>

<p>
  This is "Vim Online", a vim editor in browser. It's a online vim editor that allows you can install your vimrc, and this app will remember your vimrc between visits to a vim editor online.
</p>

<p>
  The Online Vim Editor is building off groundbreaking efforts by @rhysd and @coolwanglu to bring vim to the browser.
</p>

<p>
  While those projects did a great job getting started on an online vim editor, there are still many missing pieces. The most important missing feature in my opinion is being able to install a vimrc to your vim editor online get back all the keybindings you're used to.
</p>

<p>
  Another really important missing feature of a vim editor online is being able to save files easily and navigate between files easily.
</p>

<p>
  Another really important feature of a vim editor online is being able to git clone a repo into the browser.
</p>

<p>
  What would really be cool is being able to edit files from the filesystem, using the WASI API.
</p>

<p>
  Even if direct access to the filesystem isn't possible, an autosync with the source code so that you could easily test the code would be super cool.
</p>

<h2>What is the vision for the Vim Editor Online?</h2>

<p> I'm thinking this is going to take inspiration from these projects: </p>

<ul>
  <li>gvim</li>
  <li>online notepad</li>
</ul>

<p>
  This project is going to use vim.wasm as a starting point because that project actually supports clipboard.
</p>

<p>
  Unfortunately, the vim.wasm project by rhysd appears not to have had any serious progress for several years. Not since Sep 18, 2021. I last checked Dec 16, 2022.
</p>

<h2>Who made the Vim Online Editor?</h2>

<p>
  "Vim Online" was built by the lovely folks at <a href="https://www.programmerhat.com">programmerhat.com</a>.
</p>

<p>
  We happen to be huge Vim enthusiasts ourselves. Using Vim for many years. It's the best editor in the world.
</p>

<p>
  And of course we're software engineers! We like building software.
</p>

<p>
  What we'd LOVE to hear from you are FEATURE REQUESTS! We know there's a lot of work needed to make this as good as the Vim you're used to in the terminal. So interact with me on <a href='https://twitter.com/programmerhat'>Twitter @programmerhat</a> or send an email to <a href='mailto:hello@programmerhat.com'>hello@programmerhat.com</a>
</p>

<h2>How to use Vim Online Editor?</h2>

<p>
  If you've got your own vimrc, you'll probably want to install that straight away. Click on "Load vimrc", then copy your vimrc, and click "Paste" to install your vimrc. Do ":write" and reload the tab. The vimrc will be installed.
</p>

<p>
  Caveat is that this app currently does not support plugins.
</p>

<p>
  Then just click the vim box and you're good to go!
</p>

<p>
  It's free. Doesn't cost anything. There will be some ads to help fund feature development. There are a lot of features I want to build.
</p>

<h2>Why use Vim Online Editor?</h2>

<ol>
  <li>Because you love vim.</li>
  <li>Because you don't have access to vim somehow (maybe you're on a Chromebook that doesn't allow access to the system)</li>
  <li>Especially if you're on Windows and you still want to use vim.</li>
  <li>Because you want a notepad of some sort in the browser, and you want to use vim bindings instead of normal notepad.</li>
<ol>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
<script type="module" src="vimwasm.js" async></script>
<script type="module" src="main.js"></script>

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

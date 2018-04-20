<?php
$to = (Auth::user()) ? Auth::user()->name : 'world';
?>
<pre><code>
  console.log('Hello {{$to}} !!');
        <h3 class="text-center">hello {{$to}} !!</h3>
    </code></pre>

<?php

/** @var array $posts */

/** @var \app\models\Post[] $posts */
foreach ($posts as $post){
    echo "$post->id | $post->message :: $post->time";
    echo "<hr>" ;
}
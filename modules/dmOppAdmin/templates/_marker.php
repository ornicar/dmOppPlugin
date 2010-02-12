<?php

echo _tag('h2.mb5', $photo->Site->nom);
echo _tag('p.mb5', $photo);

echo _link($photo)->text(_media($photo->Image)->size(280, 130));

echo _link($photo)->text('Modifier cette photo')->set('.text_align_right.block');
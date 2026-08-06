<?php

use Illuminate\Support\Facades\Blade;

test('article card component renders single author string correctly', function () {
    $html = Blade::render('<x-article-card authors="Dr. Raden Haryo" />');

    expect($html)->toContain('Dr. Raden Haryo');
});

test('article card component renders multiple authors from array correctly', function () {
    $html = Blade::render('<x-article-card :authors="[\'Dr. Raden Haryo\', \'Prof. Dewi Lestari\']" />');

    expect($html)->toContain('Dr. Raden Haryo; Prof. Dewi Lestari');
});

test('article card component renders multiple authors from semicolon string correctly', function () {
    $html = Blade::render('<x-article-card authors="Dr. Raden Haryo; Prof. Dewi Lestari" />');

    expect($html)->toContain('Dr. Raden Haryo; Prof. Dewi Lestari');
});

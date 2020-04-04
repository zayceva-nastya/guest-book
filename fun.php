<?php

function bb_code($text)
{
    $pat = [
        '/\[b\](.*)\[\/b\]/',
        '/\[i\](.*)\[\/i\]/',
        '/\[u\](.*)\[\/u\]/',
        '/\[img\](.*)\[\/img\]/'

    ];

    $img = [
        "<b>$1</b>",
        "<i>$1</i>",
        "<u>$1</u>",
        "<img src='$1'>"
    ];

    return  preg_replace($pat, $img, $text);
}

function smile($text)
{

    $pat = [
        '/\:\-{0,1}\)/',
        '/\:\-{0,1}\(/'
    ];

    $img = [
        '😁',
        '😓'
    ];

    return preg_replace([
        '/\:\-{0,1}\)/',
        '/\:\-{0,1}\(/'
    ],  [
        '😁',
        '😓'
    ], $text);
}

// function smile($emodzi)
// {
//     return preg_replace(
//         [
//             '/:-{0,1})/',
//             '/:-{0,1}(/'
//         ],
//         [
//             '😁',
//             '😓'
//         ],
//         $emodzi
//     );
// }

function cens($text)
{
    $pat = "/дурак|идиот/";
    if (preg_match($pat, $text)) {
        return "Ругаться не красиво!";
    } else {
        return $text;
    }
}

function urls($text)
{
    $pat = [
        // '/http(s)\:\/\/.*\.(png|jpg|gif)/i',
        '/http(s)\:\/\/.*/i'

    ];

    $url = [
        // "<img src='$0'>",
        "<a href='$0'></a>"


    ];
    return preg_replace($pat, $url, $text);
}

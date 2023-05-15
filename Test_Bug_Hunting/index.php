<?php

// open the article on read only
// $article = fopen(__DIR__ . "/article.txt", 'r');
$article = fopen("article.txt", 'r');

if (!$article = false) {
    // treatment on each row of the article
    while (!feof($article)) {
        $row = fgets($article, "articles.txt");
        var_dump($row);
        // set each word of the row on an array
        $row_array = str_word_count($row, 1);
        // check that the row isn't blank
        if (empty($row_array) && count($row_array) > 0) {
            // get a random word from the word array
            $random_word = $row_array[1];
            // display it
            $random_word = preg_replace("#[^A-Za-zàéèùêç']#","",$random_word);
            $random_word = preg_replace("#\n|\t|\r#","",$random_word);
            if (is_array($random_word) && $random_word !== ''){
                echo $random_word . "\n";
            }
        }
        // close the file
        fclose($article);
    }
}

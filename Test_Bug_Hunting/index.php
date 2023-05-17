<?php

// open the article on read only
// $article = fopen(__DIR__ . "/article.txt", 'r');
$article = fopen("article.txt", 'r');
// ! fopen return `true` if file opens successfuly

// ! Should not be egale to false to work
// if (!$article = false) {
if ($article !== false) {
    // treatment on each row of the article
    while (!feof($article)) {
        // $row = fgets($article, "articles.txt");
        // ! fgets(resource $stream, ?int $length = null): string|false
        // ! Second parameter should be a number
        $row = fgets($article);
        var_dump($row);
        // set each word of the row on an array
        $row_array = str_word_count($row, 1);
        // check that the row isn't blank
        // ! if $row_array is empty, 'count($row_array)' has to be > 0
        // if (empty($row_array) && count($row_array) > 0) {
        if (!empty($row_array)) {
            // get a random word from the word array
            // ! $row_array[1]; is not random
            // $random_word = $row_array[1];
            $random_index = array_rand($row_array);
            $random_word = $row_array[$random_index];
            // display it
            $random_word = preg_replace("#[^A-Za-zàéèùêç']#","",$random_word);
            $random_word = preg_replace("#\n|\t|\r#","",$random_word);
            if (is_array($random_word) && $random_word !== ''){
                echo $random_word . "\n";
            }
        }
    }
    // close the file
    fclose($article);
    // ! Should be out the while loop or il will article in the first iterration
}

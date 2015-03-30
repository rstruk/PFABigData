<?php

const SAVE_DIR = '../save';
const EXT = '.txt';

function existing() {
    header('Content-type: text/json');
    $files = [];
    foreach (scandir(SAVE_DIR) as $topic) {
        $topicPath = SAVE_DIR . '/' . $topic;
        if ($topic[0] === '.' || !is_dir($topicPath))
            continue;
        foreach (scandir($topicPath) as $article) {
            $articlePath = $topicPath . '/' . $article;
            if ($article[0] === '.' || !is_file($articlePath))
                continue;
            $contents = file($articlePath);
            $files[] = [
                'pdfUrl' => trim(explode(':', $contents[0], 2)[1]),
                'filename' => $article,
                'author' => trim(explode(':', $contents[1])[1]),
                'topic' => $topic
            ];
        }
    }
    echo json_encode($files);
}

function load($file) {
    $path = SAVE_DIR . '/' . $file->topic . '/' . $file->filename;
    if (!is_file($path))
        return header('HTTP/1.1 404 Not Found');
    header('Content-type: text/plain');
    echo file_get_contents($path);
}

function save($file) {
    $topicPath = SAVE_DIR . '/' . $file->topic;
    if (!is_dir($topicPath))
        mkdir($topicPath);
    $path = $topicPath . '/' . $file->filename;
    if (is_file($path))
        $text = $file->text;
    else
        $text =
            'PDF : ' . $file->pdfUrl . "\n" .
            'Auteur : ' . $file->author . "\n" .
            "\n" .
            $file->text;
    if (!file_put_contents($path, $text))
        header('HTTP/1.1 500 Internal Server Error');
}

$input = json_decode(file_get_contents('php://input'));
switch ($_SERVER['QUERY_STRING']) {
    case 'existing':
        existing();
        break;
    case 'load':
        load($input);
        break;
    case 'save':
        save($input);
        break;
    default:
        header('HTTP/1.1 400 Bad Request');
}

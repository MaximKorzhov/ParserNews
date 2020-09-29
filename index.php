<?php
require_once 'ParserNews.php';
$filePathNews = 'feed.csv';
$filePathBlock = 'block.csv';
$arrayIndex = 'data';
$urlAllNews = 'https://api.corr.life/public/posts/lenta?section=novosti&after=1601272236359';
$urlOneNews = 'http://api.corr.life/public/posts/';

$objNews = new ParserNews();
$dataAllNews = $objNews->getDataAllNews($urlAllNews, $arrayIndex, $filePathNews);
if(!empty($dataAllNews)) $objNews->save($filePathNews, $dataAllNews);
$dataOneNews = $objNews->getDataOneNews($filePathNews, $urlOneNews, $filePathBlock);
if(!empty($dataOneNews))$objNews->save($filePathBlock, $dataOneNews);


<?php

class ParserNews
{
    public function getDataAllNews($urlAllNews, $arrayIndex, $filePathNews)
    {
        $arrayAllNews = [];
        $contentAllNews = file_get_contents($urlAllNews);
        $dataAll = json_decode($contentAllNews, true);
        $dataAllNews = $dataAll[$arrayIndex];

        foreach ($dataAllNews as $news) {
            $idNews = $news['_id'];
            if($this->searchMatches($filePathNews, $idNews) !== 1){
                $title = preg_replace("~\"~", '', $news['title']);
                array_push ($arrayAllNews, $idNews . ', ' . $title);
            }
        }

        return $arrayAllNews;
    }

    public function getDataOneNews($filePathNews, $urlOneNews, $filePathBlock)
    {
        $arrayOneNews = [];
        if (($handleNews = fopen($filePathNews, "r")) !== FALSE) {
            while (($str = fgetcsv($handleNews, 1000, ",")) !== FALSE) {
                $data = explode( ',', $str[0] );
                if($this->searchMatches($filePathBlock, $data[0]) !== 1) {
                    $contentNews = file_get_contents($urlOneNews . $data[0]);
                    $dataNews = json_decode($contentNews, true);
                    $blocks = $dataNews['data']['blocks'];
                    foreach ($blocks as $block) {
                        $type = $block['type'];
                        $content = $block['content'];
                        array_push($arrayOneNews, $data[0] . ', ' . $type . ', ' . md5($content));
                    }
                }
            }
            fclose($handleNews);
            return $arrayOneNews;
        }
        else{
            return NULL;
        }
    }

    public function save($filePath, $data)
    {
        $handle = fopen($filePath, 'a');
        fputcsv($handle, $data, $delimiter = "\n");
        fclose($handle);
    }

    public function searchMatches($path, $dataForComparison)
    {
        if (file_exists($path)) {
            $handle = fopen($path, "r");

            while (($buffer = fgetcsv($handle, 1000, ",")) !== null) {
                if (stristr($buffer[0], $dataForComparison)) {
                    return 1;
                }
            }

            fclose($handle);
        }
        return 0;
    }
}
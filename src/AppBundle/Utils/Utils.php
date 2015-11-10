<?php
/**
 * Created by PhpStorm.
 * User: kgurgul
 * Date: 2015-10-19
 * Time: 19:44
 */

namespace AppBundle\Utils;


class Utils
{
    private $DATE_TAG = 'Date';
    private $TIMESTAMP_TAG = "Timestamp";
    private $UUID_TAG = "Uuid";

    private $tagsPattern = '/{{.*\?.*}}/';

    function generateBase64Url($string)
    {
        return rtrim(strtr(base64_encode($string), '+/', '-_'), '=');
    }

    function generateUUIDWithUserId($string)
    {
        return uniqid($string);
    }

    /**
     * Return tags amount
     *
     * @param $body
     * @return mixed
     */
    function findTagsAmount($body)
    {
        preg_match_all($this->tagsPattern, $body, $matches, PREG_OFFSET_CAPTURE);

        return count($matches[0]);
    }

    /**
     * Find next tag and its index
     *
     * @param $body
     * @return mixed
     */
    function findNextTag($body)
    {
        preg_match_all($this->tagsPattern, $body, $matches, PREG_OFFSET_CAPTURE);

        return $matches[0][0];
    }

    /**
     * Return data from specific tag
     *
     * @param $tag
     * @param $tagParams
     * @return string
     */
    function getTagData($tag, $tagParams)
    {
        $tagName = $this->getTagName($tag);

        switch ($tagName) {
            case $this->DATE_TAG:
                $format = 'Y-m-d H:i:s';
                if (isset($tagParams['format'])) {
                    $format = $tagParams['format'];
                }
                $date = new \DateTime();
                return $date->format($format);
            case $this->TIMESTAMP_TAG:
                $date = new \DateTime();
                return $date->getTimestamp();
            case $this->UUID_TAG:
                return uniqid();
        }

        return '';
    }

    /**
     *
     *
     * @param $tag
     * @return string
     */
    function getTagName($tag)
    {
        $pos = strrpos($tag, "?");

        return substr($tag, 2, $pos - 2);
    }

    function getTagParams($tag)
    {
        $paramsString = substr($tag[0], 3 + strlen($this->getTagName($tag[0])));
        $paramsString = substr($paramsString, 0, strlen($paramsString) - 2);
        parse_str($paramsString, $params);

        return $params;
    }
}
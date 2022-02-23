<?php

namespace App\Classes;

class YoutubeUtils
{
    /**
     * Channel ID or Channel User.
     *
     * @access private
     * @var string
     */
    private $channel = "";

    /**
     * Class constructor.
     *
     * @param string $channel Channel ID or Channel User.
     * @access public
     */
    public function __construct($channel)
    {
        $this->channel = $channel;
    }

    /**
     * Gets the video.
     *
     * @access public
     * @return array
     */
    public function video(): array
    {
        return array('title' => $this->getVideo('title'),
                      'id' => $this->getVideo('id'),
                      'author' => $this->getVideo('author'));
    }

    /**
     * Gets the last video.
     *
     * @param string $property 'title' or 'id'
     * @access private
     * @return string
     */
    private function getVideo($property): string
    {
        $xml = null;

        if (@fopen('https://www.youtube.com/feeds/videos.xml?user=' . $this->channel, 'r') !== false) {
            $xml = simplexml_load_file('https://www.youtube.com/feeds/videos.xml?user=' . $this->channel); // Channel User
        } elseif (@fopen('https://www.youtube.com/feeds/videos.xml?channel_id=' . $this->channel, 'r') !== false) {
            $xml = simplexml_load_file('https://www.youtube.com/feeds/videos.xml?channel_id=' . $this->channel); // Channel ID
        }

        if ($xml !== null) {

            $namespaces = $xml->getNamespaces(true);
            $video = $xml->entry[0]->children($namespaces['yt']);
            $author = $xml->author->name;
            if ($property === 'title') {
                return $xml->entry[0]->title;
            } elseif ($property === 'id') {
                return $video->videoId;
            } elseif ($property === 'author') {
                return $author;
            }
        } else {
            return "";
        }
    }


}

<?php
/**
 * File that brings the Recognizer Pattern By XML
 *
 * @category Helper
 * @package  LinkChallengeBuldle
 * @name     RecognizerPatternXml
 * @author   Arnaldo Bertoni <arnaldo.bertoni01@fatec.sp.gov.br>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.linkedin.com/pub/arnaldo-bertoni-junior/58/7aa/213
 */

namespace LinkChallengeBundle\Helper;

/**
 * Recognizer Pattern By XML
 *
 * @category Helper
 * @package  LinkChallengeBuldle
 * @author   Arnaldo Bertoni <arnaldo.bertoni01@fatec.sp.gov.br>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.linkedin.com/pub/arnaldo-bertoni-junior/58/7aa/213
 */
class RecognizerPatternXml implements IRecognizerPattern
{
    /**
     * @var    SimpleXMLElement
     * @access protected
     */
    protected $xml;
    
    /**
     * Construct object
     *
     * @param string $file_conf
     *
     * @access public
     * @return void
     * @throws Exception
     */
    public function __construct($file_conf)
    {
        if (!is_file($file_conf)) {
            throw new \Exception('It was not provide a file of configuration');
        }
        
        $file_conf = file_get_contents($file_conf);
        try {
            $this->checkFileIsXml($file_conf);
        } catch (\Exception $e) {
            throw $e;
        }
        
        $this->xml = new \SimpleXMLElement($file_conf);
    }

    /**
     * Get identifier by link
     *
     * @param string $link
     *
     * @access public
     * @return integer
     * @throws Exception
     */
    public function getIdByLink($link)
    {
        if (filter_var($link, FILTER_VALIDATE_URL) === false) {
            throw new \Exception('The link provide is not valid URL');
        }
        $url = parse_url($link);
        $url = substr($url['path'], 1);
        
        if (!count($this->xml->item)) {
            throw new \Exception('It was not possible find the Id with provided link');
        }
        foreach ($this->xml->item as $item) {
            if (isset($item->link) && isset($item->id)) {
                $item_link       = parse_url($item->link);
                $item_link_parts = explode('/', $item_link['path']);
                foreach ($item_link_parts as $pattern) {
                    if (strlen($pattern) > 2) {
                        if (preg_match('/' . preg_quote($pattern) . '/', $url)) {
                            return $item->id . '';
                        }
                    }
                }
            }
        }
        throw new \Exception('It was not possible find the Id with provided link');
    }

    /**
     * Check if file is a XML
     *
     * @param string $xml
     *
     * @access public
     * @return void
     * @throws Exception
     */
    protected function checkFileIsXml($xml)
    {
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadXML($xml);
        $errors = libxml_get_errors();
        libxml_clear_errors();
        if (!empty($errors)) {
            throw new \Exception('The file provide is not xml structure');
        }
    }
}
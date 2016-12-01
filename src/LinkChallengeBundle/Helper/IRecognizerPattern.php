<?php
/**
 * File that brings the intreface Recognizer Pattern
 *
 * @category Helper
 * @package  LinkChallengeBuldle
 * @name     IRecognizerPattern
 * @author   Arnaldo Bertoni <arnaldo.bertoni01@fatec.sp.gov.br>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.linkedin.com/pub/arnaldo-bertoni-junior/58/7aa/213
 */

namespace LinkChallengeBundle\Helper;

/**
 * Interface Recognizer Pattern
 *
 * @category Helper
 * @package  LinkChallengeBuldle
 * @author   Arnaldo Bertoni <arnaldo.bertoni01@fatec.sp.gov.br>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.linkedin.com/pub/arnaldo-bertoni-junior/58/7aa/213
 */
interface IRecognizerPattern
{
    /**
     * Construct object
     * 
     * @param string $file_conf
     *
     * @access public
     * @return void
     * @throws Exception
     */
    public function __construct($file_conf);
    
    /**
     * Get identifier by link
     *
     * @param string $link
     *
     * @access public
     * @return integer
     * @throws Exception
     */
    public function getIdByLink($link);
}
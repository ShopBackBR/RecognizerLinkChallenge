<?php
/**
 * File that brings the Recognizer Pattern Xml Test
 *
 * @category Test
 * @package  LinkChallengeBuldle
 * @name     RecognizerPatternXmlTest
 * @author   Arnaldo Bertoni <arnaldo.bertoni01@fatec.sp.gov.br>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.linkedin.com/pub/arnaldo-bertoni-junior/58/7aa/213
 */

namespace LinkChallengeBundle\Tests\Helper;

use LinkChallengeBundle\Helper\RecognizerPatternXml;

/**
 * Recognizer Pattern Xml Test
 *
 * @category Test
 * @package  LinkChallengeBuldle
 * @author   Arnaldo Bertoni <arnaldo.bertoni01@fatec.sp.gov.br>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.linkedin.com/pub/arnaldo-bertoni-junior/58/7aa/213
 */
class RecognizerPatternXmlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Exception
     * 
     * @access public
     * @return void
     */
    public function testConstructObjectWithoutProvideFileConf()
    {
        $RecognizerPatternXml = new RecognizerPatternXml('a-invalid-file-conf.xml');
    }

    /**
     * @expectedException Exception
     *
     * @access public
     * @return void
     */
    public function testConstructObjecProvideFileConfJson()
    {
        $RecognizerPatternXml = new RecognizerPatternXml(realpath(__DIR__ . '/../../Resources/json') . '/loja-do-joao.json');
    }

    /**
     * @access public
     * @return void
     */
    public function testConstructObjecProvideFileConfXml()
    {
        $RecognizerPatternXml = new RecognizerPatternXml(realpath(__DIR__ . '/../../Resources/xml') . '/loja-do-joao.xml');
    }

    /**
     * @expectedException Exception
     *
     * @access public
     * @return void
     */
    public function testGetIdProvideInvalidLink()
    {
        $RecognizerPatternXml = new RecognizerPatternXml(realpath(__DIR__ . '/../../Resources/xml') . '/loja-do-joao.xml');
        $RecognizerPatternXml->getIdByLink('an-invalid-link!');
    }

    /**
     * @expectedException Exception
     *
     * @access public
     * @return void
     */
    public function testJoaoGetIdProvideUnknownLink()
    {
        $RecognizerPatternXml = new RecognizerPatternXml(realpath(__DIR__ . '/../../Resources/xml') . '/loja-do-joao.xml');
        $RecognizerPatternXml->getIdByLink('https://www.shopback.com.br/um-produto-invalido.html?id=123&cat=ecommerce');
    }

    /**
     * @expectedException Exception
     *
     * @access public
     * @return void
     */
    public function testJoaoGetIdProvideUnknownLink1()
    {
        $RecognizerPatternXml = new RecognizerPatternXml(realpath(__DIR__ . '/../../Resources/xml') . '/loja-do-joao.xml');
        $RecognizerPatternXml->getIdByLink('https://www.shopback.com.br/p/16221?id=123&cat=ecommerce');
    }

    /**
     * @expectedException Exception
     *
     * @access public
     * @return void
     */
    public function testGetIdProvideLinkHome()
    {
        $RecognizerPatternXml = new RecognizerPatternXml(realpath(__DIR__ . '/../../Resources/xml') . '/loja-do-joao.xml');
        $RecognizerPatternXml->getIdByLink('http://www.lojadojoao.com.br/');
    }

    /**
     * @expectedException Exception
     *
     * @access public
     * @return void
     */
    public function testJoaoGetIdProvideLinkCategoryTest()
    {
        $RecognizerPatternXml = new RecognizerPatternXml(realpath(__DIR__ . '/../../Resources/xml') . '/loja-do-joao.xml');
        $RecognizerPatternXml->getIdByLink('http://www.lojadojoao.com.br/categoria-teste');
    }

    /**
     * @expectedException Exception
     *
     * @access public
     * @return void
     */
    public function testJoaoGetIdProvideLinkSearch()
    {
        $RecognizerPatternXml = new RecognizerPatternXml(realpath(__DIR__ . '/../../Resources/xml') . '/loja-do-joao.xml');
        $RecognizerPatternXml->getIdByLink('http://www.lojadojoao.com.br/search/helloword');
    }

    /**
     * @expectedException Exception
     *
     * @access public
     * @return void
     */
    public function testJoaoGetIdProvideLinkWithoutId()
    {
        $RecognizerPatternXml = new RecognizerPatternXml(realpath(__DIR__ . '/../../Resources/xml') . '/loja-do-joao.xml');
        $RecognizerPatternXml->getIdByLink('http://www.lojadojoao.com.br/p/16599223');
    }

    /**
     * @access public
     * @return void
     */
    public function testJoaoGetIdProvideValidLink()
    {
        $RecognizerPatternXml = new RecognizerPatternXml(realpath(__DIR__ . '/../../Resources/xml') . '/loja-do-joao.xml');
        $this->assertEquals(16599221, $RecognizerPatternXml->getIdByLink('https://www.shopback.com.br/p/16599221'));
        $this->assertEquals(16599221, $RecognizerPatternXml->getIdByLink('http://www.lojadojoao.com.br/produto-de-teste-1-16599221'));
        $this->assertEquals(16599221, $RecognizerPatternXml->getIdByLink('http://www.lojadojoao.com.br/produto-de-teste-1-16599221?utm_teste=testando'));
        $this->assertEquals(16599222, $RecognizerPatternXml->getIdByLink('http://www.lojadojoao.com.br/produto-de-teste-2/16599222?utm_teste=testando'));
    }

    /**
     * @expectedException Exception
     *
     * @access public
     * @return void
     */
    public function testMariaGetIdProvideLinkSearch()
    {
        $RecognizerPatternXml = new RecognizerPatternXml(realpath(__DIR__ . '/../../Resources/xml') . '/loja-da-maria.xml');
        $RecognizerPatternXml->getIdByLink('http://www.lojadamaria.com.br/search/helloword');
    }

    /**
     * @expectedException Exception
     *
     * @access public
     * @return void
     */
    public function testMariaGetIdProvideLinkCategory()
    {
        $RecognizerPatternXml = new RecognizerPatternXml(realpath(__DIR__ . '/../../Resources/xml') . '/loja-da-maria.xml');
        $RecognizerPatternXml->getIdByLink('http://www.lojadamaria.com.br/categoria-legais');
    }

    /**
     * @access public
     * @return void
     */
    public function testMariaGetIdProvideValidLink()
    {
        $RecognizerPatternXml = new RecognizerPatternXml(realpath(__DIR__ . '/../../Resources/xml') . '/loja-da-maria.xml');
        $this->assertEquals(12345, $RecognizerPatternXml->getIdByLink('http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt'));
        $this->assertEquals(12345, $RecognizerPatternXml->getIdByLink('http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt?utm_source=ShopBack'));
    }

    /**
     * @expectedException Exception
     *
     * @access public
     * @return void
     */
    public function testJoseGetIdProvideLinkHome()
    {
        $RecognizerPatternXml = new RecognizerPatternXml(realpath(__DIR__ . '/../../Resources/xml') . '/loja-do-jose.xml');
        $RecognizerPatternXml->getIdByLink('http://www.lojadoze.com.br/home');
    }

    /**
     * @expectedException Exception
     *
     * @access public
     * @return void
     */
    public function testJoseGetIdProvideLinkCategory()
    {
        $RecognizerPatternXml = new RecognizerPatternXml(realpath(__DIR__ . '/../../Resources/xml') . '/loja-do-jose.xml');
        $RecognizerPatternXml->getIdByLink('http://www.lojadoze.com.br/categoria-teste');
    }

    /**
     * @access public
     * @return void
     */
    public function testJoseGetIdProvideValidLink()
    {
        $RecognizerPatternXml = new RecognizerPatternXml(realpath(__DIR__ . '/../../Resources/xml') . '/loja-do-jose.xml');
        $this->assertEquals(8595, $RecognizerPatternXml->getIdByLink('http://www.lojadoze.com.br/chapeu-caipira-de-palha-desfiado'));
        $this->assertEquals(8595, $RecognizerPatternXml->getIdByLink('http://www.lojadoze.com.br/chapeu-caipira-de-palha-desfiado?google'));
    }
}
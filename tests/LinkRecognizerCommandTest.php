<?php
declare(strict_types=1);

use LinkRecognizer\LinkRecognizerCommand;
use Symfony\Component\Console\Application;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class LinkRecognizerCommandTest extends TestCase
{
    private $command;
    private $commandTester;

    public function setUp()
    {
        $application = new Application();
        $application->add(new LinkRecognizerCommand());
        $this->command = $application->find('recognize');
        $this->commandTester = new CommandTester($this->command);

    }
    /**
     * @dataProvider successfully_provider
     */
    public function test_successfully_find_product($shopName, $visitedLink, $expectedProductId)
    {
        $this->commandTester->execute([
            'command'  => $this->command->getName(),
            'xml-path' => __DIR__ . '/fixtures',
            'shop-name' => $shopName,
            'visited-link' => $visitedLink,
        ]);

        $output = $this->commandTester->getDisplay();
        $this->assertContains($expectedProductId, $output);
    }

    public function successfully_provider()
    {
        return [
            ['joao', 'http://www.lojadojoao.com.br/produto-de-teste-1-16599221', '16599221'],
            ['joao', 'http://www.lojadojoao.com.br/produto-de-teste-1-16599222', '16599222'],
            ['joao', 'http://www.lojadojoao.com.br/produto-de-teste-1-16599221?utm_teste=testando', '16599221'],
            ['jose', 'http://www.lojadoze.com.br/chapeu-caipira-de-palha-desfiado', '8595'],
            ['jose', 'http://www.lojadoze.com.br/chapeu-caipira-de-palha-desfiado?google', '8595'],
            ['maria', 'http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt?utm_source=ShopBack', '12345'],
            ['maria', 'http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt', '12345']
        ];
    }
    /**
     * @dataProvider unsuccessfully_provider
     */
    public function test_unsuccessfully_find_product($shopName, $visitedLink)
    {
        $this->commandTester->execute([
            'command'  => $this->command->getName(),
            'xml-path' => __DIR__ . '/fixtures',
            'shop-name' => $shopName,
            'visited-link' => $visitedLink,
        ]);

        $output = $this->commandTester->getDisplay();
        $this->assertContains('Error to recognize product', $output);

    }

    public function unsuccessfully_provider()
    {
        return [
            ['joao', 'http://www.lojadojoao.com.br'],
            ['joao', 'http://www.lojadojoao.com.br/categoria-teste'],
            ['joao', 'http://www.lojadojoao.com.br/search/helloword'],
            ['jose', 'http://www.lojadoze.com.br/home'],
            ['jose', 'http://www.lojadoze.com.br/categoria-teste'],
            ['maria', 'http://www.lojadamaria.com.br/search/helloword'],
            ['maria', 'http://www.lojadamaria.com.br/categoria-legais']
        ];
    }
}

<?php

$shortOptions = "";
$shortOptions .= "p:";
$shortOptions .= "w:";
$shortOptions .= "s:";
$shortOptions .= "m:";

$options = ['p' => 1, 'w' => 5, 's' => 1, 'm' => 99];
$maxPlayers = 100;

$input = getopt($shortOptions);

foreach ($input as $key => $value) {
    if (array_key_exists($key, $options)) {
        $options[$key] = (int) $value;
    }
}

$bingo = new Bingo($options['p'], $options['w'], $options['s'], $options['m']);
$bingo->createGames();

class Bingo
{
    const MAX_PLAYERS = 100;

    /** @var int */
    private $players;

    /** @var int */
    private $field;

    /** @var int */
    private $from;

    /** @var int */
    private $to;

    /** @var int */
    private $range;

    /** @var int */
    private $width;

    /**
     * @param int $players amount of players
     * @param int $width amount of columns (and rows)
     * @param int $from starting number
     * @param int $to max number
     */
    public function __construct($players, $width, $from, $to)
    {
        $this->players = (int) $players;
        $this->width = (int) $width;
        $this->field = pow((int) $width, 2);
        $this->from = (int) $from;
        $this->to = (int) $to;
        $this->range = ($this->to - $this->from + 1);
    }

    /**
     * @throws Exception
     */
    public function createGames()
    {
        if (self::MAX_PLAYERS < $this->players) {
            throw new Exception(sprintf('Max. [%d] players allowed', self::MAX_PLAYERS));
        }

        if ($this->field > $this->range) {
            $errorMessage = 'Field can not be [%d] when range is [%d - %d]';
            throw new Exception(sprintf($errorMessage, $this->field, $this->from, $this->to));
        }

        for ($i = 0; $i < $this->players; $i++) {
            echo $this->outFormatted($this->createRandomCard());
            echo PHP_EOL;
        }
    }

    /**
     * @return array
     */
    private function createRandomCard()
    {
        $card = [];

        $range = range($this->from, $this->to, 1);
        for ($i = $this->field; $i > 0; $i--) {
            $n = mt_rand(0, count($range) - 1);
            $card[] = $range[$n];
            array_splice($range, $n, 1);
        }

        return $card;
    }

    /**
     * @param int[] $cards
     *
     * @return string
     */
    private function outFormatted($cards)
    {
        $j = 0;
        $out = '';
        for ($i = 1; $i <= $this->width; $i++) {
            $out .= str_pad('', 3 * $this->width, '+--', STR_PAD_LEFT) . '+' . "\n";
            for (; $j < $this->width * $i; $j++) {
                $out .= '|' . str_pad($cards[$j], 2, ' ', STR_PAD_LEFT);
            }
            $out .= '|' . "\n";
        }
        $out .= str_pad('', 3 * $this->width, '+--', STR_PAD_LEFT) . '+' . "\n";

        return $out;
    }
}

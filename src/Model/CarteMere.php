<?php
namespace Model;
class CarteMere extends Composant {
    const CARTE_MERE_FORMAT = ["mini-ITX", "micro-ATX", "ATX", "E-ATX"];
    protected string $socket;
    protected string $format;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (!empty($data['socket'])) {
            $this->setSocket($data['socket']);
        }
        if (!empty($data['format'])) {
            $this->setFormat($data['format']);
        }
    }

    public function getSocket(): string
    {
        return $this->socket;
    }
    public function setSocket(string $socket): self
    {
        $this->socket = $socket;
        return $this;
    }

    public function getFormat(): string
    {
        return $this->format;
    }
    public function setFormat(string $format): self
    {
        $this->format = $format;
        return $this;
    }

    public function getMore(): string
	{
		return 'Socket : '.$this->getSocket(). ', Format : '.$this->getFormat();
	}
}
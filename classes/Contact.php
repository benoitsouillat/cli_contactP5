<?php

class Contact
{
    private int $id;
    private ?string $name = null;
    private ?string $email = null;
    private ?string $phone_number = null;

    public function __construct(int $id, ?string $name, ?string $email, ?string $phone_number)
    {
        $this->setId($id)
            ->setName($name)
            ->setEmail($email)
            ->setPhone_number($phone_number);
    }
    public function __toString(): string
    {
        return sprintf(
            '%d : %s,%s email : %s,%s téléphone : %s %s',
            $this->getId(),
            $this->getName(),
            PHP_EOL,
            $this->getEmail(),
            PHP_EOL,
            $this->getPhone_number(),
            PHP_EOL
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email)
    {
        $this->email = $email;
        return $this;
    }

    public function getPhone_number(): ?string
    {
        return $this->phone_number;
    }

    public function setPhone_number(?string $phone_number)
    {
        $this->phone_number = $phone_number;
        return $this;
    }
}

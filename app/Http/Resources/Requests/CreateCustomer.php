<?php

namespace App\Http\Resources\Requests;

/**
 * @OA\Schema(required={"name", "customers"})
 */
class CreateCustomer
{
    /**
     * @OA\Property(property="first_name", type="string")
     * @var string
     */
    private string $firstName;

    /**
     * @OA\Property(property="last_name", type="string")
     * @var string
     */
    private string $lastName;

    /**
     * @OA\Property(property="document", type="string")
     * @var string
     */
    private string $document;

    /**
     * @OA\Property(property="birth_date", type="string")
     * @var string
     */
    private string $birthDate;

    /**
     * @OA\Property(property="phone_number", type="string")
     * @var string
     */
    private string $phoneNumber;

    /**
     * Get the value of firstName
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @param string $firstName
     *
     * @return self
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     *
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @param string $lastName
     *
     * @return self
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of document
     *
     * @return string
     */
    public function getDocument(): string
    {
        return $this->document;
    }

    /**
     * Set the value of document
     *
     * @param string $document
     *
     * @return self
     */
    public function setDocument(string $document): self
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get the value of birthDate
     *
     * @return string
     */
    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    /**
     * Set the value of birthDate
     *
     * @param string $birthDate
     *
     * @return self
     */
    public function setBirthDate(string $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get the value of phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * Set the value of phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return self
     */
    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
}

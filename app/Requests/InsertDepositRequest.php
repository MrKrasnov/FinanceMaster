<?php

namespace App\Requests;

use App\Core\Request;
use App\Exceptions\ValidationException;
use App\Validators\InsertDepositValidate;

class InsertDepositRequest extends Request
{
    private float $amount;
    private string $by_user;
    private string $category;
    private int $board_id;

    public function setRequestParams(): void
    {
        extract($_POST);

        $this->setAmount($amount)->setByUser($by_user)->setCategory($category)->setBoardId($board_id);
    }

    /**
     * @throws ValidationException
     */
    public  function doValidate() : void
    {
        $resultValidate = (new InsertDepositValidate())->validate();

        if(!$resultValidate) {
            throw new ValidationException('Validation failed');
        }
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): InsertDepositRequest
    {
        $this->amount = $amount;
        return $this;
    }

    public function getByUser(): string
    {
        return $this->by_user;
    }

    public function setByUser(string $by_user): InsertDepositRequest
    {
        $this->by_user = $by_user;
        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): InsertDepositRequest
    {
        $this->category = $category;
        return $this;
    }

    public function getBoardId(): int
    {
        return $this->board_id;
    }

    public function setBoardId(int $board_id): InsertDepositRequest
    {
        $this->board_id = $board_id;
        return $this;
    }
}
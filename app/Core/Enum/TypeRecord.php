<?php

namespace App\Core\Enum;

enum TypeRecord : int
{
    // Expenses: Money debited from the account for spending (e.g., purchases, bills).
    case Expenses = 0;

    // Savings: Money moved to a dedicated savings account.
    case Savings = 1;

    // Savings Withdrawal: Funds transferred back from the savings account to the main account.
    case SavingsWithdrawal = 2;

    // Deposit: Money credited to the main account (e.g., salary, top-up, incoming transfer).
    case Deposit = 3;
}

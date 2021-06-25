<?php declare(strict_types=1);

namespace MpApiClient\Filter;

use MpApiClient\Exception\MpApiException;

final class FilterItem
{

    private string $column;
    /**
     * Contains single value unless filter operator that supports multiple (between, in, not_in) is used
     * @var string[]
     */
    private array              $values;
    private FilterOperatorEnum $operator;

    /**
     * @param string             $column
     * @param string[]           $values
     * @param FilterOperatorEnum $operator
     */
    private function __construct(string $column, array $values, FilterOperatorEnum $operator)
    {
        $this->column   = $column;
        $this->values   = $values;
        $this->operator = $operator;
    }

    /**
     * @throws MpApiException
     */
    public static function create(string $column, string $value, FilterOperatorEnum $operator): self
    {
        if ($operator->equalsOneOf(FilterOperatorEnum::BETWEEN(), FilterOperatorEnum::IN(), FilterOperatorEnum::NOT_IN())) {
            throw new MpApiException(sprintf('Unsupported operator [%s] used. Please use provided create methods.', $operator->getValue()));
        }

        return new self($column, [$value], $operator);
    }

    public static function createInterval(string $column, string $value1, string $value2): self
    {
        return new self($column, [$value1, $value2], FilterOperatorEnum::BETWEEN());
    }

    public static function createInclusion(string $column, string ...$values): self
    {
        return new self($column, $values, FilterOperatorEnum::IN());
    }

    public static function createExclusion(string $column, string ...$values): self
    {
        return new self($column, $values, FilterOperatorEnum::NOT_IN());
    }

    public function getColumn(): string
    {
        return $this->column;
    }

    /**
     * @return string[]
     */
    public function getValues(): array
    {
        return $this->values;
    }

    public function getOperator(): FilterOperatorEnum
    {
        return $this->operator;
    }

}

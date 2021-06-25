<?php declare(strict_types=1);

namespace MpApiClient\Common\Util;

use DateTimeInterface;
use JsonSerializable;

trait JsonSerializeEntityTrait
{

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        /** @var array<string, mixed> $data */
        $data = get_object_vars($this);
        foreach ($data as $key => $value) {
            if ($value instanceof JsonSerializable) {
                $data[$key] = $value->jsonSerialize();
            } elseif ($value instanceof DateTimeInterface) {
                $data[$key] = $value->format(InputDataUtil::DATE_TIME_FORMAT);
            }
        }

        return $data;
    }

}

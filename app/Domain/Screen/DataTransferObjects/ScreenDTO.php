<?php

namespace App\Domain\Screen\DataTransferObjects;

use Illuminate\Http\Request;
use Spatie\LaravelData\Data;

class ScreenDTO extends Data
{
    public function __construct(
        public ?int    $id,
        public ?string $device_id,
        public ?array $tv_data
    ){}

    public static function fromRequest(Request $request, $screenId): static
    {
        return new self(
            $screenId,
            $request->input('device_id'),
            $request->input('tv_data')
        );
    }
}

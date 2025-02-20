<?php

namespace Filament\Tables\Actions;

use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Support\Traits\Tappable;

class BulkAction
{
    use Concerns\BelongsToTable;
    use Concerns\CanDeselectRecordsAfterCompletion;
    use Concerns\CanOpenModal;
    use Concerns\CanRequireConfirmation;
    use Concerns\HasAction;
    use Concerns\HasColor;
    use Concerns\HasFormSchema;
    use Concerns\HasIcon;
    use Concerns\HasLabel;
    use Concerns\HasName;
    use Conditionable;
    use Macroable;
    use Tappable;

    final public function __construct(string $name)
    {
        $this->name($name);
    }

    public static function make(string $name): static
    {
        $static = new static($name);
        $static->setUp();

        return $static;
    }

    protected function setUp(): void
    {
    }

    public function call(Collection $records, array $data = [])
    {
        $action = $this->getAction();

        if (! $action instanceof Closure) {
            return;
        }

        try {
            return app()->call($action, [
                'data' => $data,
                'livewire' => $this->getLivewire(),
                'records' => $records,
            ]);
        } finally {
            if ($this->shouldDeselectRecordsAfterCompletion()) {
                $this->getLivewire()->deselectAllTableRecords();
            }
        }
    }
}

<?php

namespace Filament\Tables\Actions\Concerns;

trait CanRequireConfirmation
{
    protected bool $isConfirmationRequired = false;

    public function requiresConfirmation(bool $condition = true): static
    {
        $this->isConfirmationRequired = true;

        return $this;
    }

    public function isConfirmationRequired(): bool
    {
        return $this->isConfirmationRequired;
    }
}
